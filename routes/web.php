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
    // return view('welcome');
    return redirect()->route('login');
});

// Auth::routes();

Route::get('/intro', function () {
    return view('welcome');
    // return redirect()->route('login');
});

Route::get('login', 'HomeController@login')->name('login');
Route::get('register', 'HomeController@register')->name('register');
Route::get('home', 'HomeController@index')->name('home');
Route::get('info', 'HomeController@info')->name('info');
Route::get('profile', 'HomeController@profile')->name('profile');
Route::get('package', 'HomeController@package')->name('package');
Route::get('ala_carte', 'HomeController@ala_carte')->name('ala_carte');

Route::post('user/login', 'UserController@loginPost');
Route::post('user/register', 'UserController@registerPost');
Route::get('product/package', 'UserController@package');
Route::get('product/ala_carte', 'UserController@ala_carte');
Route::get('busy', 'UserController@busy');
Route::post('profile', 'UserController@profile');
Route::post('available-time', 'UserController@available_time');
Route::post('booking', 'UserController@booking');
Route::post('booking_history', 'UserController@booking_history');