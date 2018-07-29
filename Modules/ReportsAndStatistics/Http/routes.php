<?php

Route::group(['middleware' => 'web', 'prefix' => 'reportsandstatistics', 'namespace' => 'Modules\ReportsAndStatistics\Http\Controllers'], function()
{
    Route::get('/', 'ReportsAndStatisticsController@index');
});
