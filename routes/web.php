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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);
//Route::auth();
Route::get('/home', 'HomeController@show')->name('home');
Route::get('/profile','ProfileController@show')->name('profile');
Route::get('/newpost','NewPostController@show')->name('newpost');
Route::post('/newpost', 'NewPostController@input')->name('newpost');
