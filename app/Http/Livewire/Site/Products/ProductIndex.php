<?php

namespace App\Http\Livewire\Site\Products;

use Cart;
use Livewire\WithPagination;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;

class ProductIndex extends BaseComponent
{
    use WithPagination;

    public $search;
    protected $queryString = ['search'];

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
        return view('site.products.index', [
            'products' => Product::where('status', 1)->where('isService', 0)->whereLike('title', $this->search)->paginate(10),
        ])->extends('site.layouts.master', [
            'pageTitle' => 'محصولات',
        ]);
    }
}
