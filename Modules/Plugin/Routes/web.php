<?php

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin', 'verifiedphone'])->group(function () {
    Route::any('/plugins', 'PluginController@index')->name('admin.plugins.index');

    Route::any('/plugins/update/{name}', 'PluginController@update')->name('admin.plugins.update');
    Route::any('/plugins/delete/{name}', 'PluginController@delete')->name('admin.plugins.delete');
});
