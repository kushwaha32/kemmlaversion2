<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Product related routes
Route::group(['as' => 'product.'], function(){
    Route::get('/', 'ProductController@show')->name('show');
    Route::get('/product/{slug}', 'ProductController@productDetail')->name('detail');
});
// Cart related routes
Route::group(['as' => 'cart.'], function(){
     Route::get('/add_to_cart/{id}', 'ProductController@addCart')->name('add');
     Route::group(['middleware' => 'auth'], function(){
          Route::post('/cart/remove/{product}', 'ProductController@removeCart')->name('remove');
          Route::get('/cart/shipping_address', 'ProductController@shippingAddress')->name('shipping');
          Route::post('/cart/shipping_address/save', 'ProductController@shippingAddressSave')->name('shipping.save');
          Route::get('/cart/pament_method', 'ProductController@pamentMethod')->name('pament');
          Route::post('/cart/creat_order', 'OrderController@store')->name('order.store');
          Route::get('/cart', 'ProductController@showCart')->name('show');

          // payumoney routes
          Route::get('payumoney', 'PayumoneyController@payumoneyPayment')->name('payumoney');
          Route::post('payumoney/response', 'PayumoneyController@payumoneyResponse')->name('payumoney.response');
     });
    
});

// rating and review related route
Route::group(['middleware' => 'auth'], function(){
       Route::get('/showRating', 'ReviewController@showRating')->name('showSating');
       Route::post('/rating', 'ReviewController@storeRating')->name('rating');
       Route::post('/review', 'ReviewController@storeReview')->name('review');
       
});
Route::get('/avgRating', 'ReviewController@avgRating')->name('avgRating');

Route::group(['as' => 'admin.'], function(){
     Route::group(['middleware' => 'admin.guest'], function(){
        Route::view('admin/login', 'admin.auth.login')->name('login'); 
        Route::post('admin/login', 'AdminController@login')->name('auth');
    });
     Route::group([ 'middleware' => 'admin.auth'], function(){
        Route::get('/admin', 'AdminController@dashboard')->name('dashboard');
        Route::POST('admin/logout', 'AdminController@logout')->name('logout');
        // Category related routes
        Route::get('category/{category}/remove', 'CategoryController@remove')->name('category.remove');
        Route::get('category/trash', 'CategoryController@trash')->name('category.trash');
        Route::get('category/recovercat/{id}', 'CategoryController@recovercat')->name('category.recovercat');
        Route::resource('category', 'CategoryController');
        // Product related routes
        Route::get('product/{product}/remove', 'ProductController@remove')->name('product.remove');
        Route::get('product/trash', 'ProductController@trash')->name('product.trash');
        Route::get('product/recoverpro/{id}', 'ProductController@recoverpro')->name('product.recoverpro');
        Route::resource('product', 'ProductController');
        // Customers related routes
        Route::get('state/{id?}', 'ProfileController@state')->name('state');
        Route::get('city/{id?}', 'ProfileController@cities')->name('city');
        Route::get('customer/remove/{id}', 'ProfileController@remove')->name('customer.remove');
        Route::get('customer/trash', 'ProfileController@trash')->name('customer.trash');
        Route::get('customer/recoverCustomer/{id}', 'ProfileController@recoverCustomer')->name('customer.recoverCustomer');
        Route::resource('customer', 'ProfileController');
     });
});
