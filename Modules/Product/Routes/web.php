<?php

use Modules\Product\Http\Controllers\Admin\ProductController;
use Modules\Product\Http\Controllers\Admin\PropertiesController;
use Modules\Product\Http\Livewire\Admin\Prices\Prices;
use Modules\Product\Http\Livewire\Admin\Prices\PricesShow;
use Modules\Product\Http\Livewire\Admin\Prices\PricesUpdate;
use Modules\Product\Http\Livewire\Admin\Products\Show;
use Modules\Product\Http\Livewire\Admin\ProductChecker;
use Modules\Product\Http\Livewire\Admin\Products\ProductCreate;
use Modules\Product\Http\Livewire\Admin\Products\ProductDatatable;
use Modules\Product\Http\Livewire\Admin\Products\ProductUpdate;

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin', 'verifiedphone'])
    ->group(function () {
        Route::group(['prefix' => 'products'], function () {
            Route::any('/', ProductDatatable::class)->name('admin.products.index');
            Route::any('create', ProductCreate::class)->name('admin.products.create');
            Route::any('update/{id}', ProductUpdate::class)->name('admin.products.update');
//            Route::any('delete/{id}', 'ProductController@destroy')->name('admin.products.delete');
//            Route::any('deleteAll', 'ProductController@deleteAll')->name('admin.products.deleteAll');
//            Route::get('export', 'ProductController@export')->name('admin.products.export');
//            Route::post('import', 'ProductController@import')->name('admin.products.import');
//            Route::post('delete_property_value', 'ProductController@deletePropertyValue')->name('admin.products.deletePropertyValue');
//            Route::any('table_action', 'ProductController@table_action')->name('admin.products.table_action');

//            Route::get('search', 'ProductController@search')->name('admin.products.search');
            Route::any('show/{id}', Show::class)->name('admin.products.show');

            Route::any('images/upload', [ProductController::class, 'storeMedia'])->name('products.images.upload');
            Route::get('/{id}/image/{name}/delete', [ProductController::class, 'deleteMedia'])->name('products.images.delete');
        });

    });
