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

// Auth::routes();
Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/{username}', function ($username) {
//    return 'hello '. $username;
//});

// Route parameters

Route::get('/user1/{username}', function ($username) {
    return 'hello '. $username;
}) -> name('a');

Route::get('/user2/{username?}', function () {
    return 'hello';
})->name('b');

Route::resource('news', 'NewsController');



//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
