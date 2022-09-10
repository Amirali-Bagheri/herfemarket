<?php

// Route::middleware('auth')->group(function () {
//     Route::any('/dashboard/notifications', 'NotificationController@index')->name('dashboard.notifications');
// //    Route::any('/dashboard/notifications/markAsRead', 'NotificationController@markAsRead')->name('dashboard.notifications.markAsRead');
// //    Route::any('/show/{id}', 'NotificationController@show');
// });

use Modules\Notification\Http\Controllers\Site\NotificationController;
use Modules\Notification\Http\Livewire\Admin\Datatable;

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin'])->group(function () {
    Route::any('/notifications', Datatable::class)->name('admin.notifications.index');
    // Route::any('/notifications/create',\Modules\Notification\Http\Livewire\Admin\Create::class)->name('admin.notifications.create');
    // Route::any('/notifications/show/{id}', \Modules\Notification\Http\Livewire\Admin\Show::class)
    //      ->name('admin.notifications.show');

//    Route::any('/notifications/mark-all-read', [
//        NotificationController::class,
//        'markAllRead',
//    ])->name('admin.notifications.markAllRead');
//    Route::any('/notifications/mark-read/{id}', [
//        NotificationController::class,
//        'markRead',
//    ])->name('admin.notifications.markRead');
});
