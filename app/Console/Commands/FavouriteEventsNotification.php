<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\EventBackend;
use App\Users;
use App\NotificationPush;
use App\Notification;
use App\Library\Services\NotificationsService;

class FavouriteEventsNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'favourite:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send notifcaions to users has favourite events before 24 hrs of start time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //start to find all events with start times before 24 hrs
        //get events in favourite 
        $notifcation_service = new NotificationsService();
        $events_in_favourites = EventBackend::query()
                                ->whereHas("users_favorites")
                                ->EventsStartAfterOneDay()
                                ->get();
        //We got the evens in users favourites so get users and start push
        if(!$events_in_favourites->isEmpty()){
            foreach ($events_in_favourites as $event) {
                $message['en'] = '1 Day left for '. $event->name;
                $message['ar'] = 'باقي يوم على  انطلاق'.' ' . $event->name;
                foreach ($event->users_favorites()->UserWithDeviceTokens()->get() as $user) {
                    $notification = $notifcation_service->save_notification($message,7,4,$event->id,$user->id);     
                    $queue = new NotificationPush();
                    $queue->notification_id = $notification->id;
                    $queue->device_token    = $user->device_token;
                    $queue->mobile_os       = $user->mobile_os;
                    $queue->lang_id         = $user->lang_id;
                    $queue->user_id         = $user->id;
                    $queue->save();               
                }
                
            }

        }


        //Events in Calender 
        $events_in_calenders = EventBackend::query()
                                ->whereHas("CalenderUsers")
                                ->EventsStartAfterOneDay()
                                ->get();
        //We got the evens in users favourites so get users and start push
        if(!$events_in_calenders->isEmpty()){
            foreach ($events_in_calenders as $event) {
                $message['en'] = '1 Day left for '. $event->name;
                $message['ar'] = 'باقي يوم على  انطلاق'.' ' . $event->name;
                //$notifcaion_service->PushToManyUsers($event->CalenderUsers,$notification);  
                foreach ($event->CalenderUsers()->UserWithDeviceTokens()->get() as $user) {
                    $notification = $notifcation_service->save_notification($message,6,4,$event->id,$user->id);  
                    $queue = new NotificationPush();
                    $queue->notification_id = $notification->id;
                    $queue->device_token    = $user->device_token;
                    $queue->mobile_os       = $user->mobile_os;
                    $queue->lang_id         = $user->lang_id;
                    $queue->user_id         = $user->id;
                    $queue->save();               
                }     
            }

        }
        
    }
}
