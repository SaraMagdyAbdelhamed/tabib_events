<?php

namespace App\Providers;

use Carbon;
use Auth;
use App\Users;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Sheet;
use Illuminate\Support\ServiceProvider;
use App\Notification;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(171);
        Sheet::macro('Bolding', function (Sheet $sheet, string $cellRange) {
            $sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
        });
        Sheet::macro('Right', function (Sheet $sheet) {
            $sheet->getDelegate()->setRightToLeft(true);
        });
        $notes = Notification::where(function ($query) {
            $query->where('is_read', '=', 0)->where('is_push', '=', 0)->orWhere(function ($query){
               $query->where('is_read',1)->whereDate('created_at', DB::raw('CURDATE()'))->where('is_push',0);
            });

       })->orderBy('created_at','desc')->get();
       $counter = 0;
       foreach($notes as $note){
           if($note->is_read==0)
               $counter++;
       }

       \View::share('counter', $counter);
       \View::share('notes', $notes);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
            $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
        }
    }
}
