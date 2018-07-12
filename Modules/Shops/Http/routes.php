<?php

Route::group(['middleware' => 'web', 'prefix' => 'shops', 'namespace' => 'Modules\Shops\Http\Controllers'], function()
{
    Route::get('/', 'ShopsController@index');
});
