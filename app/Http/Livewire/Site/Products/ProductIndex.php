<?php

namespace App\Http\Livewire\Site\Products;

use Faker\Provider\Base;
use Livewire\WithPagination;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;

class ProductIndex extends BaseComponent
{
    use WithPagination;

    public function render()
    {
        return view('site.products.index', [
            'products'=>Product::where('status',1)->where('isService',0)->paginate(10)
        ])->extends('site.layouts.master', [
            'pageTitle' => 'محصولات',
        ]);
    }
}
