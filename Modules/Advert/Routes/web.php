<?php

Route::prefix('admin')->namespace('Admin')->middleware(['web', 'auth', 'role:admin'])->group(function () {
    Route::group(['prefix' => 'ads'], function () {
        Route::any('/', 'AdsController@index')->name('admin.ads.index');
        Route::any('create', 'AdsController@create')->name('admin.ads.create');
        Route::any('update/{id}', 'AdsController@update')->name('admin.ads.update');
        Route::any('delete/{id}', 'AdsController@destroy')->name('admin.ads.destroy');
        Route::any('deleteAll', 'AdsController@deleteAll')->name('admin.ads.deleteAll');
//        Route::get('export', 'AdsController@export')->name('admin.ads.export');
//        Route::post('import', 'AdsController@import')->name('admin.ads.import');
        Route::get('search', 'AdsController@search')->name('admin.ads.search');
        Route::any('show/{id}', 'AdsController@show')->name('admin.ads.show');
    });
});
