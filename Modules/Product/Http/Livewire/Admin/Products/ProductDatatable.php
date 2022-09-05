<?php

namespace Modules\Product\Http\Livewire\Admin\Products;

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

class ProductDatatable extends BaseComponent
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
        if (!empty($this->brand_id)) {
            $brand = Brand::find($this->brand_id);
            return $brand->products()->withCount('visits')->withCount('prices')->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        }

        $query = Product::query();
        $final_query = $query;

        if (!empty($this->searchFilterBrands)) {
            $final_query = $query->whereIn('brand_id', collect($this->searchFilterBrands)->keys()->toArray());
//            $query = $query->whereHas('brand', function (Builder $q2) {
//              return  $q2->whereIn('id', collect($this->searchFilterBrands)->keys()->toArray());
//            });
        }

        if (!empty($this->searchFilterCategories)) {
            $final_query = $final_query->whereHas('categories', function (Builder $q3) {
                return $q3->whereIn('id', collect($this->searchFilterCategories)->keys()->toArray());
            });
        }

        if (!empty($this->searchFilterBusiness)) {
            $final_query = $final_query->whereHas('prices', function (Builder $q1) {
                return $q1->where('business_id', $this->searchFilterBusiness);
            });
        }

        if (!empty($this->search)) {
            $final_query = $final_query->whereLike('title', $this->search)->orWhereLike('en_title', $this->search);
        }

//        $this->items = $this->getQuery()
//            ->when(!empty($this->searchFilterBusiness), function ($q) {
//                $q->whereHas('prices', function (Builder $q1) {
//                    $q1->where('business_id', $this->searchFilterBusiness);
//                });
//            })
//            ->when(!empty($this->searchFilterBrands), function ($q) {
//                $q->whereHas('brand', function (Builder $q1) {
//                    $q1->where('id', collect($this->searchFilterBrands)->keys()->toArray());
//                });
//            })
//            ->when(!empty($this->searchFilterCategories), function ($q) {
//                $q->whereHas('categories', function (Builder $q1) {
//                    $q1->where('id', collect($this->searchFilterCategories)->keys()->toArray());
//                });
//            })
//            ->when(!empty($this->searchFilterStatus), function ($q) {
//                $q->where('status', $this->searchFilterStatus);
//            })
//            ->when(!empty($this->search), function ($q) {
//                $q->whereLike('title', $this->search)->orWhereLike('en_title', $this->search);
//            })
//           ;

        return $final_query->withCount('visits')->withCount('prices')->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');

//        if ($this->search) {
//            return Product::withCount('visits')->withCount('prices')->whereLike('title', $this->search)->orWhereLike('en_title', $this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->limit(200);
//
//        } else {
//        return Product::withCount('visits')->dontCache()->withCount('prices')->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
//        }
    }

    public function updateProductSearchFilterBrandQuerySearch()
    {
        $this->updateProductSearchFilterBrandsSuggestions = Brand::whereLike('title', $this->updateProductSearchFilterBrandQuery)->orWhereLike('en_title', $this->updateProductSearchFilterBrandQuery)
            ->get()
            ->pluck('title', 'id')
            ->toArray();

        $this->emit('refreshComponent');
    }

    public function selectFilterBrand($id)
    {
        $brand = Brand::find($id);
        if (!empty($this->updateProductSearchFilterBrands)) {
            $this->updateProductSearchFilterBrands[$id] = $brand->title;
            $this->updateProductSearchFilterBrandsSuggestions = [];
            $this->updateProductSearchFilterBrandQuery = null;
        }
    }

    public function removeFilterBrand($id)
    {
        unset($this->updateProductSearchFilterBrands[$id]);
    }

    public function searchFilterCategoryQuerySearch()
    {
        if (empty($this->searchFilterCategoryQuery)) {
            $this->searchFilterCategoriesSuggestions = Category::where('parent_id', 0)->orderBy('title')->get()->pluck('title', 'id')->toArray();
        } else {
            $this->searchFilterCategoriesSuggestions = Category::
//            search($this->category_search, function ($client, $body) {
//                $body->setSize(4000);
//                return $client->search(['index' => 'categories', 'body' => $body->toArray()]);
//            })
            search($this->searchFilterCategoryQuery)
//                         ->take(1000)
//                         ->must(new Matching('title', $this->category_search))
//                         ->must(new Matching('en_title', $this->category_search))

                ->get()->pluck('title', 'id')->toArray();
        }

//        $this->searchFilterCategoriesSuggestions = Category::whereLike('title', $this->searchFilterCategoryQuery)
//            ->get()
//            ->pluck('title', 'id')
//            ->toArray();
    }

    public function selectFilterCategory($id)
    {
        $brand = Category::find($id);
        $this->searchFilterCategories[$id] = $brand->title;
        $this->searchFilterCategoriesSuggestions = [];
        $this->searchFilterCategoryQuery = null;
    }

    public function removeFilterCategory($id)
    {
        unset($this->searchFilterCategories[$id]);
    }

    public function updateProduct()
    {
        try {
            if (!empty($this->selected)) {

                $products = Product::query()->whereIn('id', $this->selected);

                if ($this->updateProductRemoveBrand) {
                    $products->update([
                        'brand_id' => null
                    ]);
                } elseif (!empty($this->updateProductSearchFilterBrands)) {
                    $products->update([
                        'brand_id' => $this->updateProductSearchFilterBrands
                    ]);
                }


                if (!empty($this->updateProductSearchFilterCategories)) {

                    foreach ($products->get() as $product) {
                        $product->categories()->dontCache()->detach();
                        $product->categories()->dontCache()->attach($this->updateProductSearchFilterCategories);

                        $parent_ids = [];
                        foreach ($product->categories()->dontCache()->get() as $cat) {
                            $parent_ids[] = $cat->id;
                            $parent_ids[] = $cat->parents->pluck('id')->toArray();
                            $parent_ids = collect($parent_ids)->collapse()->unique()->values()->toArray();

                            $product->categories()->dontCache()->sync($parent_ids);
                        }

                        $product->save();

                    }

                    $this->alert('success', 'عملیات با موفقیت انجام شد', [
                        'position' => 'center',
                        'timer' => '2000',
                        'toast' => true,
                    ]);

                } else {
                    $this->alert('error', 'لطفا موردی را انتخاب کنید', [
                        'position' => 'center',
                        'timer' => '2000',
                        'toast' => true,
                    ]);
                }
                $this->emit('refreshComponent');
            }
        } catch (Throwable $ex) {
            throw $ex;
        }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
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

    public function deleteOldPrices()
    {

        $date = Carbon::today()->subDays(3);

        $prices = ProductPrices::query()->where('priced_at', '>=', $date)->get();
//        dd($prices,ProductPrices::query()->where('priced_at', '<', $date)->get());
        $prices->delete();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function deleteAll()
    {
        $productRepository = new ProductRepository();

//        $this->forgetComputed();
//        $this->resetPage();

        foreach (Product::whereIn('id', $this->selected)->get() as $product) {

//            $productRepository->deleteFull($product->id);
            RemoveFullProduct::dispatch($product->id);
        }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function destroy($id)
    {
        RemoveFullProduct::dispatch($id);
//        $productRepository = new ProductRepository();
//        $productRepository->deleteFull($id);

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function searchClick()
    {
        return $this->render();
        $query = Product::query();

//        $query = $this->getQuery();

        if (!empty($this->searchFilterBrands)) {
            $query = $query->whereIn('brand_id', collect($this->searchFilterBrands)->keys()->toArray());
//            $query = $query->whereHas('brand', function (Builder $q2) {
//              return  $q2->whereIn('id', collect($this->searchFilterBrands)->keys()->toArray());
//            });
        }

        if (!empty($this->searchFilterCategories)) {
            $query = $query->whereHas('categories', function (Builder $q3) {
                return $q3->whereIn('id', collect($this->searchFilterCategories)->keys()->toArray());
            });
        }

        if (!empty($this->searchFilterBusiness)) {
            $query = $query->whereHas('prices', function (Builder $q1) {
                return $q1->where('business_id', $this->searchFilterBusiness);
            });
        }

        if (!empty($this->search)) {
            $query = $query->whereLike('title', $this->search)->orWhereLike('en_title', $this->search);
        }

//        $this->items = $this->getQuery()
//            ->when(!empty($this->searchFilterBusiness), function ($q) {
//                $q->whereHas('prices', function (Builder $q1) {
//                    $q1->where('business_id', $this->searchFilterBusiness);
//                });
//            })
//            ->when(!empty($this->searchFilterBrands), function ($q) {
//                $q->whereHas('brand', function (Builder $q1) {
//                    $q1->where('id', collect($this->searchFilterBrands)->keys()->toArray());
//                });
//            })
//            ->when(!empty($this->searchFilterCategories), function ($q) {
//                $q->whereHas('categories', function (Builder $q1) {
//                    $q1->where('id', collect($this->searchFilterCategories)->keys()->toArray());
//                });
//            })
//            ->when(!empty($this->searchFilterStatus), function ($q) {
//                $q->where('status', $this->searchFilterStatus);
//            })
//            ->when(!empty($this->search), function ($q) {
//                $q->whereLike('title', $this->search)->orWhereLike('en_title', $this->search);
//            })
//           ;

        $this->items = $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
    }

    public function render()
    {
        return view('product::admin.products.livewire.datatable', [
            'products' => !empty($this->items) ? $this->items : $this->getQuery()->take(500)->paginate($this->perPage),
        ])->extends('admin.layouts.master', [
            'pageTitle' => 'مدیریت محصولات'
        ]);
    }

    public function searchFilterBrandQuerySearch()
    {
        $this->searchFilterBrandsSuggestions = Brand::whereLike('title', $this->searchFilterBrandQuery)->orWhereLike('en_title', $this->searchFilterBrandQuery)
            ->get()
            ->pluck('title', 'id')
            ->toArray();
    }

    public function updateProductSelectFilterBrand($id)
    {
        $brand = Brand::find($id);
        $this->updateProductSearchFilterBrands[$id] = $brand->title;
        $this->updateProductSearchFilterBrandsSuggestions = [];
        $this->updateProductSearchFilterBrandQuery = null;
    }

    public function updateProductRemoveFilterBrand($id)
    {
        unset($this->updateProductSearchFilterBrands[$id]);
    }

    public function updateProductSearchFilterCategoryQuerySearch()
    {
        $this->updateProductSearchFilterCategoriesSuggestions = Category::whereLike('title', $this->updateProductSearchFilterCategoryQuery)
            ->get()
            ->pluck('title', 'id')
            ->toArray();
    }

    public function updateProductSelectFilterCategory($id)
    {
        $brand = Category::find($id);
        $this->updateProductSearchFilterCategories[$id] = $brand->title;
        $this->updateProductSearchFilterCategoriesSuggestions = [];
        $this->updateProductSearchFilterCategoryQuery = null;
    }

    public function updateProductRemoveFilterCategory($id)
    {
        unset($this->updateProductSearchFilterCategories[$id]);
    }
}
