<?php

use Modules\Payment\Http\Livewire\Admin\InvoiceList;
use Modules\Payment\Http\Livewire\Admin\InvoiceShow;
use Modules\Payment\Http\Livewire\Admin\PaymentList;
use Modules\Payment\Http\Livewire\Admin\PaymentShow;

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin',])
     ->group(function () {
         Route::group(['prefix' => 'payments'], function () {
             Route::any('/', PaymentList::class)->name('admin.payments.index');
             Route::any('show/{id}', PaymentShow::class)->name('admin.payments.show');
         });

         Route::group(['prefix' => 'invoices'], function () {
             Route::any('/', InvoiceList::class)->name('admin.invoices.index');
             Route::any('show/{id}', InvoiceShow::class)->name('admin.invoices.show');
         });
     });
