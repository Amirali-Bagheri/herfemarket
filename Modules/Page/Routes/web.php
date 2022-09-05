<?php

use Illuminate\Support\Facades\Route;
use Modules\Page\Http\Controllers\Site\PageController;
use Modules\Page\Http\Livewire\Admin\Create;
use Modules\Page\Http\Livewire\Admin\Datatable;
use Modules\Page\Http\Livewire\Admin\Update;

// Route::any('/page/{slug}', Page::class)->name('site.page.show');

Route::namespace('Site')->group(function () {
    Route::any('/page/{slug}/{language?}', [PageController::class, 'show'])->name('site.page.show');
});

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin',])
    ->group(function () {
        Route::group(['prefix' => 'pages'], function () {
            Route::any('/', Datatable::class)->name('admin.pages.index');
            Route::any('/create', Create::class)->name('admin.pages.create');
            Route::any('/update/{id}', Update::class)->name('admin.pages.update');
        });
    });


//Route::prefix('admin')->namespace('Modules\Page\Http\Controllers\Admin')->middleware(['web', 'auth', 'role:admin', ])->group(function () {
//    Route::any('/pages/', 'PageController@index')->name('admin.pages.index');
//    Route::any('/pages/create', 'PageController@create')->name('admin.pages.create');
//    Route::any('/pages/update/{id}', 'PageController@update')->name('admin.pages.update');
//    Route::any('/pages/delete/{id}', 'PageController@destroy')->name('admin.pages.destroy');
//});
