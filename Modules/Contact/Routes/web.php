<?php

Route::prefix('admin')->namespace('Admin')->middleware(['web', 'auth', 'role:admin'])
    ->group(function () {
        Route::group(['prefix' => 'contacts'], function () {
            Route::any('/', 'ContactsController@index')->name('admin.contacts.index');
            Route::any('delete/{id}', 'ContactsController@delete')->name('admin.contacts.delete');
            Route::get('export', 'ContactsController@export')->name('admin.contacts.export');
            Route::any('deleteAll', 'ContactsController@deleteAll')->name('admin.contacts.deleteAll');
            Route::get('search', 'ContactsController@search')->name('admin.contacts.search');
        });
    });
