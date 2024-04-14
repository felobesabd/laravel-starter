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

Route::get('admin/admin', function () {
    return 'welcome';
});

//Route::namespace('Front')->group(function () {
//    // all routes only access controller or methods in folder name Front
//    Route::get('users', 'UserController@showUserName');
//});

Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {

    Route::get('/', function () {
        return 'work';
    });

    Route::get('/show', 'UserController@showUserName');
    Route::post('/create', 'UserController@showUserName');
    Route::put('/update', 'UserController@showUserName');
});

Route::group(['namespace' => 'Front'], function () {
    Route::get('/get0', 'SecondController@msg0')->middleware('auth');
    Route::get('/get1', 'SecondController@msg1');
    Route::get('/get2', 'SecondController@msg2');
});

//Route::get('login', function () {
//   return 'must be login';
//})->name('login');

Route::namespace('Front')->group(function () {
    // all routes only access controller or methods in folder name Front
    Route::get('get-view', 'UserController@getViewFromController');
});

Route::get('landing', function () {
    return view('landing');
});
