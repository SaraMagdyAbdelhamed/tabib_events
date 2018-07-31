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
use App\EventCategory;
use App\EventMedia;
use App\EventOwner;
use App\EventSpecialization;
use App\EventTicket;
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
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['events'] = Event::all();

        return view('events::events.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data['doctors']=Users::wherehas('rules',function($q){
            $q->where('rule_id',2);
        })->get();
        $data['categories']=Category::all();
        $data['specializations']=Specialization::all();
        $data['currencies']=Currency::all();
        // dd($data);
        return view('events::events.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        if(isset($request['event']['image']))
        {
            $destinationPath = 'event_images';
            $fileNameToStore = $destinationPath . '/' . time() . rand(111, 999) . '.' . $request['event']['image']->getClientOriginalExtension();
        // dd($fileNameToStore);
            Input::file('event')['image']->move($destinationPath, $fileNameToStore);
        }
        $fileNameToStore=NULL;
       
        
        $event=Event::create([
            "name"=>$request['event']['name'],
            "description"=>$request['event']['description'],
            "image"=>$fileNameToStore,
            "venue"=>$request['event']['place'],
            "latitude"=>$request->lat,
            "longtuide"=>$request->lng,
            "address"=>$request['event']['place'],
            "start_datetime"=>date('Y-m-d h:i:s',strtotime($request['event']['start_date'].$request['event']['start_time'])),
            "end_datetime"=>date('Y-m-d h:i:s',strtotime($request['event']['end_date'].$request['event']['end_time'])),
            "is_paid"=>$request['event']['ticket'],
            "mobile"=>$request['event']['mobile'],
            "email"=>$request['event']['email'],
            "website"=>$request['event']['website'],
            "code"=>$request['event']['code'],
            "is_active"=>($request['event']['active'] == 'on')? 1 : 0,
            "created_by"=>\Auth::id(),
            "use_ticketing_system"=>(isset($request['event']['price'])) ? 1 : 0
        ]);
        if($event->use_ticketing_system == 1)
        {
            EventTicket::create([
                "event_id"=> $event->id,
                "price"=>$request['event']['price'],
                "available_tickets"=>$request['event']['available_tickets'],
                "current_available_tickets"=>$request['event']['available_tickets'],
                "currency_id"=>$request['event']['currency']
            ]);
        }
        
        if(isset($request['event']['youtube']))
        {
            foreach($request['event']['youtube'] as $youtube)
            {
                EventMedia::create([
                    "event_id"=>$event->id,
                    "link"=>$youtube,
                    "type"=>2
                ]);
            }
        }
        if(isset($request['event']['images']))
        {
            foreach($request['event']['images'] as $key=>$file)
            {
                $destinationPath = 'event_images';
                $fileNameToStore = $destinationPath . '/' . time() . rand(111, 999) . '.' . $file->getClientOriginalExtension();
            // dd($fileNameToStore);
                Input::file('event')['images'][$key]->move($destinationPath, $fileNameToStore);
                EventMedia::create([
                    "event_id"=>$event->id,
                    "link"=>$fileNameToStore,
                    "type"=>1
                ]);
            }
        }
        foreach($request['event']['category'] as $category)
        {
            EventCategory::create([
                "event_id"=>$event->id,
                "category_id"=>$category
            ]);
        }
        if(isset($request['event']['special']))
        {
           foreach($request['event']['special'] as $special)
                {
                    EventSpecialization::create([
                        "event_id"=>$event->id,
                        "specialization_id"=>$special
                    ]);
                }  
        }
       
        foreach($request['event']['doctor'] as $doctor)
        {
            EventOwner::create([
                "event_id"=>$event->id,
                "user_id"=>$doctor 
            ]);
        }

            if(isset($request['workshop']))
            {
                foreach($request['workshop'] as $value)
                {
                   $workshop= Workshop::create([
                        "name"=>$value['name'],
                        "description"=>$value['description'],
                        "venue"=>$value['place'],
                        "start_datetime"=>date('Y-m-d h:i:s',strtotime($value['start_date'].$value['start_time'])),
                        "end_datetime"=>date('Y-m-d h:i:s',strtotime($value['end_date'].$value['end_time']))
                    ]);
                    foreach($value['doctor'] as $doctor)
                    {
                        WorkshopOwner::create([
                            "workshop_id"=>$workshop->id,
                            "user_id"=>$doctor 
                        ]);
                    }
                    if(isset($value['special']))
                    {
                        foreach($value['special'] as $special)
                        {
                            WorkshopSpecialization::create([
                                "workshop_id"=>$workshop->id,
                                "specialization_id"=>$special 
                            ]);
                        } 
                    }
                   
                    EventWorkshop::create([
                        "event_id"=>$event->id,
                        "work_shop_id"=>$workshop->id
                    ]);
                }
            }

            if(isset($request['survey']))
            {
                foreach($request['survey'] as $value)
                {
                    $survey=Survey::create([
                        "event_id"=>$event->id,
                        "name"=>$value['name'],
                        "is_realtime"=>1
                        ]);
                        if($survey->is_realtime == 1)
                        {
                            $serviceAccount = ServiceAccount::fromJsonFile(public_path().'/tabibevent-b5519e3c0e09.json');
                            $firebase = (new Factory)
                            ->withServiceAccount($serviceAccount)
                            ->withDatabaseUri('https://tabibevent.firebaseio.com/')
                            ->create();

                            $database = $firebase->getDatabase();

                            $newPost = $database
                            ->getReference('surveys')
                            ->push([
                            'parent_id' => $event->id ,
                            'name' => $value['name'],
                            'questions'=>'',
                            'id'=>''
                            ]);
                            $updates=['surveys/'.$newPost->getKey().'/id'=>$newPost->getKey()];
                            $database->getReference()
                            ->update($updates);
                            $survey->update(["firebase_id"=>$newPost->getKey()]);
                        }
                        // $questions=[];
                    foreach($value['question'] as $key1=>$value_question)
                    {
                        $question=SurveyQuestions::create([
                            "survey_id"=>$survey->id,
                            "name"=>$value_question['name'],
                            "firebase_id"=>$key1
                        ]);
                        $questions[$key1]['name']=$value_question['name'];
                        $questions[$key1]['id']=$key1;
                        foreach($value_question['answer'] as $key=>$answer)
                        {
                            SurveyQuestionAnswer::create([
                                "survey_id"=>$survey->id,
                                "question_id"=>$question->id,
                                "name"=>$answer,
                                "number_of_selections"=>0,
                                "firebase_id"=>$key
                            ]);
                            $questions[$key1]['answers'][$key]['name']=$answer;
                            $questions[$key1]['answers'][$key]['number_of_selections']=0;
                            $questions[$key1]['answers'][$key]['id']=$key;
                        }
                    }
                    // dd($questions);
                    $updates=['surveys/'.$newPost->getKey().'/questions'=>$questions];
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
    public function show()
    {
        // dd($request);
        return view('events::events.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('events::events.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
