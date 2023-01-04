<?php

namespace App\Http\Livewire\Dashboard\Order;

use Modules\Business\Entities\Business;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Payment\Entities\Invoice;

class IndexBusinessOrders extends BaseComponent
{
    public function render()
    {
        $user = auth()->user();
        $business          = $user->business;

        $orders = Invoice::whereHas('lines', function ($q_line) use ($business) {
            return $q_line->whereHas('product', function ($q_product) use ($business) {
                return $q_product->where('business_id', $business->id);
            });
        })->paginate(10);

        return view('livewire.dashboard.order.index', [
            'orders' => $orders,
        ])->extends('site.layouts.master', [
            'pageTitle' => 'فهرست  سفارشات کسب و کار',
        ]);
    }
}
