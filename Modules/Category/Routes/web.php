<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Livewire\Create;
use Modules\Category\Http\Livewire\Datatable;
use Modules\Category\Http\Livewire\Show;

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin',])
    ->group(function () {
        Route::group(['prefix' => 'categories'], function () {
            Route::any('/', Datatable::class)->name('admin.categories.index');
            Route::any('/create', Create::class)->name('admin.categories.create');
            Route::any('/update/{slug}', \Modules\Category\Http\Livewire\Update::class)->name('admin.categories.update');
            Route::any('/show/{id}', Show::class)->name('admin.categories.show');
        });
    });
