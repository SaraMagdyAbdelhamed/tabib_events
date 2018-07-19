<?php

Route::group(['middleware' => 'web', 'prefix' => 'offersanddeals', 'namespace' => 'Modules\OffersAndDeals\Http\Controllers'], function()
{
    Route::get('/', 'OffersAndDealsController@index');
});
