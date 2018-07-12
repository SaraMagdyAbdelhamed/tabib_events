<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\BigEvent;
use App\Notification;
use App\Library\Services\NotificationsService;
use App\EventBackend;
use App\Users;
use App\NotificationPush;


class BigEventsNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bigevents:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify all users about big events';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private  $NotificationsService;
    public function __construct()
    {
        parent::__construct();
        $this->NotificationsService = new NotificationsService();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // get all big event with is_notification_sent = 0
        $big_events = BigEvent::query()->where("is_notification_sent",0)->get();
        if(!$big_events->isEmpty()){
            foreach ($big_events as $event) {
            $message['en']  = 'Big Event Added';
            $message['ar']  = 'تم إضاافة حدث كبير';
            foreach (Users::UsersMobile() as $user) {
                   $notification = $this->NotificationsService->save_notification(
                        $message,
                        2,
                        4,
                        $event->event_id,
                        $user->id
                    );
                    $queue = new NotificationPush();
                    $queue->notification_id = $notification->id;
                    $queue->device_token    = $user->device_token;
                    $queue->mobile_os       = $user->mobile_os;
                    $queue->lang_id         = $user->lang_id;
                    $queue->user_id         = $user->id;
                    $queue->save();  
             }
            //set is_notificaition_sent to 1
            $event->is_notification_sent = 1;
            $event->save();
            
         }

        }
        

        
    }
}
