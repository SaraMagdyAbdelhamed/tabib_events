<?php

namespace App\Providers;

use Carbon;
use Auth;
use App\Users;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Sheet;
use Illuminate\Support\ServiceProvider;

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
