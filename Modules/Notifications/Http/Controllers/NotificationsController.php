<?php

namespace Modules\Notifications\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Category;
use App\Users;
use App\UserInfo;
use App\Event;
use App\Notification;
use App\NotificationPush;
use App\DoctorSpecialization;
use Validator;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['categories'] = Category::all();
        return view('notifications::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('notifications::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
       


        // $request->gender;$request->categories;$request->notifiaction_text;
        // $request->doctors;

        $validator = Validator::make($request->all(), [
            'notifiaction_text' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $events_id = Event::whereHas('categories', function ($q) use($request) {
            if($request->has('categories') )
            {
            $q->whereIn('category_id',$request->categories);
            }
        })->pluck('id')->toArray();
        $spec_id = DoctorSpecialization::whereHas('events', function ($q) use($request,$events_id) {
            $q->whereIn('event_id',$events_id);
        })->pluck('id')->toArray();
        $users = Users::where(function($q) use($request){

            if($request->has('categories') )
            {

        $events_id = Event::whereHas('categories', function ($q) use($request) {
            $q->whereIn('category_id',$request->categories);
        })->pluck('id')->toArray();

        $spec_id = DoctorSpecialization::whereHas('events', function ($q) use($request,$events_id) {
            $q->whereIn('event_id',$events_id);
        })->pluck('id')->toArray();


                $q->whereHas('userInfo', function ($q) use($request,$events_id,$spec_id) {
                    $q->whereIn('specialization_id',$spec_id);
                });
           }

            if($request->has('gender') )
            {
               $q->whereIn('gender_id',$request->gender);
           }

           if($request->has('doctors') )
           {
            if($request->doctors == 2)
            {
                $q->whereHas('userInfo', function ($q) use($request) {
                    $q->where('is_profile_completed',0);
                });
                
            }
            elseif($request->doctors == 3)
            {
                $q->whereHas('userInfo', function ($q) use($request) {
                    $q->where('is_profile_completed',1);
                });
                
            }
        }


    })->get();
    
        foreach($users as $user){
        $notification = new Notification;
        $notification->msg = $request->notifiaction_text;
        $notification->notification_type_id = 5;
        $notification->user_id = $user->id;
        $notification->save();
        $push = new NotificationPush;
        $push->notification_id = $notification->id;
        $push->user_id = $user->id;
        $push->device_token = $user->device_token;
        $push->mobile_os = $user->mobile_os; 
        $push->lang_id = $user->lang_id; 
        $push->save();
        }
        return redirect()->back()->with('success','تم الإشعار بنجاح');

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('notifications::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('notifications::edit');
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
