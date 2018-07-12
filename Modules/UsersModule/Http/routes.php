<?php

Route::group(['middleware' => 'web', 'prefix' => 'usersmodule', 'namespace' => 'Modules\UsersModule\Http\Controllers'], function()
{
    Route::get('/', 'UsersModuleController@index');
});
