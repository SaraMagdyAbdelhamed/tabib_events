<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Library\Services\NotificationsService;
use App\Notification;

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
        return redirect("/events/mobile/view/".$notification->item_id);

    }
}
