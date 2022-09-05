<?php


Route::prefix('admin')->namespace('Admin')->middleware(['web', 'auth', 'role:admin', 'verifiedphone'])->group(function () {
    Route::group(['prefix' => 'sliders'], function () {
        Route::any('/', 'SliderController@index')->name('admin.sliders.index');
        Route::any('create', 'SliderController@create')->name('admin.sliders.create');
        Route::any('update/{id}', 'SliderController@update')->name('admin.sliders.update');
        Route::any('delete/{id}', 'SliderController@destroy')->name('admin.sliders.destroy');
        Route::any('deleteAll', 'SliderController@deleteAll')->name('admin.sliders.deleteAll');
        Route::get('export', 'SliderController@export')->name('admin.sliders.export');
        Route::post('import', 'SliderController@import')->name('admin.sliders.import');
        Route::get('search', 'SliderController@search')->name('admin.sliders.search');
        Route::any('show/{id}', 'SliderController@show')->name('admin.sliders.show');
    });
});
