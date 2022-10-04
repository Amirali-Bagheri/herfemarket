<?php

namespace App\Http\Livewire\Site\Services;

use Cart;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;

class ProductShow extends BaseComponent
{
    public $product;

    public function mount($slug)
    {
        $this->product = Product::query()->where('status', 1)->where('isService', 1)->where('slug', $slug)->firstOrFail();
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
        return view('site.services.show', [
            'related_products' => $this->product->categories()->first()->products()->where('status', 1)->where('isService', 1)
                                                ->take(6)->get(),
        ])->extends('site.layouts.master', [
            'pageTitle' => $this->product->title,
        ]);
    }
}
