<?php

namespace Modules\Business\Http\Livewire\Site;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Jenssegers\Agent\Facades\Agent;
use Modules\Brand\Entities\Brand;
use Modules\Business\Entities\Business;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;

class BusinessProducts extends BaseComponent
{
    public $business;
    public $query;
    public $min_price_filter = 0;
    public $max_price_filter = 0;
    public $price_filter = false;
//    public $max_all_products_price;
    public $search = '';
    public $brand_search = '';
    public $filter = '';
    public $brands_filter = [];
    public $page = 1;
    public $perPage = 50;
    public $sortField;
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


    public function loadMore()
    {
        $this->perPage += $this->perPage;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingBrandsFilter()
    {
        $this->resetPage();
    }

    public function deleteBrandFilter($id)
    {
        $this->brands_filter = array_diff($this->brands_filter, [$id]);
    }

    public function getUpdatesQueryString()
    {
        return;
    }

    public function priceFilter()
    {
        $this->price_filter = true;
    }

    public function initializeWithPagination()
    {
        Paginator::currentPageResolver(function () {
            return $this->page;
        });

        Paginator::defaultView($this->paginationView());
    }

    public function loadProducts()
    {
        $this->readyToLoad = true;
    }


    public function mount($slug)
    {
        $this->business = Business::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $business = $this->business;
        $search = convert2english($this->search);
        $brands_filter = $this->brands_filter;
        $price_filter = $this->price_filter;
        $min_price_filter = $this->min_price_filter;
        $max_price_filter = $this->max_price_filter;
        $brand_search = $this->brand_search;
        $sortField = $this->sortField;
        $sortAsc = $this->sortAsc;
        $pricing_status = $business->pricing_status;

        if ($pricing_status == 1) {
            $prices = $business->prices()->orderBy('stock', 'desc')->orderBy('price', 'asc');
            $query = $business->products();
        } else {
            $prices = collect([]);
            $query = collect([]);
        }
        $products = $query->when(!empty($search), function ($query) use ($search) {
            $matching = Product::search($search)->get()->pluck('id');
            Meta::setTitleSeparator('-')->setTitle('جستجوی ' . $search)->prependTitle(Setting::get('seo_meta_title'));
            $title = 'جستجو در کالا ها';

            $query->whereIn('id', $matching);
        })
            ->when(!empty($brands_filter), function ($query) use ($brands_filter) {
                $query->whereIn('brand_id', $brands_filter);
            })
            ->when(!empty($price_filter), function ($query) use ($min_price_filter, $max_price_filter) {
                $query->whereHas('prices', function (Builder $q) use ($min_price_filter, $max_price_filter) {
                    if (isset($min_price_filter)) {
                        $q->where('price', '>=', $min_price_filter);
                    }
                    if (isset($max_price_filter)) {
                        $q->where('price', '<=', $max_price_filter);
                    }
                });
            })
            ->paginate($this->perPage);

        $this->max_price_filter = $products->getCollection()->pluck('max_price')->max();


        $brands =
            Brand::whereIn('id', $products->getCollection()->pluck('brand_id'))
                ->when($brand_search, function ($query) use ($brand_search) {
                    $matching = Brand::search($brand_search)->get()->pluck('id');
                    $query->whereIn('id', $matching);
                })->orderBy('title')->get();

        if ($products->count() == 1) {
            $this->redirect(route('site.products.single', $products->first()->slug));
        }

        Meta::setTitleSeparator('-')->setTitle('کالا های کسب و کار ' . $business->name)->prependTitle(Setting::get('seo_meta_title'));

        if (!Agent::isMobile()) {
            return view('product::site.products.livewire.products', compact('business', 'products', 'prices'))
                ->extends('site.layouts.master');
        }
        return view('product::mobile.products', compact('business', 'products', 'prices'))
                ->extends('mobile.layouts.master', [
                    'title' => 'کالا های کسب و کار ' . $business->name
                ]);
    }
}
