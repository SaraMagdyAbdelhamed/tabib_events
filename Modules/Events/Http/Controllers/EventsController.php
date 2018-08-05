<?php

namespace Modules\Events\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Currency;
use App\Category;
use App\Users;
use App\Specialization;
use App\Event;
use App\EventBackend;
use App\Category;
use App\EventMedia;
use App\EventOwner;
use App\EventSpecialization;
use App\EventTicket;
use App\EventBookingTicket;
use App\EventWorkshop;
use App\Survey;
use App\SurveyQuestions;
use App\SurveyQuestionAnswer;
use App\Workshop;
use App\WorkshopOwner;
use App\WorkshopSpecialization;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Session;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['events'] = Event::all();
        $data['categories'] = Category::all();
        return view('events::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data['doctors'] = Users::wherehas('rules', function ($q) {
            $q->where('rule_id', 2);
        })->get();
        $data['categories'] = Category::all();
        $data['specializations'] = Specialization::all();
        $data['currencies'] = Currency::all();
        // dd($data);
        return view('events::events.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        //  dd($request->all());
        if (isset($request['event']['image'])) {
            $destinationPath = 'event_images';
            $fileNameToStore = $destinationPath . '/' . time() . rand(111, 999) . '.' . $request['event']['image']->getClientOriginalExtension();
        // dd($fileNameToStore);
            Input::file('event')['image']->move($destinationPath, $fileNameToStore);
        }
        $fileNameToStore = null;


        $event = Event::create([
            "name" => $request['event']['name'],
            "description" => $request['event']['description'],
            "image" => $fileNameToStore,
            "venue" => $request['event']['place'],
            "latitude" => $request->lat,
            "longtuide" => $request->lng,
            "address" => $request['event']['place'],
            "start_datetime" => date('Y-m-d h:i:s', strtotime($request['event']['start_date'] . $request['event']['start_time'])),
            "end_datetime" => date('Y-m-d h:i:s', strtotime($request['event']['end_date'] . $request['event']['end_time'])),
            "is_paid" => $request['event']['ticket'],
            "mobile" => $request['event']['mobile'],
            "email" => $request['event']['email'],
            "website" => $request['event']['website'],
            "code" => $request['event']['code'],
            "is_active" => ($request['event']['active'] == 'on') ? 1 : 0,
            "created_by" => \Auth::id(),
            "use_ticketing_system" => (isset($request['event']['price'])) ? 1 : 0
        ]);
        if ($event->use_ticketing_system == 1) {
            EventTicket::create([
                "event_id" => $event->id,
                "price" => $request['event']['price'],
                "available_tickets" => $request['event']['available_tickets'],
                "current_available_tickets" => $request['event']['available_tickets'],
                "currency_id" => $request['event']['currency']
            ]);
        }

        if (isset($request['event']['youtube'])) {
            foreach ($request['event']['youtube'] as $youtube) {
                EventMedia::create([
                    "event_id" => $event->id,
                    "link" => $youtube,
                    "type" => 2
                ]);
            }
        }
        if (isset($request['event']['images'])) {
            foreach ($request['event']['images'] as $key => $file) {
                $destinationPath = 'event_images';
                $fileNameToStore = $destinationPath . '/' . time() . rand(111, 999) . '.' . $file->getClientOriginalExtension();
            // dd($fileNameToStore);
                Input::file('event')['images'][$key]->move($destinationPath, $fileNameToStore);
                EventMedia::create([
                    "event_id" => $event->id,
                    "link" => $fileNameToStore,
                    "type" => 1
                ]);
            }
        }
        foreach ($request['event']['category'] as $category) {
            EventCategory::create([
                "event_id" => $event->id,
                "category_id" => $category
            ]);
        }
        if (isset($request['event']['special'])) {
            foreach ($request['event']['special'] as $special) {
                EventSpecialization::create([
                    "event_id" => $event->id,
                    "specialization_id" => $special
                ]);
            }
        }

        foreach ($request['event']['doctor'] as $doctor) {
            EventOwner::create([
                "event_id" => $event->id,
                "user_id" => $doctor
            ]);
        }

        if (isset($request['workshop'])) {
            foreach ($request['workshop'] as $value) {
                $workshop = Workshop::create([
                    "name" => $value['name'],
                    "description" => $value['description'],
                    "venue" => $value['place'],
                    "start_datetime" => date('Y-m-d h:i:s', strtotime($value['start_date'] . $value['start_time'])),
                    "end_datetime" => date('Y-m-d h:i:s', strtotime($value['end_date'] . $value['end_time']))
                ]);
                foreach ($value['doctor'] as $doctor) {
                    WorkshopOwner::create([
                        "workshop_id" => $workshop->id,
                        "user_id" => $doctor
                    ]);
                }
                if (isset($value['special'])) {
                    foreach ($value['special'] as $special) {
                        WorkshopSpecialization::create([
                            "workshop_id" => $workshop->id,
                            "specialization_id" => $special
                        ]);
                    }
                }

                EventWorkshop::create([
                    "event_id" => $event->id,
                    "work_shop_id" => $workshop->id
                ]);
            }
        }

        if (isset($request['survey'])) {
            foreach ($request['survey'] as $value) {
                $survey = Survey::create([
                    "event_id" => $event->id,
                    "name" => $value['name'],
                    "is_realtime" => 1
                ]);
                if ($survey->is_realtime == 1) {
                    $serviceAccount = ServiceAccount::fromJsonFile(public_path() . '/tabibevent-b5519e3c0e09.json');
                    $firebase = (new Factory)
                        ->withServiceAccount($serviceAccount)
                        ->withDatabaseUri('https://tabibevent.firebaseio.com/')
                        ->create();

                    $database = $firebase->getDatabase();

                    $newPost = $database
                        ->getReference('surveys')
                        ->push([
                            'parent_id' => $event->id,
                            'name' => $value['name'],
                            'questions' => '',
                            'id' => ''
                        ]);
                    $updates = ['surveys/' . $newPost->getKey() . '/id' => $newPost->getKey()];
                    $database->getReference()
                        ->update($updates);
                    $survey->update(["firebase_id" => $newPost->getKey()]);
                }
                        // $questions=[];
                foreach ($value['question'] as $key1 => $value_question) {
                    $question = SurveyQuestions::create([
                        "survey_id" => $survey->id,
                        "name" => $value_question['name'],
                        "firebase_id" => $key1
                    ]);
                    $questions[$key1]['name'] = $value_question['name'];
                    $questions[$key1]['id'] = $key1;
                    foreach ($value_question['answer'] as $key => $answer) {
                        SurveyQuestionAnswer::create([
                            "survey_id" => $survey->id,
                            "question_id" => $question->id,
                            "name" => $answer,
                            "number_of_selections" => 0,
                            "firebase_id" => $key
                        ]);
                        $questions[$key1]['answers'][$key]['name'] = $answer;
                        $questions[$key1]['answers'][$key]['number_of_selections'] = 0;
                        $questions[$key1]['answers'][$key]['id'] = $key;
                    }
                }
                    // dd($questions);
                $updates = ['surveys/' . $newPost->getKey() . '/questions' => $questions];
                $database->getReference()
                    ->update($updates);
            }
        }


        Session::flash('success', 'Event added successfully! تم إضافة الحدث بنجاح');
        return redirect('/events/index');


    }

    /**
     * Show the specified resource.
     * @return Response
     */

    public function show($id)
    {
        $data['event'] = Event::find($id);

        if ($data['event'] != null) {
            $data['questions'] = SurveyQuestions::whereHas('survey', function ($query) use ($id) {
                $query->where('event_id', $id);
            })->get();
            $data['tickets'] = $data['event']->tickets;
            return view('events::events.show', $data);
        } else {
            Session::flash('warning', 'Event not found! لم يتم العثور علي الحدث');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $data['event'] = Event::find($id);
        $data['doctors'] = Users::wherehas('rules', function ($q) {
            $q->where('rule_id', 2);
        })->get();
        $data['categories'] = Category::all();
        $data['specializations'] = Specialization::all();
        $data['currencies'] = Currency::all();
        return view('events::events.edit', $data);
    }

    public function destroy($id)
    {
        $event = Event::find($id);

        // Transactions used to rollback if one of the relations faild to be deleted, then it will rollback.
        if( $event != NULL ) {
            DB::beginTransaction();
            try {
                $event->tickets()->delete();
                $event->media()->delete();
                $event->categories()->detach($event->id);
                $event->specializations()->detach($event->id);
                $event->owners()->detach($event->id);
                $event->workshops()->detach($event->id);
                $event->surveys()->delete();
                $event->delete();
                DB::commit();
            } catch(Exception $exp) {
                DB::rollback();
            }
        }
        
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            $event = Event::find($id);

            // Transactions used to rollback if one of the relations faild to be deleted, then it will rollback.
            if( $event != NULL ) {
                DB::beginTransaction();
                try {
                    $event->tickets()->delete();
                    $event->media()->delete();
                    $event->categories()->detach($event->id);
                    $event->specializations()->detach($event->id);
                    $event->owners()->detach($event->id);
                    $event->workshops()->detach($event->id);
                    $event->surveys()->delete();
                    $event->delete();
                    DB::commit();
                } catch(Exception $exp) {
                    DB::rollback();
                }
            }
        }
    }

    public function filter(Request $request)
    {
        $data['events'] = EventBackend::where(function ($q) use ($request) {

            $start_from = date('Y-m-d H:i:s', strtotime($request->start_from));
            $start_to = date('Y-m-d 23:59:59', strtotime($request->start_to));
            $end_from = date('Y-m-d H:i:s', strtotime($request->end_from));
            $end_to = date('Y-m-d 23:59:59', strtotime($request->end_to));

            if ($request->filled('start_from') && $request->filled('start_to')) {
                $q->whereBetween('start_datetime', array($start_from, $start_to));
            } elseif ($request->filled('date_from')) {
                $q->where('start_datetime', '>=', $start_from);
            } elseif ($request->filled('date_to')) {
                $q->where('start_datetime', '<=', $start_to);
            }

            if ($request->filled('end_from') && $request->filled('end_to')) {
                $q->whereBetween('end_datetime', array($end_from, $end_to));
            } elseif ($request->filled('end_from')) {
                $q->where('end_datetime', '>=', $end_from);
            } elseif ($request->filled('end_to')) {
                $q->where('end_datetime', '<=', $end_to);
            }

            if ($request->has('categories')) {

                $q->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('category_id', $request->categories);
                });
            }

            if ($request->has('activation')) {

                $q->where('is_active', $request->activation);

            }


        })->get();
        $data['categories'] = EventCategory::all();
        return view('events::index', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        Session::flash('success', 'Event updated successfully! تم تعديل الحدث بنجاح');
        return redirect('/events/index');
    }
}
