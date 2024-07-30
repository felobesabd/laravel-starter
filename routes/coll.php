<?php

Route::group([ 'namespace' => 'Collection',], function () {
    Route::get('/collection', 'CollectionController@index');
    Route::get('/getOffers', 'CollectionController@getOffers');
    Route::get('/getOffersFilter', 'CollectionController@getOffersFilter');
    Route::get('/getOffersTransform', 'CollectionController@getOffersTransform');
});
