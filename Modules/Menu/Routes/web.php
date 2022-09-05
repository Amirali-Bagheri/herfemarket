<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\Menu\Http\Livewire\Admin\Create;
use Modules\Menu\Http\Livewire\Admin\Datatable;
use Modules\Menu\Http\Livewire\Admin\SubMenuCreate;
use Modules\Menu\Http\Livewire\Admin\SubMenuDatatable;
use Modules\Menu\Http\Livewire\Admin\SubMenuUpdate;
use Modules\Menu\Http\Livewire\Admin\Update;

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin'])
    ->group(function () {
        Route::group(['prefix' => 'menus'], function () {
            Route::any('/', Datatable::class)->name('admin.menus.index');
            Route::any('/create', Create::class)->name('admin.menus.create');
            Route::any('/update/{slug}', Update::class)->name('admin.menus.update');

            // Menus
            //            Route::get('/', [MenuController::class, 'index'])->name('admin.menus.index');
            //             Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('admin.menus.edit');
            //             Route::put('/edit/{id}', [MenuController::class, 'update'])->name('admin.menus.update');
            //             Route::get('/create', [MenuController::class, 'create'])->name('admin.menus.create');
            //             Route::post('/create', [MenuController::class, 'store'])->name('admin.menus.store');
            //             Route::post('/delete/{id}', [MenuController::class, 'destroy'])->name('admin.menus.delete');

            // Sub Menus
            Route::prefix('sub_menus/{slug}')->group(function () {
                Route::get('/', SubMenuDatatable::class)->name('admin.sub_menus.index');
                Route::get('/update/{id}', SubMenuUpdate::class)
                    ->name('admin.sub_menus.update');
                Route::get('/create', SubMenuCreate::class)->name('admin.sub_menus.create');
            });
        });
    });
