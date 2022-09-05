<?php

namespace Modules\Product\Http\Livewire\Admin\Products;

use Livewire\Component;
use Modules\Product\Entities\Product;

class Show extends Component
{
    public $product;

    public function mount($id)
    {
        $this->product = Product::where('id', $id)->orWhere('slug', $id)->first();
    }

    public function render()
    {
//        dd($this->product->crawled_product);
        return view('product::livewire.admin.show')->extends('admin.layouts.master', [
            'pageTitle'=>'مشاهده محصول '.$this->product->title,
        ]);
    }
}
