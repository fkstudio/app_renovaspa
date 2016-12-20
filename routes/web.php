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
| Home controller routes
|----------------------------------------------------------------------------
*/
Route::get('/home', [ 'as' => 'home.home', 'uses' => 'HomeController@home' ]);

Route::get('/about', [ 'as' => 'home.about', 'uses' => 'HomeController@about' ]);


/*
|----------------------------------------------------------------------------
| Category controller routes
|----------------------------------------------------------------------------
*/
Route::get('/region/{region_id}/categories', [ 'as' => 'category.categoryList', 'uses' => 'CategoryController@categories' ]);

Route::get('/hotel/{hotel_id}/categories', [ 'as' => 'category.categoriesByHotel', 'uses' => 'CategoryController@categoriesByHotel' ]);

/*
|----------------------------------------------------------------------------
| Services controller routes
|----------------------------------------------------------------------------
*/
Route::get('/category/{category_id}/services', [ 'as' => 'service.listByCategory', 'uses' => 'ServiceController@servicesByCategoryAndHotel' ]);


/*
|----------------------------------------------------------------------------
| Country controller routes
|----------------------------------------------------------------------------
*/
Route::get('/country/all', [ 'as' => 'country.all', 'uses' => 'CountryController@getAll' ]);

Route::get('/', [ 'as' => 'country.list', 'uses' => 'CountryController@countries' ]);

/*
|----------------------------------------------------------------------------
| Region controller routes
|----------------------------------------------------------------------------
*/
Route::get('/region/all/{country_id}', [ 'as' => 'region.all', 'uses' => 'RegionController@getAll' ]);

Route::get('/country/{country_id}/regions', [ 'as' => 'region.listByCountry', 'uses' => 'RegionController@regionsByCountry' ]);

/*
|----------------------------------------------------------------------------
| Hotel controller routes
|----------------------------------------------------------------------------
*/
Route::get('/hotel/details/{id}', [ 'as' => 'hotel.details', 'uses' => 'HotelController@details' ]);

Route::get('/hotel/all/{region_id}', [ 'as' => 'hotel.all', 'uses' => 'HotelController@getAll' ]);

Route::get('/region/{region_id}/hotels', [ 'as' => 'hotel.hotelsByRegion', 'uses' => 'HotelController@HotelsByRegion' ]);

/*
|----------------------------------------------------------------------------
| Reservation controller routes
|----------------------------------------------------------------------------
*/
Route::get('/reservation/bookhere', [ 'as' => 'reservation.bookhere', 'uses' => 'ReservationController@bookhere' ]);
