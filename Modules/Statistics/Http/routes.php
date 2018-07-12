<?php

Route::group(['middleware' => 'web', 'prefix' => 'statistics', 'namespace' => 'Modules\Statistics\Http\Controllers'], function()
{
    Route::get('/', 'StatisticsController@index');
});
