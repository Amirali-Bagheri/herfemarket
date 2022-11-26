<?php

namespace Modules\Product\Http\Livewire\Admin\Services;

use App\Exports\DatatableExport;
use App\Jobs\RemoveFullProduct;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductPrices;
use Modules\Product\Imports\ProductsImport;
use Modules\Product\Repository\Eloquent\ProductRepository;
use const Throwable;

class ServiceDatatable extends BaseComponent
{
    use WithFileUploads;

    use WithPagination;

    public $query;
    public $brand_id;
    public $search = '';
    public $page = 1;
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = false;
    public $columns = [];
    public $tableClass = 'table';
    public $sortIcon = '&#8597;';
    public $sortAscIcon = '&#8593;';
    public $sortDescIcon = '&#8595;';
    public $selected = [];
    public $import;
    public $action_status;

    public $searchFilterBrandQuery;
    public $searchFilterBrandsSuggestions = [];
    public $searchFilterBrands = [];

    public $searchFilterCategoryQuery;
    public $searchFilterCategoriesSuggestions = [];
    public $searchFilterCategories = [];

    public $searchFilterStatus;
    public $searchFilterBusiness;
    public $searchFilterCreatedAtFrom;
    public $searchFilterCreatedAtTo;

    public $isUpdatingProduct = false;
    public $updateProductRemoveBrand = false;

    public $updateProductSearchFilterBrandQuery;
    public $updateProductSearchFilterBrandsSuggestions = [];
    public $updateProductSearchFilterBrands;
    public $updateProductSearchFilterCategoryQuery;
    public $updateProductSearchFilterCategoriesSuggestions = [];
    public $updateProductSearchFilterCategories;

    private $items = [];

    public function mount($brand_id = null)
    {
        $this->brand_id = $brand_id;


//        if (empty($this->search)) {
//            $this->products = $this->getQuery()->take(500)->paginate($this->perPage);
//        }
    }

    public function removeSearchFilterBrands()
    {
        $this->searchFilterBrands = null;
        $this->searchFilterBrandQuery = null;
        $this->searchFilterBrandsSuggestions = [];

        $this->updateProductSearchFilterBrands = null;
        $this->updateProductSearchFilterBrandQuery = null;
        $this->updateProductSearchFilterBrandsSuggestions = [];
    }

    public function updateProductRemoveSearchFilterBrands()
    {
        $this->updateProductSearchFilterBrands = null;
        $this->updateProductSearchFilterBrandQuery = null;
        $this->updateProductSearchFilterBrandsSuggestions = [];
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

    public function toggleSelectAll()
    {
        if (count($this->selected) === $this->getQuery()->count()) {
            $this->selected = [];
        } else {
            $this->selected = $this->getQuery()->get()->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function getQuery()
    {


        $query = Product::query()->where('isService',1);
        $final_query = $query;


        if (!empty($this->search)) {
            $final_query = $final_query->whereLike('title', $this->search)->orWhereLike('en_title', $this->search);
        }


        return $final_query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
    }


    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Product::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()), date('Ymd') . '_crawled_products.xlsx');
    }



    public function deleteAll()
    {
        $productRepository = new ProductRepository();

//        $this->forgetComputed();
//        $this->resetPage();

        foreach (Product::whereIn('id', $this->selected)->get() as $product) {

           $productRepository->deleteFull($product->id);
        }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function destroy($id)
    {
        // RemoveFullProduct::dispatch($id);
       $productRepository = new ProductRepository();
       $productRepository->deleteFull($id);

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function render()
    {
        return view('product::admin.services.datatable', [
            'products' => !empty($this->items) ? $this->items : $this->getQuery()->take(500)->paginate($this->perPage),
        ])->extends('admin.layouts.master', [
            'pageTitle' => 'مدیریت محصولات'
        ]);
    }




}
