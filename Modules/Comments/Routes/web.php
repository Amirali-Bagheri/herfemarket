<?php

use Modules\Comments\Http\Livewire\Admin\Datatable;
use Modules\Comments\Http\Livewire\Admin\Update;

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin',])
     ->group(function () {
         Route::group(['prefix' => 'comments'], function () {
             Route::any('/', Datatable::class)->name('admin.comments.index');
             Route::any('/update/{id}', Update::class)->name('admin.comments.update');
             // Route::any('update/{id}', 'CommentsController@update')->name('comments.update');
             Route::any('delete/{id}', 'CommentsController@delete')->name('comments.delete');
             // Route::get('export', 'CommentsController@export')->name('comments.export');
             // Route::any('deleteAll', 'CommentsController@deleteAll')->name('comments.deleteAll');
             // Route::get('search', 'CommentsController@search')->name('comments.search');
             // Route::post('reply', 'CommentsController@reply')->name('comments.reply');
         });
     });
