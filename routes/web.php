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

Route::get('/setlang/{locale?}', function($locale = 'en'){
	App::setLocale($locale);

	return redirect("/");
});

/*
|----------------------------------------------------------------------------
| Country controller routes
|----------------------------------------------------------------------------
*/
Route::get('/', [ 'as' => 'home.home', 'uses' => 'HomeController@home' ]);

/*
|----------------------------------------------------------------------------
| Country controller routes
|----------------------------------------------------------------------------
*/
Route::get('/country/all', [ 'as' => 'country.all', 'uses' => 'CountryController@getAll' ]);

/*
|----------------------------------------------------------------------------
| Hotel controller routes
|----------------------------------------------------------------------------
*/
Route::get('/hotel/details/{id}', [ 'as' => 'hotel.details', 'uses' => 'HotelController@details' ]);
