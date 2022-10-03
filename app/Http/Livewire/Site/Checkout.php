<?php

namespace App\Http\Livewire\Site;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;

class Checkout extends BaseComponent
{

    public function render()
    {

        return view('site.checkout',[
            'cart'=>\Cart::name('shopping'),
            'items'=>\Cart::name('shopping')->getItems()
        ])->extends('site.layouts.master', [
            'pageTitle' => 'جزئیات سفارش',
        ]);
    }
}
