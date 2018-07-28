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

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('events::events.index');
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
        // dd($request->all());
       
        $event=Event::create([
            "name"=>$request['event']['name'],
            "description"=>$request['event']['description'],
            "venue"=>$request['event']['place'],
            "latitude"=>$request['event']['lat'],
            "longtuide"=>$request['event']['long'],
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
        ]);
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
        foreach($request['event']['special'] as $special)
        {
            EventSpecialization::create([
                "event_id"=>$event->id,
                "specialization_id"=>$special
            ]);
        }
        foreach($request['event']['doctor'] as $doctor)
        {
            EventOwner::create([
                "event_id"=>$event->id,
                "User_id"=>$doctor 
            ]);
        }

            if(isset($request['event']['workshop']))
            {
                foreach($request['event']['workshop'] as $workshop)
                {
                   $workshop= Workshop::create([
                        "name"=>$workshop['name'],
                        "description"=>$workshop['description'],
                        "venue"=>$workshop['place'],
                        "start_datetime"=>date('Y-m-d h:i:s',strtotime($workshop['start_date'].$workshop['start_time'])),
                        "end_datetime"=>date('Y-m-d h:i:s',strtotime($workshop['end_date'].$workshop['end_time']))
                    ]);
                    foreach($workshop['doctor'] as $doctor)
                    {
                        WorkshopOwner::create([
                            "workshop_id"=>$workshop->id,
                            "User_id"=>$doctor 
                        ]);
                    }
                    foreach($workshop['special'] as $special)
                    {
                        WorkshopSpecialization::create([
                            "workshop_id"=>$workshop->id,
                            "specialization_id"=>$special 
                        ]);
                    }
                    EventWorkshop::create([
                        "event_id"=>$event->id,
                        "workshop_id"=>$workshop->id
                    ]);
                }
            }

            if(isset($request['event']['survey']))
            {
                foreach($request['event']['survey'] as $survey)
                {
                    $survey=Survey::create([
                        "event_id"=>$event->id,
                        "name"=>$survey['name'],
                        "is_realtime"=>1
                        ]);

                    foreach($survey['question'] as $question)
                    {
                        $question=SurveyQuestions::create([
                            "survey_id"=>$survey->id,
                            "name"=>$question['name']
                        ]);
                        foreach($question['answer'] as $answer)
                        {
                            SurveyQuestionAnswer::create([
                                "survey_id"=>$survey->id,
                                "question_id"=>$question->id,
                                "name"=>$answer->name,
                                "number_of_selections"=>0
                            ]);
                        }
                    }
                }
            }
        
        dd($request->all());

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
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
