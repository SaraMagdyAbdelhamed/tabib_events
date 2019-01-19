<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Library\Services\NotificationsService;
use App\Notification;
use App\EventJoinRequest;
use App\userGoing;
use Helper;

class HomeController extends Controller
{

    private $NotifcationsService;

    public function test_connection() {
       //Test Database Connection 
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration.");
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->NotifcationsService = new NotificationsService();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function test_not(){
        $x = new NotificationsService();
        $message['en'] = 'aaa';$message['ar']='rtrt';
        $user = \App\Users::find(1);
       echo  $this->NotifcationsService->save_notification($message,2,2,2,$user);
    }

    public function mark_read($id){
        $notification = Notification::find($id);
        $notification->is_read = 1;
        $notification->save();
        return redirect()->route('events.show', $notification->item_id);

    }

    public function request_event(Request $request)
    {
        try{
            $type=0;
            if($request->type == 1)
            {
                $type = 1;
            }
            $event = EventJoinRequest::where('user_id',$request->user_id)->where('event_id',$request->event_id)->first();
            $event->update([
                'is_accepted'=> $type
            ]);
    
            $user_going = userGoing::where('user_id',$request->user_id)->where('event_id',$request->event_id)->first();
            $user_going->update([
                'is_accepted'=> $type
            ]);
            
            $notify = Helper::notification($request->user_id , "events" , $request->event_id , ($type == 1)? 8 : 9 );
        }
        catch(\Exception $e)
        {
            return response()->json();
        }

        return response()->json();
       
    }
}
