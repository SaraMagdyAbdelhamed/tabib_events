<?php

Route::group(['middleware' => 'web', 'prefix' => 'events', 'namespace' => 'Modules\Events\Http\Controllers'], function()
{
    Route::get('/', 'EventsController@index');
});
