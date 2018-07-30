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

    //reports_and_statistics
    Route::get('/reports_and_statistics', '\Modules\ReportsAndStatistics\Http\Controllers\ReportsAndStatisticsController@index')->name('reports_and_statistics');
    Route::get('/sponsor_report', '\Modules\ReportsAndStatistics\Http\Controllers\ReportsAndStatisticsController@sponsor')->name('sponsor_report');
    Route::post('/sponsor_filter', '\Modules\ReportsAndStatistics\Http\Controllers\ReportsAndStatisticsController@sponsor_filter')->name('sponsor_filter');
    Route::get('/sponsor_excel', '\Modules\ReportsAndStatistics\Http\Controllers\ReportsAndStatisticsController@sponsor_excel')->name('sponsor_excel');
    // Route::get('/sponsor_get_offer', '\Modules\ReportsAndStatistics\Http\Controllers\ReportsAndStatisticsController@getOffer')->name('sponsor_get_offer');
    Route::get('/event_report', '\Modules\ReportsAndStatistics\Http\Controllers\ReportsAndStatisticsController@event')->name('event_report');
    Route::post('/event_filter_report', '\Modules\ReportsAndStatistics\Http\Controllers\ReportsAndStatisticsController@event_filter')->name('event_filter_report');
    Route::get('/event_excel', '\Modules\ReportsAndStatistics\Http\Controllers\ReportsAndStatisticsController@event_excel')->name('event_excel');

    //Notifications
    Route::get('/notifications', '\Modules\Notifications\Http\Controllers\NotificationsController@index')->name('notifications');
    Route::post('/send_notification', '\Modules\Notifications\Http\Controllers\NotificationsController@store')->name('send_notification');
    
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

    // Sponsor categories
    Route::get('/sponsor/categories', '\Modules\Main\Http\Controllers\MainController@sponsor_category')->name('sponsor.categories');

    // Offer categories
    Route::get('/offers/categories', '\Modules\Main\Http\Controllers\MainController@offers_category')->name('offers.categories');

    // Doctor Specialists
    Route::get('/doctor/speciality/categories', '\Modules\Main\Http\Controllers\MainController@speciality_category')->name('speciality.categories');

    /** Categories routes for [events, sponsors, offers and doctor specialities] */
    Route::post('/category/add', '\Modules\Main\Http\Controllers\MainController@category_store')->name('category.add');
    Route::post('/category/edit', '\Modules\Main\Http\Controllers\MainController@category_update')->name('category.edit');
    Route::post('/category/delete/single', '\Modules\Main\Http\Controllers\MainController@category_delete')->name('category.delete');
    Route::post('/category/delete/selected', '\Modules\Main\Http\Controllers\MainController@category_deleteSelected')->name('category.deleteSelected');

    //Notifications
    Route::middleware(['auth', 'Rule:Super Admin,Admin'])->group( function($lang = null) {
    // Route::get('/notifications', '\Modules\Main\Http\Controllers\MainController@notifications')->name('notifications');
    // Route::post('/notifications/add', '\Modules\Main\Http\Controllers\MainController@notifications_store')->name('notifications.add');
    // Route::post('/notifications/edit', '\Modules\Main\Http\Controllers\MainController@notifications_update')->name('notifications.edit');
    // Route::post('/notifications/delete/single', '\Modules\Main\Http\Controllers\MainController@notifications_delete')->name('notifications.delete');
    // Route::post('/notifications/delete/selected', '\Modules\Main\Http\Controllers\MainController@notifications_deleteSelected')->name('notifications.deleteSelected');
    }); //notification rule

     // offers and deals
     Route::middleware(['auth', 'Rule:Super Admin,Admin'])->group( function($lang = null) {
        Route::get('/offers_and_deals', '\Modules\OffersAndDeals\Http\Controllers\OffersAndDealsController@index')->name('offers_and_deals');
        Route::get('/offers_and_deals/add', '\Modules\OffersAndDeals\Http\Controllers\OffersAndDealsController@store')->name('offers_and_deals.add');
        Route::post('/offers_and_deals/create', '\Modules\OffersAndDeals\Http\Controllers\OffersAndDealsController@create')->name('offers_and_deals.create');

        Route::get('/offers_and_deals/edit/{id}', '\Modules\OffersAndDeals\Http\Controllers\OffersAndDealsController@edit')->name('offers_and_deals.edit');
        Route::post('/offers_and_deals/update/{id}', '\Modules\OffersAndDeals\Http\Controllers\OffersAndDealsController@update')->name('offers_and_deals.update');
        Route::post('/offers_and_deals/delete', '\Modules\OffersAndDeals\Http\Controllers\OffersAndDealsController@delete')->name('offers_and_deals.delete');
        Route::post('/offers_and_deals/delete/selected', '\Modules\OffersAndDeals\Http\Controllers\OffersAndDealsController@deleteSelected')->name('offers_and_deals.deleteSelected');
        }); //notification rule
         // events
     Route::middleware(['auth', 'Rule:Super Admin,Admin'])->group( function($lang = null) {
        Route::get('/events', '\Modules\Events\Http\Controllers\EventsController@index')->name('events');
        Route::post('/events/add', '\Modules\Events\Http\Controllers\EventsController@store')->name('events.add');
        Route::get('/events/create', '\Modules\Events\Http\Controllers\EventsController@create')->name('events.create');

        Route::get('/events/edit/{id}', '\Modules\Events\Http\Controllers\EventsController@edit')->name('events.edit');
        Route::post('/events/update/{id}', '\Modules\Events\Http\Controllers\EventsController@update')->name('events.update');
        Route::post('/events/delete', '\Modules\Events\Http\Controllers\EventsController@delete')->name('events.delete');
        Route::post('/events/delete/selected', '\Modules\Events\Http\Controllers\EventsController@deleteSelected')->name('events.deleteSelected');
        });
    });  //main rule
  Route::middleware(['auth', 'Rule:Super Admin'])->group( function($lang = null) {
    //users.mobile
    Route::get('/users_mobile', '\Modules\UsersModule\Http\Controllers\UsersController@index')->name('users_mobile');
    Route::get('/users_mobile/show/{id}', '\Modules\UsersModule\Http\Controllers\UsersController@mobile_show')->name('users_mobile.show');
    Route::get('/users_backend', '\Modules\UsersModule\Http\Controllers\UsersController@index_backend')->name('users_backend');
    Route::get('/mobile_filter', '\Modules\UsersModule\Http\Controllers\UsersController@mobile_filter')->name('mobile_filter');
    Route::post('/mobile_destroy/{id}', '\Modules\UsersModule\Http\Controllers\UsersController@destroy')->name('mobile_destroy');
    Route::post('/mobile_destroy_all', '\Modules\UsersModule\Http\Controllers\UsersController@destroy_all')->name('mobile_destroy_all');

    Route::post('/mobile_status/{id}', '\Modules\UsersModule\Http\Controllers\UsersController@mobile_status')->name('mobile_status');

    Route::get('/test','\Modules\UsersModule\Http\Controllers\UsersController@test');

    // Store backend users
    Route::get('/backend/create', '\Modules\UsersModule\Http\Controllers\UsersController@backend_create')->name('backend_create');
    Route::post('/backend/store', '\Modules\UsersModule\Http\Controllers\UsersController@backend_store')->name('backend_store');

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
    }); //big events 

   Route::middleware(['auth', 'Rule:Super Admin,Admin'])->group( function($lang = null) {
    // Notifications_view

    Route::get('/notification', 'NotificationController@index')->name('notification');
    Route::post('/add_notification', 'NotificationController@add')->name('add_notification');
  }); //notification view rules


 });

//AHmed ALaa Test Routes 
Route::get("/test_not","HomeController@test_not");
Route::get("/mark_read/{id}","HomeController@mark_read");




