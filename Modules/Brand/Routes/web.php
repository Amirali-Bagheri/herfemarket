<?php

use Modules\Brand\Http\Livewire\Admin\Create;
use Modules\Brand\Http\Livewire\Admin\Datatable;
use Modules\Brand\Http\Livewire\Admin\Show;
use Modules\Brand\Http\Livewire\Admin\Update;

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin', 'verifiedphone'])
    ->group(function () {
        Route::group(['prefix' => 'brands'], function () {
            Route::any('/', Datatable::class)->name('admin.brands.index');
            Route::any('create', Create::class)->name('admin.brands.create');
            Route::any('update/{id}', Update::class)->name('admin.brands.update');
            Route::any('show/{id}', Show::class)->name('admin.brands.show');
        });
    });
