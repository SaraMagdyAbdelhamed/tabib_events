<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\userGoing;
use App\Event;
use Helper;

class EventPushNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notify doctors whom request to attend event before the event start with 24 hours';

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
        $events_requests = Event::query()
                        ->with(["usersGoing"=>function($q){
                            $q->where('is_accepted',1);
                        }])
                        ->EventsStartAfterOneDay()
                        ->get();

            foreach($events_requests as $event)
            {
                foreach($event['usersGoing'] as $attend_users)
                {
                    $notify = Helper::notification($attend_users['id'] , "events" , $event->id , 11);
                }
            }
    }
}
