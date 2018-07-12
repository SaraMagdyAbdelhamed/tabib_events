<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notification;
use Carbon\Carbon;
class DeleteOldNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old notifications 6 months ago';

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
        //delete notifications 
        $notifications = Notification::query()->whereDate("created_at","<=",Carbon::now()->subMonth(6)->toDateString())->delete();
    }
}
