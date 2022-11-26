<?php

use Modules\Product\Http\Livewire\Admin\Products\ProductUpdate;
use Modules\Product\Http\Livewire\Admin\Services\ServiceUpdate;
use Modules\Product\Http\Livewire\Admin\Products\ProductDatatable;
use Modules\Product\Http\Livewire\Admin\Services\ServiceDatatable;

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin'])
    ->group(function () {
        Route::group(['prefix' => 'products'], function () {
            Route::any('/', ProductDatatable::class)->name('admin.products.index');
            Route::any('update/{id}', ProductUpdate::class)->name('admin.products.update');
        });

        Route::group(['prefix' => 'services'], function () {
            Route::any('/', ServiceDatatable::class)->name('admin.services.index');
            Route::any('update/{id}', ServiceUpdate::class)->name('admin.services.update');
        });
    });
