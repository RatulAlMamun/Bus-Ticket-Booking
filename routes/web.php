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

// Route::get('/', function () {
//     return view('welcome');
// });


/*=========================================================================
                    FRONTEND ROUTES / BLADE VIEW
==========================================================================*/
Route::namespace('Frontend')->group(function () {
    Route::get('/', 'IndexController@index');
    Route::get('/booking/{bus_id}', 'BookingController@booking');
    Route::post('/booking/create', 'BookingController@create')->name('booking.create');

    // AJAX route for Seat History Query
    Route::post('/booking/seatquery', 'BookingController@seatqueryajax')->name('seat.query.submit');
});


/*=========================================================================
                    BACKEND ROUTES / BLADE VIEW
==========================================================================*/
Route::group(['prefix'=>'/admin', 'namespace'=>'Backend'], function () 
{
    Route::get('/login', 'AdminLoginController@indexview');

    Route::get('/register', 'AdminRegisterController@indexview');

    Route::get('/dashboard', 'DashboardController@indexview');

    Route::get('/booking/addbooking', 'BookingController@addbookingview');

    Route::get('/booking/view', 'BookingController@bookingview');

    Route::get('/booking/{id}/singleview', 'BookingController@singlebookingview');

    Route::get('/bus', 'BusController@indexview');

    Route::get('/counter', 'CounterController@indexview');

    Route::get('/supervisor', 'SupervisorController@indexview');

    Route::get('/profile', 'ProfileController@indexview');
    Route::post('/profile/update', 'ProfileController@profileupdate')->name('profile.update');
    Route::post('/profile/passwordupdator', 'ProfileController@changepassword')->name('password.change');

    Route::get('/search', 'SearchController@indexview');
    Route::post('/search/routequery', 'SearchController@routequeryajax')->name('road.getval');
    Route::post('/search/seatquery', 'SearchController@seatqueryajax')->name('seat.query');



    /* DATA INSERTING - EDITING - DELETING ROUTE */
    // Booking Resources
    Route::post('/booking/addbooking/create', 'BookingController@create')->name('addbooking.create');
    Route::get('/booking/approved/{id}', 'BookingController@approved')->name('booking.approved');
    Route::get('/booking/delete/{id}', 'BookingController@destroy')->name('booking.destroy');
    Route::get('/booking/return/{id}', 'BookingController@return')->name('booking.return');
    // Counter Resources
    Route::post('/counter/create', 'CounterController@create')->name('counter.create');
    Route::post('/counter/edit', 'CounterController@edit')->name('counter.edit');
    Route::get('/counter/delete/{id}', 'CounterController@destroy')->name('counter.destroy');

    // Bus Resources
    Route::post('/bus/create', 'BusController@create')->name('bus.create');
    Route::post('/bus/edit', 'BusController@edit')->name('bus.edit');
    Route::get('/bus/delete/{id}', 'BusController@destroy')->name('bus.destroy');
    Route::get('/busroute/delete/{id}', 'BusController@routedestroy')->name('busroute.destroy');
    //Bus Route Resources
    Route::post('/bus/routecreate', 'BusController@routecreate')->name('bus.route.create');
    
    // Supervisor Resources
    Route::post('/supervisor/create', 'SupervisorController@create')->name('supervisor.create');
    Route::post('/supervisor/edit', 'SupervisorController@edit')->name('supervisor.edit');
    Route::get('/supervisor/delete/{id}', 'SupervisorController@destroy')->name('supervisor.destroy');
});


/*=========================================================================
                    CUSTOMERS ROUTES / BLADE VIEW
==========================================================================*/
Route::prefix('/customer')->group(function () 
{
    Route::get('/dashboard', 'Customer\DashboardController@indexview');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
