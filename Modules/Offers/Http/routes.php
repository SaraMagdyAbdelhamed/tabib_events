<?php

Route::group(['middleware' => 'web', 'prefix' => 'offers', 'namespace' => 'Modules\Offers\Http\Controllers'], function()
{
    Route::get('/', 'OffersController@index');
});
