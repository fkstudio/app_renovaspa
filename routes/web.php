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


/*
|----------------------------------------------------------------------------
| Home controller routes
|----------------------------------------------------------------------------
*/
Route::get('/', [ 'as' => 'home.home', 'uses' => 'HomeController@home' ]);

Route::get('/pdf', [ 'as' => 'home.pdf', 'uses' => 'HomeController@createPDF' ]);

Route::get('/about', [ 'as' => 'home.about', 'uses' => 'HomeController@about' ]);

Route::get('/etiquette', [ 'as' => 'home.etiquette', 'uses' => 'HomeController@etiquette' ]);

Route::get('/faq', [ 'as' => 'home.faq', 'uses' => 'HomeController@faq' ]);

Route::get('/privacy-policy', [ 'as' => 'home.privacyPolicy', 'uses' => 'HomeController@privacyPolicy' ]);

Route::get('/legal-terms', [ 'as' => 'home.legalTerms', 'uses' => 'HomeController@legalTerms' ]);

Route::get('/refund', [ 'as' => 'home.refund', 'uses' => 'HomeController@refund' ]);

Route::get('/contact', [ 'as' => 'home.contact', 'uses' => 'HomeController@contact' ]);

Route::post('/send/contact/form', [ 'as' => 'home.sendContactForm', 'uses' => 'HomeController@sendContactForm' ])->middleware('recaptcha');

Route::post('/send/join/form', [ 'as' => 'home.sendJoinForm', 'uses' => 'HomeController@sendJoinToOurTeamForm' ])->middleware('recaptcha');

Route::get('/select/{selection}', [ 'as' => 'home.select', 'uses' => 'HomeController@select' ]);

Route::get('/services', [ 'as' => 'home.services', 'uses' => 'HomeController@services' ]);

Route::get('/certificates', [ 'as' => 'home.certificates', 'uses' => 'HomeController@certificates' ]);

Route::get('/weddings', [ 'as' => 'home.weddings', 'uses' => 'HomeController@weddings' ]);
/*
|----------------------------------------------------------------------------
| Category controller routes
|----------------------------------------------------------------------------
*/
Route::get('/region/{region_id}/categories', [ 'as' => 'category.categoryList', 'uses' => 'CategoryController@categories' ]);

Route::get('/hotel/{hotel_id}/categories/{next?}', [ 'as' => 'category.categoriesByHotel', 'uses' => 'CategoryController@categoriesByHotel' ]);

/*
|----------------------------------------------------------------------------
| Services controller routes
|----------------------------------------------------------------------------
*/
Route::get('/category/{category_id}/services', [ 'as' => 'service.listByCategory', 'uses' => 'ServiceController@servicesByCategoryAndHotel' ]);

Route::get('/reservation/service/delete/item/{id}', [ 'as' => 'service.deleteReservationItem', 'uses' => 'ServiceController@deleteReservationItem' ]);


/*
|----------------------------------------------------------------------------
| AddToCart controller routes
|----------------------------------------------------------------------------
*/
Route::post('/cart/add/services', [ 'as' => 'cart.addServices', 'uses' => 'ShoppingCartController@addToCart' ]);

Route::get('/shopping/cart', [ 'as' => 'cart.myCart', 'uses' => 'ShoppingCartController@myCart' ]);

Route::get('/shopping/cart/add/riu/package', [ 'as' => 'cart.addRiuPackage', 'uses' => 'ShoppingCartController@addRiuPackageToCart' ]);

Route::get('/shopping/cart/remove/item/{itemId}', [ 'as' => 'cart.removeItem', 'uses' => 'ShoppingCartController@removeItem' ]);

Route::match(['post', 'get'], '/shopping/cart/checkout', [ 'as' => 'cart.checkout', 'uses' => 'ShoppingCartController@checkout' ]);

/*
|----------------------------------------------------------------------------
| Country controller routes
|----------------------------------------------------------------------------
*/
Route::get('/country/all', [ 'as' => 'country.all', 'uses' => 'CountryController@getAll' ]);

Route::get('/countries', [ 'as' => 'country.list', 'uses' => 'CountryController@countries' ]);


/*
|----------------------------------------------------------------------------
| Certificate controller routes
|----------------------------------------------------------------------------
*/
Route::get('/certificate/options/{hotel_id}', [ 'as' => 'certificate.options', 'uses' => 'CertificateController@options' ]);

Route::post('/certificate/check/option', [ 'as' => 'certificate.checkOption', 'uses' => 'CertificateController@checkOption' ]);

Route::get('/certificate/registration', [ 'as' => 'certificate.registration', 'uses' => 'CertificateController@registration' ]);

Route::get('/reservation/certificate/delete/item/{id}/{referer}', [ 'as' => 'certificate.delete', 'uses' => 'CertificateController@deleteCertificate' ]);

/*
|----------------------------------------------------------------------------
| Region controller routes
|----------------------------------------------------------------------------
*/
Route::get('/async/region/by/country/{country_id}', [ 'as' => 'region.all', 'uses' => 'RegionController@getAll' ]);

Route::get('/country/{country_id}/regions', [ 'as' => 'region.listByCountry', 'uses' => 'RegionController@regionsByCountry' ]);

/*
|----------------------------------------------------------------------------
| Hotel controller routes
|----------------------------------------------------------------------------
*/
Route::get('/hotel/details/{id}', [ 'as' => 'hotel.details', 'uses' => 'HotelController@details' ]);

Route::get('/async/hotel/by/region/{region_id}', [ 'as' => 'hotel.all', 'uses' => 'HotelController@getAll' ]);

Route::get('/region/{region_id}/hotels', [ 'as' => 'hotel.hotelsByRegion', 'uses' => 'HotelController@HotelsByRegion' ]);

/*
|----------------------------------------------------------------------------
| Reservation controller routes
|----------------------------------------------------------------------------
*/
Route::get('/reservation/bookhere', [ 'as' => 'reservation.bookhere', 'uses' => 'ReservationController@bookhere' ]);

Route::get('/reservation/canceled', [ 'as' => 'reservation.canceled', 'uses' => 'ReservationController@canceled' ]);

Route::post('/reservation/select/book', [ 'as' => 'reservation.selectBook', 'uses' => 'ReservationController@selectBook' ]);

Route::match(['post', 'get'], '/reservation/checkout', [ 'as' => 'reservation.checkout', 'uses' => 'ReservationController@checkout' ]);




/*
|----------------------------------------------------------------------------
| Wedding controller routes
|----------------------------------------------------------------------------
*/
Route::get('/wedding/services', [ 'as' => 'wedding.services', 'uses' => 'WeddingController@weddingServices' ]);

Route::get('/async/wedding/packages/by/hotel/{hotel_id}', [ 'as' => 'wedding.packages', 'uses' => 'WeddingController@getWeddingPackagesByHotel' ]);

Route::get('/wedding/checkout', [ 'as' => 'wedding.checkout', 'uses' => 'WeddingController@checkout' ]);


Route::post('/wedding/send/quotation', [ 'as' => 'wedding.sendQuotation', 'uses' => 'WeddingController@sendQuotation' ]);

/*
|----------------------------------------------------------------------------
| Payment controller routes
|----------------------------------------------------------------------------
*/
Route::post('/payment', [ 'as' => 'payment.payment', 'uses' => 'PaymentController@payment' ]);

Route::get('/payment/gateway', [ 'as' => 'payment.gateway', 'uses' => 'PaymentController@gatewayPayment' ]);

Route::get('/payment/paypal', [ 'as' => 'payment.paypal', 'uses' => 'PaymentController@paypalPayment' ]);

Route::get('/payment/redsys', [ 'as' => 'payment.redsysPayment', 'uses' => 'PaymentController@redsysPayment' ]);

Route::post('/payment/gateway/proceed', [ 'as' => 'payment.execGatewayPayment', 'uses' => 'PaymentController@execGatewayPayment' ]);

Route::get('/payment/voucher', [ 'as' => 'payment.serviceVoucher', 'uses' => 'PaymentController@sendVoucher' ]);
