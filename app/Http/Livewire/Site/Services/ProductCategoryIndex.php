<?php

namespace App\Http\Livewire\Site\Services;

use Livewire\WithPagination;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;

class ProductCategoryIndex extends BaseComponent
{
    use WithPagination;

    public $category;

    public function mount($slug)
    {
        $this->category = Category::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('site.products.index', [
            'products' => $this->category->prodcuts()->where('status', 1)->where('isService', 1)->paginate(10),
        ])->extends('site.layouts.master', [
            'pageTitle' => 'خدمات دسته '.$this->category->title,
        ]);
    }
}
