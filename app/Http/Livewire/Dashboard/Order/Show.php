<?php

namespace App\Http\Livewire\Dashboard\Order;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Payment\Entities\Invoice;

class Show extends BaseComponent
{
    public $invoice;
    public $user;
    public $business;
    public $legal_person = 0;

    public function mount($number)
    {
        $this->invoice = Invoice::query()->where('invoice_number', $number)->firstOrFail();
    }

    public function render()
    {
        // return view('payment::livewire.admin.invoice-show', [
            return view('livewire.dashboard.order.show', [
        ])->extends('site.layouts.master', [
            'pageTitle' => 'جزئیات سفارش',
        ]);
    }
}
