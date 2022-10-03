<?php

namespace App\Http\Livewire\Site\Products;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;

class ProductShow extends BaseComponent
{
    public $product;

    public function mount($slug)
    {
        $this->product = Product::query()->where('slug', $slug)->firstOrFail();
        Meta::setTitleSeparator('-')->setTitle('ویرایش محصول')->prependTitle(Setting::get('seo_meta_title'));
    }

    public function render()
    {
        return view('site.products.show', [
            'related_products' => $this->product->categories()->first()->products()->where('status', 1)->where('isService', 0)
                                                ->take(6)->get(),
        ])->extends('site.layouts.master', [
            'pageTitle' => 'داشبورد',
        ]);
    }
}
