<?php

Route::group(['middleware' => 'web', 'prefix' => 'famous', 'namespace' => 'Modules\Famous\Http\Controllers'], function()
{
    Route::get('/', 'FamousController@index');
});
