<?php

namespace Modules\Events\Http\Controllers;

use App\Category;
use App\Countries;
use App\Currency;
use App\Event;
use App\EventBackend;
use App\EventCategory;
use App\EventMedia;
use App\EventOwner;
use App\EventSpecialization;
use App\EventWorkshop;
use App\Specialization;
use App\Survey;
use App\SurveyQuestionAnswer;
use App\SurveyQuestions;
use App\Users;
use App\Workshop;
use App\WorkshopOwner;
use App\WorkshopSpecialization;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Session;
use App\userGoing;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        
        $data['events'] = Event::orderBy('created_at', 'desc')->get();
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
        $data['codes'] = Countries::all();

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
        // dd($request->all());
        $images_ar = explode('-', $request->event_logo_base64);
        $images_en = explode('-', $request->event_images_base64);
        $fileNameToStore = null;
        // dd([$images_ar, $images_en]);

        $validation = Validator::make($request->all(), [
            'event.name' => 'required|min:2|max:100',
            'event.description' => 'required|min:2|max:250',
            'event.place' => 'required',
            // 'event.long' => 'required',
            // 'event.lat' => 'required',
            'event.start_date' => 'required',
            'event.end_date' => 'required',
            'event.start_time' => 'required',
            'event.end_time' => 'required',
        ]);

        if ($validation->fails()) {
            dd($validation->messages());
            // change below as required
            return \Redirect::back()->withInput()->withErrors($validation->messages());
        }

        // store event logo
        // convert base64 images into normal images
            // update English images.
        if (count($images_ar) > 0) {
                // add new images
            foreach ($images_ar as $image) {
                    // check if image exist
                if (strpos($image, 'event_images') !== false) {
                        // search for its name
                    preg_match('/event_images\/(.*)/', $image, $match);

                    if (count($match) > 0) {
                        $name = $match[0];

                        $fileNameToStore = $name;
                    }

                }
                    // check if image is new
                if (strpos($image, 'base64') !== false) {
                        // get image extension
                    preg_match('/image\/(.*)\;/', $image, $match);

                    if (count($match) > 0) {
                        $ext = $match[1];
                        $image = str_replace('data:image/' . $ext . ';base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageName = 'event_images/' . time() . rand(1111, 9999) . '.' . $ext;
                            // dd([$imageName, $image]);
                        \File::put(public_path() . '/' . $imageName, base64_decode($image));

                        $fileNameToStore = $imageName;

                    }
                }
            }

        }

        if (isset($request['event']['active'])) {
            $active = 1;
        } else {
            $active = 0;
        }

        try {
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
                "is_paid" => 0,
                "mobile" => $request['event']['mobile'],
                "email" => $request['event']['email'],
                "website" => $request['event']['website'],
                "code" => $request['event']['code'],
                "is_active" => $active,
                "created_by" => \Auth::id(),
                "use_ticketing_system" => (isset($request['event']['price'])) ? 1 : 0,
            ]);

            if (array_key_exists('youtube', $request['event'])) {

                foreach ($request['event']['youtube'] as $youtube) {
                    if ($youtube != null) {
                        if (strpos($youtube, 'youtube') == false) {
                            Helper::flashLocaleMsg(Session::get('locale'), 'error', 'Youtube link not correct!', ' لينك اليوتيوب غير صحيح  ');
                            return redirect()->back();
                        } elseif (strpos($youtube, 'watch') == false) {
                            Helper::flashLocaleMsg(Session::get('locale'), 'error', 'Youtube link not correct!', ' لينك اليوتيوب غير صحيح  ');
                            return redirect()->back();
                        }
                        str_replace("watch", "embed", $youtube);
                        EventMedia::create([
                            "event_id" => $event->id,
                            "link" => $youtube,
                            "type" => 2,
                        ]);
                    }

                }
            }

            // convert base64 images into normal images
            // update English images.
            if (count($images_en) > 0) {
                // add new images
                foreach ($images_en as $image) {
                    // check if image exist
                    if (strpos($image, 'event_images') !== false) {
                        // search for its name
                        preg_match('/event_images\/(.*)/', $image, $match);

                        if (count($match) > 0) {
                            $name = $match[0];

                            EventMedia::create([
                                "event_id" => $event->id,
                                "link" => $name,
                                "type" => 1,
                            ]);
                        }

                    }
                    // check if image is new
                    if (strpos($image, 'base64') !== false) {
                        // get image extension
                        preg_match('/image\/(.*)\;/', $image, $match);

                        if (count($match) > 0) {
                            $ext = $match[1];
                            $image = str_replace('data:image/' . $ext . ';base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName = 'event_images/' . time() . rand(1111, 9999) . '.' . $ext;
                            // dd([$imageName, $image]);
                            \File::put(public_path() . '/' . $imageName, base64_decode($image));

                            EventMedia::create([
                                "event_id" => $event->id,
                                "link" => $imageName,
                                "type" => 1,
                            ]);

                        }
                    }
                }

            }

            if (array_key_exists('category', $request['event'])) {
                foreach ($request['event']['category'] as $category) {
                    EventCategory::create([
                        "event_id" => $event->id,
                        "category_id" => $category,
                    ]);
                }
            }

            if (array_key_exists('special', $request['event'])) {
                foreach ($request['event']['special'] as $special) {
                    EventSpecialization::create([
                        "event_id" => $event->id,
                        "specialization_id" => $special,
                    ]);
                }
            }

            foreach ($request['event']['doctor'] as $doctor) {
                $notify = Helper::notification($doctor , "events" , $event->id , 10);
                EventOwner::create([
                    "event_id" => $event->id,
                    "user_id" => $doctor,
                ]);
            }

            if ($request->has('workshop')) {

                foreach ($request['workshop'] as $value) {
                    $workshop = Workshop::create([
                        "name" => $value['name'],
                        "description" => $value['description'],
                        "venue" => $value['place'],
                        "start_datetime" => date('Y-m-d h:i:s', strtotime($value['start_date'] . $value['start_time'])),
                        "end_datetime" => date('Y-m-d h:i:s', strtotime($value['end_date'] . $value['end_time'])),
                    ]);
                    if (isset($value['doctor'])) {
                        foreach ($value['doctor'] as $doctor) {
                            WorkshopOwner::create([
                                "workshop_id" => $workshop->id,
                                "user_id" => $doctor,
                            ]);
                        }
                    }

                    if (isset($value['special'])) {
                        foreach ($value['special'] as $special) {
                            WorkshopSpecialization::create([
                                "workshop_id" => $workshop->id,
                                "specialization_id" => $special,
                            ]);
                        }
                    }

                    EventWorkshop::create([
                        "event_id" => $event->id,
                        "work_shop_id" => $workshop->id,
                    ]);

                }
            }
            if (isset($request['survey'])) {
                foreach ($request['survey'] as $value) {
                    if ($value['name'] != null) {
                        $survey = Survey::create([
                            "event_id" => $event->id,
                            "name" => $value['name'],
                            "is_realtime" => 1,
                        ]);
                        if ($survey->is_realtime == 1) {
                            $serviceAccount = ServiceAccount::fromJsonFile(public_path() . '/tabibevent-18b7d5f15a36.json');
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
                                    'id' => '',
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
                                "firebase_id" => $key1,
                            ]);
                            $questions[$key1]['name'] = $value_question['name'];
                            $questions[$key1]['id'] = $key1;
                            foreach ($value_question['answer'] as $key => $answer) {
                                SurveyQuestionAnswer::create([
                                    "survey_id" => $survey->id,
                                    "question_id" => $question->id,
                                    "name" => $answer,
                                    "number_of_selections" => 0,
                                    "firebase_id" => $key,
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
            }

        } catch (\Exception $ex) {
            Event::destroy($event->id);
            Helper::flashLocaleMsg(Session::get('locale'), 'fail', 'Error while adding Event!', 'حدث خطأ اثناء اضافه الحدث');
            return redirect()->back();
        }

        Helper::flashLocaleMsg(Session::get('locale'), 'success', 'Event added successfully!', ' تم إضافة الحدث بنجاح');
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
            Helper::flashLocaleMsg(Session::get('locale'), 'warning', 'Event not found!', 'لم يتم العثور علي الحدث');
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
        // dd($data['event']);
        $data['doctors'] = Users::wherehas('rules', function ($q) {
            $q->where('rule_id', 2);
        })->get();
        $data['categories'] = Category::all();
        $data['specializations'] = Specialization::all();
        $data['currencies'] = Currency::all();
        $data['codes'] = Countries::all();
        $data['event_youtube_links'] = EventMedia::where('event_id', $id)->where('link', 'like', '%youtube%')->get();
        $data['event_images'] = EventMedia::where('event_id', $id)->where('link', 'NOT LIKE', '%youtube%')->get();

        return view('events::events.edit', $data);
    }

    public function destroy(Request $request)
    {
        $event = Event::find($request->id);

        // Transactions used to rollback if one of the relations faild to be deleted, then it will rollback.
        if ($event != null) {
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
            } catch (Exception $exp) {
                DB::rollback();
                return response()->json(['error' => 'Error', 'msg' => 'Error!']);
            }
        }

        return response()->json(['success' => 'Success', 'msg' => 'deleted successfully!']);
    }

    public function destroy_all(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $event = Event::find($id);

            // Transactions used to rollback if one of the relations faild to be deleted, then it will rollback.
            if ($event != null) {
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
                } catch (Exception $exp) {
                    DB::rollback();
                    return response()->json(['error' => 'Error', 'msg' => 'Error!']);
                }
            }
        }

        return response()->json(['success' => 'Success', 'msg' => 'deleted successfully!']);
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
        $data['categories'] = Category::all();
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
        $logo = '';
        $images_logo = explode('-', $request->event_logo_base64);
        $images_en = explode('-', $request->event_images_base64);
        // dd($images_en);

        $validation = Validator::make($request->all(), [
            'event.name' => 'required|min:2|max:100',
            'event.description' => 'required|min:2|max:250',
            'event.place' => 'required',
            // 'event.long' => 'required',
            // 'event.lat' => 'required',
            // 'event.image' => 'required',
            'event.start_date' => 'required',
            'event.end_date' => 'required',
            'event.start_time' => 'required',
            'event.end_time' => 'required',
        ]);
        if ($validation->fails()) {
            // change below as required
            dd($validation->messages());
            return \Redirect::back()->withInput()->withErrors($validation->messages());
        }

        $event = Event::find($id);

        // convert base64 images into normal images
        // update English images.
        if (count($images_logo) > 0) {
            // add new images
            foreach ($images_logo as $image) {
                // check if image exist
                if (strpos($image, 'event_images') !== false) {
                    // search for its name
                    preg_match('/event_images\/(.*)/', $image, $match);

                    if (count($match) > 0) {
                        $name = $match[0];

                        $logo = $image;
                    }

                }
                // check if image is new
                if (strpos($image, 'base64') !== false) {
                    // get image extension
                    preg_match('/image\/(.*)\;/', $image, $match);

                    if (count($match) > 0) {
                        $ext = $match[1];
                        $image = str_replace('data:image/' . $ext . ';base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageName = 'event_images/' . time() . rand(1111, 9999) . '.' . $ext;
                        // dd([$imageName, $image]);
                        \File::put(public_path() . '/' . $imageName, base64_decode($image));

                        $logo = $imageName;

                    }
                }
            }

        }

        $fileNameToStore = $logo;

        if (isset($request['event']['active'])) {
            $active = 1;
        } else {
            $active = 0;
        }
        try {
            $event->update([
                "name" => $request['event']['name'],
                "description" => $request['event']['description'],
                "image" => $logo,
                "venue" => $request['event']['place'],
                "latitude" => $request->lat,
                "longtuide" => $request->lng,
                "address" => $request['event']['place'],
                "start_datetime" => date('Y-m-d h:i:s', strtotime($request['event']['start_date'] . $request['event']['start_time'])),
                "end_datetime" => date('Y-m-d h:i:s', strtotime($request['event']['end_date'] . $request['event']['end_time'])),
                "is_paid" => 0,
                "mobile" => $request['event']['mobile'],
                "email" => $request['event']['email'],
                "website" => $request['event']['website'],
                "code" => $request['event']['code'],
                "is_active" => $active,
                "created_by" => \Auth::id(),
                "use_ticketing_system" => (isset($request['event']['price'])) ? 1 : 0,
            ]);
        } catch (\Exception $ex) {
            Helper::flashLocaleMsg(Session::get('locale'), 'fail', 'Event not updated !', ' تعديل الحدث  حدث خطأ ');

            return redirect()->back();
        }

        // delete old media
        $event->media()->delete();

        // convert base64 images into normal images
        // update English images.
        if (count($images_en) > 0) {
            // add new images

            foreach ($images_en as $image) {
                // check if image exist
                if (strpos($image, 'event_images') !== false) {
                    // search for its name
                    preg_match('/event_images\/(.*)/', $image, $match);

                    if (count($match) > 0) {
                        $name = $match[0];

                        $media = EventMedia::create([
                            "event_id" => $event->id,
                            "link" => $name,
                            "type" => 1,
                        ]);

                    }

                }
                // check if image is new
                if (strpos($image, 'base64') !== false) {
                    // get image extension
                    preg_match('/image\/(.*)\;/', $image, $match);

                    if (count($match) > 0) {
                        $ext = $match[1];
                        $image = str_replace('data:image/' . $ext . ';base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageName = 'event_images/' . time() . rand(1111, 9999) . '.' . $ext;
                        // dd([$imageName, $image]);
                        \File::put(public_path() . '/' . $imageName, base64_decode($image));

                        EventMedia::create([
                            "event_id" => $event->id,
                            "link" => $imageName,
                            "type" => 1,
                        ]);

                    }
                }
            }

        }

        // if ($event->use_ticketing_system == 1) {
        //     EventTicket::where('event_id', $event->id)->delete();
        //     EventTicket::create([
        //         "event_id" => $event->id,
        //         "price" => $request['event']['price'],
        //         "available_tickets" => $request['event']['available_tickets'],
        //         "current_available_tickets" => $request['event']['available_tickets'],
        //         "currency_id" => $request['event']['currency']
        //     ]);
        // }

        if (isset($request['event']['youtube'])) {
            EventMedia::where('event_id', $event->id)->where('type', 2)->delete();
            foreach ($request['event']['youtube'] as $youtube) {
                if ($youtube != null) {
                    if (strpos($youtube, 'youtube') == false) {
                        Helper::flashLocaleMsg(Session::get('locale'), 'fail', 'Youtube link not correct!', ' لينك اليوتيوب غير صحيح  ');
                        return redirect()->back();
                    } elseif (strpos($youtube, 'watch') == false) {
                        Helper::flashLocaleMsg(Session::get('locale'), 'fail', 'Youtube link not correct!', ' لينك اليوتيوب غير صحيح  ');
                        return redirect()->back();
                    }
                    str_replace("watch", "embed", $youtube);
                    EventMedia::create([
                        "event_id" => $event->id,
                        "link" => $youtube,
                        "type" => 2,
                    ]);
                }
            }
        }
        if (array_key_exists('category', $request['event'])) {
        foreach ($request['event']['category'] as $category) {
            EventCategory::where('event_id', $event->id)->delete();
            EventCategory::create([
                "event_id" => $event->id,
                "category_id" => $category,
            ]);
        }
    }
        if (isset($request['event']['special'])) {
            EventSpecialization::where('event_id', $event->id)->delete();
            foreach ($request['event']['special'] as $special) {
                EventSpecialization::create([
                    "event_id" => $event->id,
                    "specialization_id" => $special,
                ]);
            }
        }
        if (array_key_exists('doctor', $request['event'])) {
        foreach ($request['event']['doctor'] as $doctor) {
            $notify = Helper::notification($doctor , "events" , $event->id , 10);
            EventOwner::where('event_id', $event->id)->delete();
            EventOwner::create([
                "event_id" => $event->id,
                "user_id" => $doctor,
            ]);
        }
    }

        if (isset($request['workshop'])) {

            $workshops = EventWorkshop::where('event_id', $event->id)->get();
            foreach ($workshops as $work) {
                Workshop::destroy($work->work_shop_id);
                WorkshopOwner::where('workshop_id', $work->work_shop_id)->delete();
                WorkshopSpecialization::where('workshop_id', $work->work_shop_id)->delete();
                EventWorkshop::destroy($work->id);
            }
            foreach ($request['workshop'] as $value) {
                $workshop = Workshop::create([
                    "name" => $value['name'],
                    "description" => $value['description'],
                    "venue" => $value['place'],
                    "start_datetime" => date('Y-m-d h:i:s', strtotime($value['start_date'] . $value['start_time'])),
                    "end_datetime" => date('Y-m-d h:i:s', strtotime($value['end_date'] . $value['end_time'])),
                ]);
                foreach ($value['doctor'] as $doctor) {
                    WorkshopOwner::create([
                        "workshop_id" => $workshop->id,
                        "user_id" => $doctor,
                    ]);
                }
                if (isset($value['special'])) {
                    foreach ($value['special'] as $special) {
                        WorkshopSpecialization::create([
                            "workshop_id" => $workshop->id,
                            "specialization_id" => $special,
                        ]);
                    }
                }

                EventWorkshop::create([
                    "event_id" => $event->id,
                    "work_shop_id" => $workshop->id,
                ]);
            }
        }

        if (isset($request['survey'])) {
            $doctors_attend_event=userGoing::where('event_id',$event->id)->where('is_accepted',1)->get();
            foreach($doctors_attend_event as $doctor)
            {
                $notify = Helper::notification($doctor['id'] , "events" , $event->id , 4);
            }
            $surveys = Survey::where('event_id', $event->id)->get();
            foreach ($surveys as $sur) {
                $database = self::firebase();

                $database->getReference('surveys/' . $sur->firebase_id)
                    ->remove();
                SurveyQuestions::where('survey_id', $sur->id)->delete();
                SurveyQuestionAnswer::where('survey_id', $sur->id)->delete();
                Survey::destroy($sur->id);
            }
            foreach ($request['survey'] as $value) {
                
                $survey = Survey::create([
                    "event_id" => $event->id,
                    "name" => $value['name'],
                    "is_realtime" => 1,
                ]);
                if ($survey->is_realtime == 1) {

                    $database = self::firebase();
                    $newPost = $database
                        ->getReference('surveys')
                        ->push([
                            'parent_id' => $event->id,
                            'name' => $value['name'],
                            'questions' => '',
                            'id' => '',
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
                        "firebase_id" => $key1,
                    ]);
                    $questions[$key1]['name'] = $value_question['name'];
                    $questions[$key1]['id'] = $key1;
                    foreach ($value_question['answer'] as $key => $answer) {
                        SurveyQuestionAnswer::create([
                            "survey_id" => $survey->id,
                            "question_id" => $question->id,
                            "name" => $answer,
                            "number_of_selections" => 0,
                            "firebase_id" => $key,
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

        Helper::flashLocaleMsg(Session::get('locale'), 'success', 'Event updated successfully!', 'تم تعديل الحدث بنجاح');
        return redirect('/events/index');
    }

    public function firebase()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(public_path() . '/tabibevent-18b7d5f15a36.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://tabibevent.firebaseio.com/')
            ->create();

        $database = $firebase->getDatabase();

        return $database;
    }

}
