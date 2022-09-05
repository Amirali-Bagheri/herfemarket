<?php

use Modules\Setting\Http\Livewire\Admin\Settings;

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin',])
    ->group(function () {
        Route::get('/settings', Settings::class)->name('admin.settings.index');
    });
