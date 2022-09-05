<?php

use Modules\User\Http\Livewire\Admin\Create;
use Modules\User\Http\Livewire\Admin\Datatable;
use Modules\User\Http\Livewire\Admin\Show;
use Modules\User\Http\Livewire\Admin\Update;

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin'])
    ->group(function () {
        Route::group(['prefix' => 'users'], function () {
            Route::any('/', Datatable::class)->name('admin.users.index');
            Route::any('create', Create::class)->name('admin.users.create');
            Route::any('update/{id}', Update::class)->name('admin.users.update');
            Route::any('show/{id}', Show::class)->name('admin.users.show');
        });
    });
