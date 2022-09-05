<?php

namespace Modules\Category\Http\Livewire;

use App\Exports\DatatableExport;
use App\Models\Cache;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;
use Modules\Product\Imports\ProductsImport;
use Modules\Product\Repository\ProductRepositoryInterface;

class Show extends BaseComponent
{
    use WithPagination;
    use WithFileUploads;

    public $category;
    public $query;
    public $search = '';
    public $page = 1;
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $columns = [];
    public $tableClass = 'table';
    public $sortIcon = '&#8597;';
    public $sortAscIcon = '&#8593;';
    public $sortDescIcon = '&#8595;';
    public $selected = [];
    public $import;

    public function cacheSlider()
    {
        $id = $this->category->id;
        $category = Category::find($id);
        $subCategories = $category->getAllChildren()->pluck('id')->merge($category->id);

        $products =

            Product::whereHas('categories', function ($q) use ($subCategories) {
                $q->whereIn('categories.id', $subCategories);
            })
                ->where('status', 1)
//                ->whereHas('prices', function ($q) {
//                    $q->whereHas('business', function ($query) {
//                        $query->where('status', 1)->where('pricing_status', 1);
//                    })->where('stock', 1);
//                })
//                    ->has('prices')
//                    ->with('visits')
                ->withCount('visits')
//                    ->withCount('prices')
//                    ->withCount([
//                        'prices',
//                        'prices as prices_count' => function ($query) {
////                                $query->where('prices_count', '>', 5);
//                            $query->where('price', '>', 1000);
//                        }])
                ->withCount('prices')
                ->orderBy('visits_count', 'desc')
                ->orderBy('prices_count', 'desc')
                ->whereHas('prices', function (\Illuminate\Database\Eloquent\Builder $query) {
                    $query->where('price', '>', 1000);
                })

                ->offset(0)
                ->limit(15)
                ->take(15)
                ->get()
                ->except('categories', 'prices', 'brand_id', 'status', 'code', 'excerpt', 'properties', 'property_json', 'created_by', 'created_at', 'updated_at', 'has_prices')
                ->sortByDesc('min_price')
                ->values()
                ->toArray();

        Cache::updateOrCreate([
            'key' => 'shago_cache_products_slider_category_' . $id
        ], [
            'value' => json_encode($products),
//                    'expiration' => Carbon::now()->addDays(1)->unix()
        ]);


        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function mount($id)
    {
        $this->category = Category::find($id);


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

    public function toggleSelectAll()
    {
        if (count($this->selected) === Product::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Product::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Product::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()), date('Ymd') . '_crawled_products.xlsx');
    }

    public function import()
    {
        $this->forgetComputed();
        $this->validate([
            'import' => 'mimes:xlsx,csv|max:10024',
        ]);

        Excel::import(new ProductsImport(), $this->import);

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function deleteAllProducts(ProductRepositoryInterface $productRepository)
    {
        foreach ($this->category->products as $product) {
            $productRepository->deleteFull($product->id);
        }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function deleteAll(ProductRepositoryInterface $productRepository)
    {
        $this->forgetComputed();
        $this->resetPage();

        dd($this->selected);
        foreach (Product::whereIn('id', $this->selected)->get() as $product) {
            $productRepository->deleteFull($product->id);
        }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function destroy($id, ProductRepositoryInterface $productRepository)
    {
        $productRepository->deleteFull($id);

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('category::livewire.show', [
            'products' => $this->getQuery()
        ])->extends('admin.layouts.master');
    }

    public function getQuery()
    {
        if ($this->search) {
            return $this->category->products()->search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }
        return $this->category->products()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
    }

    //$category = Category::firstWhere('slug', $slug);
//
//$categories = Category::all();
//
//$products = $category->products;
//
//$children = $category->children;
//return view('category::admin.show', compact('category', 'categories', 'products', 'children'));
}
