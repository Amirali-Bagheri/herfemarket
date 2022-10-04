<?php

namespace App\Http\Livewire\Site\Businesses;

use Cart;
use Modules\Business\Entities\Business;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;

class BusinessShow extends BaseComponent
{
    public $business;

    public function mount($slug)
    {
        $this->business = Business::query()->where('status',1)->where('slug', $slug)->firstOrFail();
    }

    public function addToCart($id)
    {
        $shoppingCart = Cart::name('shopping');

        $product     = Product::find($id);
        $productItem = $shoppingCart->addItem([
            'id'         => $id,
            'title'      => $product->title,
            'quantity'   => 1,
            'price'      => $product->main_price,
            'extra_info' => [
                'date_time' => [
                    'added_at' => time(),
                ],
            ],
        ]);

        $this->alert('success', 'محصول مورد نظر به سبد خرید افزوده شد', [
            'timer'             => 3000,
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'toast'             => true,
            'position'          => 'bottom-start',
        ]);
    }

    public function render()
    {
        return view('site.businesss.show', [

        ])->extends('site.layouts.master', [
            'pageTitle' => 'کسب و کار ' . $this->business->title,
        ]);
    }
}
