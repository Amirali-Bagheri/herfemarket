<?php

namespace Modules\Product\Http\Livewire\Site;

use Jenssegers\Agent\Facades\Agent;
use Livewire\WithPagination;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;

class BrandProducts extends BaseComponent
{
    use WithPagination;

    public $url;
    public $business;
    public $sub_search = null;
    public $query;
    public $min_price_filter = 0;
    public $max_price_filter = 0;
    public $only_instock;
    public $only_discount;
    public $price_filter = false;
    public $search = null;
    public $brand_search = '';
    public $filter = '';
    public $brands_filter = [];
    public $perPage = 24;
    public $sortField;
    public $sortBy;
    public $sortAsc = true;
    public $columns = [];
    public $sortIcon = '&#8597;';
    public $sortAscIcon = '&#8593;';
    public $sortDescIcon = '&#8595;';
    public $readyToLoad = false;
    protected $updatesQueryString = ['search', 'brand_search'];

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadProducts()
    {
        $this->readyToLoad = true;
    }

    public function mount($url, $slug)
    {
        $this->url = $url;
        $this->brand= Brand::where('slug', $slug)->orWhere('title', $slug)->orWhere('en_title', $slug)->firstOrFail();
    }

    public function render()
    {
        $title = 'کالا های برند '.$this->brand->title;

        $category_url = Category::where('slug', $this->url)->firstOrFail();
        $ids = $category_url->products->pluck('id')->toArray();
        $products = Product::query()->whereIn('id', $ids)->where('brand_id', $this->brand->id)->paginate($this->perPage);

        $categories = Category::query()
            ->whereHas('products', function ($q2) use ($ids) {
                return $q2->whereIn('id', $ids);
            })
            ->cacheFor(3600 * 7 * 24)
            ->get()
            ->unique()
            ->values()
            ->sortByDesc('parent_id');


        if (Agent::isMobile()) {
            return view('product::mobile.products', [
                'products' => $products ?? collect([])->paginate($this->perPage),
                'category' => $category_url ?? null,
                'categories' => $categories ?? null,
            ])->extends('mobile.layouts.master', [
                'pageTitle' => $title,
            ]);
        }
        return view('product::site.products.livewire.products', [
            'products' => $this->readyToLoad ? $products : collect([])->paginate($this->perPage),
            'category_url' => $category_url ?? null,
            'categories' => $categories ?? null,
        ])->extends('site.layouts.master', [
            'pageTitle' => $title,
        ]);
    }
}
