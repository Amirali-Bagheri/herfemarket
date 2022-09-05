<?php

Route::prefix('admin')->namespace('Admin')->middleware(['web', 'auth', 'role:admin', 'verifiedphone'])->group(function () {
    Route::group(['prefix' => 'seo'], function () {
        Route::any('/', 'SeoController@index')->name('admin.seo.index');
        Route::any('/google-pages', 'SeoController@google_pages')->name('admin.seo.google_pages');
        Route::any('/google-serp', 'SeoController@google_serp')->name('admin.seo.google_serp');
        Route::any('/backlinks', 'SeoController@backlinks')->name('admin.seo.backlinks');
//        Route::any('/links', 'SeoController@links')->name('admin.seo.links');
//        Route::any('/sitemap', 'SeoController@sitemap')->name('admin.seo.sitemap');
        Route::any('/alexa', 'SeoController@alexa')->name('admin.seo.alexa');
        Route::any('/alexa/top', 'SeoController@alexaTopSites')->name('admin.seo.topSites');
//        Route::any('create', 'SeoController@create')->name('admin.seo.create');
//        Route::any('update/{id}', 'SeoController@update')->name('admin.seo.update');
//        Route::any('delete/{id}', 'SeoController@destroy')->name('admin.seo.delete');
//        Route::any('deleteAll', 'SeoController@deleteAll')->name('admin.seo.deleteAll');
//        Route::get('export', 'SeoController@export')->name('admin.seo.export');
//        Route::post('import', 'SeoController@import')->name('admin.seo.import');
//        Route::get('search', 'SeoController@search')->name('admin.seo.search');
//        Route::any('show/{id}', 'SeoController@show')->name('admin.seo.show');
    });

//    Route::get('/health/status', "HealthCheckerController@index");
//    Route::get('/health/{checker}/status', "HealthCheckerController@show");
//    Route::get('/healthy', "HealthCheckerController@index");
//    Route::get('/ready', "HealthCheckerController@index");
});
