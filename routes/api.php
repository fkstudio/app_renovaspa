<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/async/categories/by/country/{country_id}', [ 'as' => 'category.getAll', 'uses' => 'CategoryController@getAll' ]);

Route::get('/async/region/by/country/{country_id}', [ 'as' => 'region.all', 'uses' => 'RegionController@getAll' ]);

Route::get('/async/hotel/by/region/{region_id}', [ 'as' => 'hotel.all', 'uses' => 'HotelController@getAll' ]);

Route::get('/async/wedding/packages/by/hotel/{hotel_id}', [ 'as' => 'wedding.packages', 'uses' => 'WeddingController@getWeddingPackagesByHotel' ]);
