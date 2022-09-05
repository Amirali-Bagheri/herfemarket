<?php


//use Modules\Admin\Http\Livewire\Dashboard;

//Route::prefix('admin')->middleware(['web', 'auth', 'role:admin', 'verifiedphone'])
//    ->group(function () {

use Modules\Admin\Http\Livewire\Dashboard;

Route::any('/admin', Dashboard::class)->name('admin.index')->middleware(['web', 'auth', 'role:admin', 'verifiedphone']);

//    });
