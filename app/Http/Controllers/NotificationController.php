<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\NotificationItem;
use App\NotificationPush;
use App\Age_Ranges;
use App\Interest;
use App\Users;
use App\Helpers\Helper;
use App\UsersInterest;
class NotificationController extends Controller
{
    public function index()
    {
    	$data['interests']=interest::all();
    	$data['ages']=Age_Ranges::all();
    	return view('notifications.index',$data);
    }
    public function add(Request $request)
    {
    	// dd($request);
    	if(!isset($request['gender_m']) && !isset($request['gender_f']) && !isset($request['age']) && !isset($request['category']))
    	{
    		
    		$users= Users::all();
    		foreach ($users as $key => $value) {
                $notification = Notification::create([
                "msg"=>$request['msg'],
                "msg_ar"=>$request['msg_ar'],
                "notification_type_id"=>1,
                "is_sent"=>0,
                "is_read"=>0,
                "user_id"=>$value['id']
            ]);
    			NotificationPush::create([
    				"notification_id"=>$notification->id,
    				"user_id"=>$value['id'],
    				"device_token"=>$value['device_token'],
    				"mobile_os"=>$value['mobile_os'],
    				"lang_id"=>$value['lang_id']
    			]);
    		}
    	}
    	else
    	{
    		$users=Users::where(function($q) use ($request){
    			if(isset($request['gender_m']))
    		{
    			$q->where('gender_id',1);
    			if(isset($request['gender_f']))
    		{
    			$q->orwhere('gender_id',2);
    		}
    		}
    		else if(isset($request['gender_f']))
    		{
    			$q->where('gender_id',2);
    		}
    		if(isset($request['age']))
    		{
    			 $id=[];
    			foreach ($request['age'] as $key => $value) {
    				$age_range=Age_Ranges::where('id',$value)->first();
    				$ranges=Helper::ageRange_users($age_range->from,$age_range->to);
    				for ($i=0; $i < count($ranges); $i++) { 
    					$id[]=$ranges[$i];
    				}
    				
    			}
    			$q->whereIn('id',$id);
    			
    			// dd($ids);
    		}
    		if(isset($request['category']))
    		{
    			$ids=[];
    			foreach ($request['category'] as $key => $value) {
    				$users_categories=UsersInterest::where('interest_id',$value)->get();
    				foreach ($users_categories as $key1 => $value1) {
    					$ids[]=$value1['user_id'];
    				}

    			}
    			$q->whereIn('id',$ids);
    			 
    			
    		}


    		})->get();
    		
    		// dd($users);
    		// $notification = Notification::create([
    		// 	"msg"=>$request['msg'],
    		// 	"msg_ar"=>$request['msg_ar'],
    		// 	"notification_type_id"=>1,
    		// 	"is_sent"=>0,
    		// 	"is_read"=>0,
    		// 	"user_id"=>\Auth::user()->id
    		// ]);
    		// $users= Users::all();
    		foreach ($users as $key => $value) {
                 $notification = Notification::create([
                "msg"=>$request['msg'],
                "msg_ar"=>$request['msg_ar'],
                "notification_type_id"=>1,
                "is_sent"=>0,
                "is_read"=>0,
                "user_id"=>$value['id']
            ]);
    			NotificationPush::create([
    				"notification_id"=>$notification->id,
    				"user_id"=>$value['id'],
    				"device_token"=>$value['device_token'],
    				"mobile_os"=>$value['mobile_os'],
    				"lang_id"=>$value['lang_id']
    			]);
    		}
    		    		// dd($users);
    	}
    return redirect()->back();
    }
}
