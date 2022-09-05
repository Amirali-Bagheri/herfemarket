<?php

namespace Modules\Product\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;

class ProductsController extends Controller
{
    public function products(Request $request, $url)
    {
        $search = $request->query('search', null);
        if (empty($url) and !empty($search)) {
//            $matching = Product::search($search)->get()->pluck('id');
            $product_ids = Product::search($search)->get()->pluck('id')->toArray();
//            $product_ids = Product::search($search)->toSimpleArray('id');
            $title = 'جستجو در کالا ها';
//            $query = Product::active()->whereIn('id', $matching);

            $this->resetPage();
        } elseif (!empty($url)) {
            $category = Category::firstWhere('slug', $url);

            if (!empty($category)) {
                $subCategories = $category->getAllChildren()->pluck('id')->merge($category['id']);

//                $query = Product::active()->whereHas('categories', function ($query) use ($subCategories) {
//                    $query->whereIn('categories.id', $subCategories);
//                });

                $title = 'کالاهای دسته ' . $category->title;

                $product_ids = Product::active()
                    ->select("id")
                    ->whereHas('categories', function ($query) use ($subCategories) {
                        $query->whereIn('categories.id', $subCategories);
                    })
//                    ->cacheFor(3600 * 24)
//                    ->get()
                    ->toSimpleArray('id');
            } else {
                $brand = Brand::firstWhere('slug', $url);

                if (!empty($brand)) {
                    $product_ids = $brand->products()->active()
                        ->cacheFor(3600 * 24)
//                    ->get()
                        ->toSimpleArray('id');

//                    $query = $brand->products()->active();
//
//                $brands =
//                    Brand::whereIn('id', $query->pluck('brand_id'))
//                        ->when($brand_search, function ($query) use ($brand_search) {
//                            $matching = Brand::search($brand_search)->get()->pluck('id');
//                            $query->whereIn('id', $matching);
//                        })->orderBy('title')->get();

                    $title = 'کالاهای برند ' . $brand->title;
                }
            }
        }

        $per_page = 30;
        $page = Paginator::resolveCurrentPage('page');
        $product_ids_this_page = array_slice($product_ids, ($per_page * ($page-1)), $per_page);

        // now load the products
        if (count($product_ids_this_page) > 0) {
            $placeholder = implode(', ', array_fill(0, count($product_ids_this_page), '?'));
            $itemsThisPage = Product::query()
                ->whereIntegerInRaw('products.id', $product_ids_this_page)
                ->with(['brand'])
                ->select("products.*")
                ->orderByRaw("FIELD(products.id, ".$placeholder.")", $product_ids_this_page)
                ->cacheFor(3600 * 24)
                ->get();
        } else {
            // no items on this page
            $itemsThisPage = collect();
        }

        $products = \Illuminate\Container\Container::getInstance()->makeWith(LengthAwarePaginator::class, [
            'items' => $itemsThisPage,
            'total' => count($product_ids),
            'perPage' => $per_page,
            'currentPage' => $page,
            'options' => [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        ])->withQueryString();

        return view('product::site.products.products', [
            'products'=>$products
        ]);
    }
}
