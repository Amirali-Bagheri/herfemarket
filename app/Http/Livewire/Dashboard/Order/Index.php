<?php

namespace App\Http\Livewire\Dashboard\Order;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Payment\Entities\Invoice;

class Index extends BaseComponent
{
    public function render()
    {
        $user = auth()->user();
        $orders = Invoice::where('user_id', $user->id)->paginate(10);

        return view('livewire.dashboard.order.index', [
            'orders' => $orders,
        ])->extends('site.layouts.master', [
            'pageTitle' => 'فهرست سفارشات',
        ]);
    }
}
