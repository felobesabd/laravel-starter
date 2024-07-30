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

define('PAGINATION_COUNT', 3);
// Auth::routes();
Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/offer', 'CrudOfferController@getOffer');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {
        Route::group(['prefix' => 'offer'], function () {
            Route::get('/create', 'CrudOfferController@create');
            Route::get('/all', 'CrudOfferController@getAllOffer');
            Route::get('/edit/{id}', 'CrudOfferController@edit');
            Route::post('/update/{id}', 'CrudOfferController@update')->name('offer.update');
            Route::post('/store', 'CrudOfferController@store')->name('offer.store');
            Route::get('/delete/{id}', 'CrudOfferController@delete')->name('offer.delete');
            Route::get('/scope-status', 'CrudOfferController@getInactiveStatusOffers');
            Route::get('/scope-global-status', 'CrudOfferController@getGlobalInactiveStatusOffers');
        });

        Route::get('/youtube', 'EventsAndListenerController@getVideo')->middleware('auth');

    }
);


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

####################################           Start Ajax Offer           #####################################
Route::group(['prefix' => 'ajax-offer'], function () {
    Route::get('/create', 'CrudOfferAjaxController@create');
    Route::post('/store', 'CrudOfferAjaxController@store')->name('ajax.offer.store');
    Route::get('/all', 'CrudOfferAjaxController@all')->name('ajax.offer.all');
    Route::post('/delete', 'CrudOfferAjaxController@delete')->name('ajax.offer.delete');
    Route::get('/edit/{id}', 'CrudOfferAjaxController@edit')->name('ajax.offer.edit');
    Route::post('/update', 'CrudOfferAjaxController@update')->name('ajax.offer.update');
});

####################################           End Ajax Offer           ########################################

#####################################           Start Middleware           #####################################
Route::group([ 'namespace' => 'Auth', 'middleware' => ['auth', 'CheckAge'] ], function () {
    Route::get('/adult', 'CustomAuthController@adult')->name('permission.age');
});

Route::group([ 'namespace' => 'Auth',], function () {
    Route::get('/admin', 'CustomAuthController@admin')->name('admin')->middleware('auth:admin');
    Route::get('/site', 'CustomAuthController@site')->name('site')->middleware('auth:web');
    Route::get('/admin-login', 'CustomAuthController@adminLogin')->name('admin.login');
    Route::post('/admin-login', 'CustomAuthController@checkAdminLogin')->name('save.admin.login');
});

Route::get('/notAdult', function () {
    return 'not permission your age +18';
})->name('not.permission.age');

####################################           End Middleware           #######################################

/************************************* Start RelationShip *********************************************/

/************************************* Start Relations One-One ****************************************/
Route::group([ 'namespace' => 'Relation',], function () {
    Route::get('/has-one', 'RelationsController@hasOneRelation')->middleware('auth');
    Route::get('/has-one-reverse', 'RelationsController@hasOneReverseRelation');
    Route::get('/users-phones', 'RelationsController@getUsersPhones');
    Route::get('/users-not-phones', 'RelationsController@getUsersNotPhones');
});
/************************************* End Relations One-One ******************************************/

/************************************* Start Relations One-Many ***************************************/
Route::group([ 'namespace' => 'Relation',], function () {
    Route::get('/has-many', 'RelationsController@hasManyRelation');
    Route::get('/hospitals', 'RelationsController@hospitals');
    Route::get('/doctors/{id}', 'RelationsController@doctors')->name('doctors');
    Route::get('/hospitals-have-doctors', 'RelationsController@getHospitalsHaveDoctors');
    Route::get('/hospitals-not-have-doctors', 'RelationsController@getHospitalsNotHaveDoctors');
    Route::get('/male-doctors', 'RelationsController@getMaleDoctors');
});
/************************************* End Relations One-Many *****************************************/

/************************************* Start Relations Many-Many **************************************/
Route::group([ 'namespace' => 'Relation',], function () {
    Route::get('/doctor-services/{id}', 'RelationsController@getDoctorServices')->name('doctor.services');
    Route::get('/service-doctors', 'RelationsController@getServiceDoctors');
    Route::post('/save-services', 'RelationsController@createDoctorServices')->name('save.doctor.services');
});
/************************************* End Relations Many-Many ****************************************/

/************************************* Start Relations has-one-through **************************************/
Route::group([ 'namespace' => 'Relation',], function () {
    Route::get('/has-one-through', 'RelationsController@getPatientDoctor');
});
/************************************* End Relations has-one-through ****************************************/

/************************************* End RelationShip ***********************************************/

/************************************* Start Accessors&Mutators *********************************************/
Route::group(['namespace' => 'Relation'], function () {
    Route::get('/accessors', 'RelationsController@getDoctors');
});
/************************************* End Accessors&Mutators ***********************************************/
