<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// first route
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/map-test', function () {
    return view('map-search-test');
});
// login form route
Route::get('/login', function($lang = null) {
    App::setlocale('en');
    return view('auth.login');
});

Route::get('/test_connection', 'HomeController@test_connection')->name('test_connection');   // for testing purposes

// change language
Route::post('/change/language', 'ChangeLanguage@changeLang')->name('changeLang');


// custom login/logout
Route::post('/login' , 'Auth\LoginController@login')->name('login'); // override authentication urls to manually use languages
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');   // for testing purposes
//Mark Notifcation as Read


// App URLs
Route::group( ['middleware' => ['auth', 'locale'] ], function($lang = null) {
Route::get('/about', '\Modules\Main\Http\Controllers\MainController@about')->name('about');


// Route::get('/main/mark_read/{$id}','\Modules\Main\Http\Controllers\MainController@mark_read');


Route::middleware(['auth', 'Rule:Super Admin,Admin'])->group( function($lang = null) {
    // about us

    
    Route::post('/main/about/edit/{id}', '\Modules\Main\Http\Controllers\MainController@update_fixed')->name('about.edit');

    // terms & conditions
    Route::get('/terms', '\Modules\Main\Http\Controllers\MainController@terms')->name('terms');
    Route::post('/main/terms/edit/{id}', '\Modules\Main\Http\Controllers\MainController@update_fixed')->name('terms.edit');


    // privacy & policy
    Route::get('/privacy', '\Modules\Main\Http\Controllers\MainController@privacy')->name('privacy');
    Route::post('/main/privacy/edit/{id}', '\Modules\Main\Http\Controllers\MainController@update_fixed')->name('privacy.edit');


    // contact us
    Route::get('/contact', '\Modules\Main\Http\Controllers\MainController@contact')->name('contact');
    Route::post('/main/contact/edit', '\Modules\Main\Http\Controllers\MainController@update_contact')->name('contact.edit');


    // event categories
    Route::get('/event/categories', '\Modules\Main\Http\Controllers\MainController@event_category')->name('event.categories');
    Route::post('/event/add', '\Modules\Main\Http\Controllers\MainController@event_store')->name('event.add');
    Route::post('/event/edit', '\Modules\Main\Http\Controllers\MainController@event_update')->name('event.edit');
    Route::post('/event/delete/single', '\Modules\Main\Http\Controllers\MainController@event_delete')->name('event.delete');
    Route::post('/event/delete/selected', '\Modules\Main\Http\Controllers\MainController@event_deleteSelected')->name('event.deleteSelected');
     
    // famous attraction
    Route::get('/famous/attraction', '\Modules\Main\Http\Controllers\MainController@famous')->name('famous.attraction');
    Route::post('/famous/add', '\Modules\Main\Http\Controllers\MainController@famous_store')->name('famous.add');
    Route::post('/famous/edit', '\Modules\Main\Http\Controllers\MainController@famous_update')->name('famous.edit');
    Route::post('/famous/delete/single', '\Modules\Main\Http\Controllers\MainController@famous_delete')->name('famous.delete');
    Route::post('/famous/delete/selected', '\Modules\Main\Http\Controllers\MainController@famous_deleteSelected')->name('famous.deleteSelected');

    // sponsors
    Route::get('/sponsors', '\Modules\Main\Http\Controllers\MainController@sponsors')->name('sponsors');
    Route::post('/sponsor/add', '\Modules\Main\Http\Controllers\MainController@sponsor_store')->name('sponsor.add');
    Route::post('/sponsor/edit', '\Modules\Main\Http\Controllers\MainController@sponsor_update')->name('sponsor.edit');
    Route::post('/sponsor/delete/single', '\Modules\Main\Http\Controllers\MainController@sponsor_delete')->name('sponsor.delete');
    Route::post('/sponsor/delete/selected', '\Modules\Main\Http\Controllers\MainController@sponsor_deleteSelected')->name('sponsor.deleteSelected');

    // Trending searches
    Route::get('/trends', '\Modules\Main\Http\Controllers\MainController@trends')->name('trends');
    Route::post('/trends/add', '\Modules\Main\Http\Controllers\MainController@trends_store')->name('trends.add');
    Route::post('/trends/edit', '\Modules\Main\Http\Controllers\MainController@trends_update')->name('trends.edit');
    Route::post('/trends/delete/single', '\Modules\Main\Http\Controllers\MainController@trends_delete')->name('trends.delete');
    Route::post('/trends/delete/selected', '\Modules\Main\Http\Controllers\MainController@trends_deleteSelected')->name('trends.deleteSelected');

    // Notifications
    Route::middleware(['auth', 'Rule:Super Admin,Admin'])->group( function($lang = null) {
    Route::get('/notifications', '\Modules\Main\Http\Controllers\MainController@notifications')->name('notifications');
    Route::post('/notifications/add', '\Modules\Main\Http\Controllers\MainController@notifications_store')->name('notifications.add');
    Route::post('/notifications/edit', '\Modules\Main\Http\Controllers\MainController@notifications_update')->name('notifications.edit');
    Route::post('/notifications/delete/single', '\Modules\Main\Http\Controllers\MainController@notifications_delete')->name('notifications.delete');
    Route::post('/notifications/delete/selected', '\Modules\Main\Http\Controllers\MainController@notifications_deleteSelected')->name('notifications.deleteSelected');
    }); //notification rule
    });  //main rule
  Route::middleware(['auth', 'Rule:Super Admin'])->group( function($lang = null) {
    //users.mobile
    Route::get('/users_mobile', '\Modules\UsersModule\Http\Controllers\UsersController@index')->name('users_mobile');
    Route::get('/users_backend', '\Modules\UsersModule\Http\Controllers\UsersController@index_backend')->name('users_backend');
    Route::get('/mobile_filter', '\Modules\UsersModule\Http\Controllers\UsersController@mobile_filter')->name('mobile_filter');
    Route::post('/mobile_destroy/{id}', '\Modules\UsersModule\Http\Controllers\UsersController@destroy')->name('mobile_destroy');
    Route::post('/mobile_destroy_all', '\Modules\UsersModule\Http\Controllers\UsersController@destroy_all')->name('mobile_destroy_all');

    Route::post('/mobile_status/{id}', '\Modules\UsersModule\Http\Controllers\UsersController@mobile_status')->name('mobile_status');

    Route::get('/test','\Modules\UsersModule\Http\Controllers\UsersController@test');
    Route::post('/backend_store', '\Modules\UsersModule\Http\Controllers\UsersController@backend_store')->name('backend_store');
    Route::post('/backend_edit/{id}', '\Modules\UsersModule\Http\Controllers\UsersController@backend_edit')->name('backend_edit');
        }); //users rules
   Route::middleware(['auth', 'Rule:Super Admin,Admin,Data Entry,Backend User'])->group( function($lang = null) {
    // Events: Back-end
    Route::get('/events/backend', '\Modules\Events\Http\Controllers\EventsController@index')->name('event_backend');
    Route::get('/events/backend/add', '\Modules\Events\Http\Controllers\EventsController@create')->name('event_backend.add');
    Route::post('/events/backend/store', '\Modules\Events\Http\Controllers\EventsController@store')->name('event_backend.store');
    Route::get('/events/backend/edit/{id}', '\Modules\Events\Http\Controllers\EventsController@edit')->name('event_backend.edit');
    Route::post('/events/backend/update', '\Modules\Events\Http\Controllers\EventsController@update')->name('event_backend.update');
    Route::get('/events/backend/show/{id}', '\Modules\Events\Http\Controllers\EventsController@show')->name('event_backend.show');
    Route::get('/events/backend/edit/{id}', '\Modules\Events\Http\Controllers\EventsController@edit')->name('event_backend.edit');
    Route::post('/events/backend/destroy', '\Modules\Events\Http\Controllers\EventsController@destroy')->name('event_backend.destroy');
    Route::post('/events/backend/destroy_selected', '\Modules\Events\Http\Controllers\EventsController@destroySelected')->name('event_backend.destroySelected');
    Route::get('/events/backend/filter', '\Modules\Events\Http\Controllers\EventsController@filter')->name('event_backend.filter');
      }); //events backend rules

    // Events: Mobile
   Route::middleware(['auth', 'Rule:Super Admin,Admin,Data Entry,Backend User,Mobile User'])->group( function($lang = null) {
    Route::get('/events/mobile', '\Modules\Events\Http\Controllers\EventsMobileController@index')->name('event_mobile');
    
    Route::get('/events/mobile/add', '\Modules\Events\Http\Controllers\EventsMobileController@create')->name('event_mobile.add');
    Route::post('/events/mobile/store', '\Modules\Events\Http\Controllers\EventsMobileController@store')->name('event_mobile.store');
    Route::post('/event_filter', '\Modules\Events\Http\Controllers\EventsMobileController@event_filter')->name('event_filter');
    Route::post('/event_destroy/{id}', '\Modules\Events\Http\Controllers\EventsMobileController@destroy')->name('event_destroy');
    Route::post('/event_destroy_all', '\Modules\Events\Http\Controllers\EventsMobileController@destroy_all')->name('event_destroy_all');
    Route::post('/event_accept/{id}', '\Modules\Events\Http\Controllers\EventsMobileController@accept')->name('event_accept');
    Route::post('/event_accept_all', '\Modules\Events\Http\Controllers\EventsMobileController@accept_all')->name('event_accept_all');
    Route::post('/event_reject/', '\Modules\Events\Http\Controllers\EventsMobileController@reject')->name('event_reject');
     Route::post('/event_pending/{id}', '\Modules\Events\Http\Controllers\EventsMobileController@pending')->name('event_pending');
    Route::post('/event_pending_all', '\Modules\Events\Http\Controllers\EventsMobileController@pending_all')->name('event_pending_all');
    Route::get('/events/mobile/view/{id}', '\Modules\Events\Http\Controllers\EventsMobileController@view')->name('event_mobile_view');
    Route::post('/post_destroy/{id}', '\Modules\Events\Http\Controllers\EventsMobileController@post_destroy')->name('post_destroy');
    Route::post('/post_destroy_all', '\Modules\Events\Http\Controllers\EventsMobileController@post_destroy_all')->name('post_destroy_all');
    Route::get('events/mobile/edit/{id}', '\Modules\Events\Http\Controllers\EventsMobileController@edit')->name('event_edit');
    Route::post('/events/mobile/update', '\Modules\Events\Http\Controllers\EventsMobileController@update')->name('event_mobile.update');
     }); //events mobile rules
    // Big Events
    Route::middleware(['auth', 'Rule:Super Admin'])->group( function($lang = null) {
    Route::get('/events/big_events', '\Modules\Events\Http\Controllers\EventsController@big_events')->name('big_events');
    Route::post('/bigevents_post', '\Modules\Events\Http\Controllers\EventsController@bigevents_post')->name('bigevents_post');
    Route::post('/bigevents_select/{value}', '\Modules\Events\Http\Controllers\EventsController@bigevents_select')->name('bigevents_select');
   
    //Statistics
    Route::get('/statistics', '\Modules\Statistics\Http\Controllers\StatisticsController@index')->name('statistics');
       }); //big events , statistics rules
    //analytics
    //     Route::get('/analytics', function() {
    //    // App::setlocale('en');
    //     return view('analytics');
    // });

    Route::middleware(['auth', 'Rule:Super Admin,Admin,Data Entry,Backend User'])->group( function($lang = null) {
    // Famous Attractions
    Route::get('/attractions'           , '\Modules\Famous\Http\Controllers\FamousController@index' )->name('fa.list'   );
    Route::get('/attractions/view'      , '\Modules\Famous\Http\Controllers\FamousController@show'  )->name('fa.show'   );
    Route::get('/attractions/add'       , '\Modules\Famous\Http\Controllers\FamousController@create')->name('fa.create' );
    Route::get('/attractions/edit/{id}' , '\Modules\Famous\Http\Controllers\FamousController@edit'  )->name('fa.edit'   );
    Route::post('/attractions/store'    , '\Modules\Famous\Http\Controllers\FamousController@store' )->name('fa.store'  );
    Route::post('/attractions/update'   , '\Modules\Famous\Http\Controllers\FamousController@update')->name('fa.update' );
    Route::post('/attractions/filter'   , '\Modules\Famous\Http\Controllers\FamousController@filter')->name('fa.filter' );
    Route::post('/attractions/delete'   , '\Modules\Famous\Http\Controllers\FamousController@destroy')->name('fa.delete');
    Route::post('/attractions/delete/selected', '\Modules\Famous\Http\Controllers\FamousController@destroySelected')->name('fa.deleteSelected');
     

    // Offers and deals
    Route::get('/offers'            , '\Modules\Offers\Http\Controllers\OffersController@index' )->name('offers.list'    );
    Route::post('/offers/store'     , '\Modules\Offers\Http\Controllers\OffersController@store' )->name('offers.store'   );
    Route::get('/offers/edit'       , '\Modules\Offers\Http\Controllers\OffersController@edit'  )->name('offers.edit'    );
    Route::post('/offers/update'    , '\Modules\Offers\Http\Controllers\OffersController@update')->name('offers.update'  );
    Route::post('/offers/delete'    , '\Modules\Offers\Http\Controllers\OffersController@destroy')->name('offers.delete' );
    Route::post('/offers/delete/selected', '\Modules\Offers\Http\Controllers\OffersController@destroySelected')->name('offers.deleteSelected');
    
    // shops
    Route::get('/shops', '\Modules\Shops\Http\Controllers\ShopsController@index')->name('shops');
    Route::get('/add_shop', '\Modules\Shops\Http\Controllers\ShopsController@add')->name('add_shop');
    Route::get('/edit_shop/{id}', '\Modules\Shops\Http\Controllers\ShopsController@edit')->name('edit_shop');
    Route::get('/shop_destroy/{id}', '\Modules\Shops\Http\Controllers\ShopsController@destroy')->name('shop_destroy');
    Route::post('/shop_destroy_all', '\Modules\Shops\Http\Controllers\ShopsController@destroy_all')->name('shop_destroy_all');

    Route::post('/add_shop_data', '\Modules\Shops\Http\Controllers\ShopsController@add_shop')->name('add_shop_data');
    Route::post('/edit_shop_data/{id}', '\Modules\Shops\Http\Controllers\ShopsController@edit_shop')->name('edit_shop_data');
}); // famouse attractions , offers and deals , shop and dine rules

   Route::middleware(['auth', 'Rule:Super Admin,Admin'])->group( function($lang = null) {
    // Notifications_view

    Route::get('/notification', 'NotificationController@index')->name('notification');
    Route::post('/add_notification', 'NotificationController@add')->name('add_notification');
  }); //notification view rules


 });

//AHmed ALaa Test Routes 
Route::get("/test_not","HomeController@test_not");
Route::get("/mark_read/{id}","HomeController@mark_read");
