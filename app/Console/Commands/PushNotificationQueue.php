<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Library\Services\NotificationsService;
use App\EventBackend;
use App\Users;
use App\NotificationPush;

class PushNotificationQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //
        $queues = NotificationPush::all();
        foreach ($queues as $queue) {
            try{
                    //check if arabic => 2 , 1 => english
                    if(!is_null($queue->device_token)){
                        $message = ($queue->lang_id == 2) ? $queue->notification->msg_ar : $queue->notification->msg;
                        if($queue->mobile_os == 'ios'){//  PUSH TO IOS
                         $this->NotificationsService->pushIos($message,$queue->device_token, false, $queue->message->item_id);
                         $this->NotificationsService->pushIos($message,$queue->device_token, true , $queue->message->item_id);
                        }if($queue->mobile_os == 'android'){// PUSH TO ANDROID
                         $this->NotificationsService->PushAndroid($message, $queue->device_token);
                        }else{

                        }
                    }
            }catch(\Exception $e){

            }
            $queue->delete();
        }
    }
}
