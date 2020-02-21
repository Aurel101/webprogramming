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

Route::get('/', 'MainPageController@show');

Auth::routes(['verify'=>true]);
//Route::auth();
Route::get('home', 'HomeController@show')->name('home');
Route::get('profile','ProfileController@show')->name('profile');
Route::get('newpost','NewPostController@show')->name('newpost');
Route::post('newpost', 'NewPostController@input')->name('newpost');
Route::get('books/{id}','PostsController@show');
Route::get('compare', 'CompareController@show')->name('compare');
Route::post('compare','CompareController@compare');
Route::get('cart','CartController@show');
Route::post('cart','CartController@cart');
Route::get('modifypost/{id}', 'ModifyPostController@show');
Route::post('modifypost/{id}','ModifyPostController@modify');
Route::get('deletepost/{id}','ModifyPostController@delete');
Route::get('newaddress','AddressController@shownew');
Route::post('newaddress','AddressController@make');
Route::get('modifyaddress/{id}','AddressController@showmodify');
Route::post('modifyaddress/{id}','AddressController@modify');
Route::get('deleteaddress/{id}','AddressController@delete');
Route::get('checkout','CartController@showcheckout');
Route::post('checkout','CartController@checkout');
Route::post('mobile','MobileController@process');
