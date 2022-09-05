<?php

namespace Modules\Product\Http\Livewire\Site;

use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;

class Categories extends BaseComponent
{
    public function render()
    {
//        $categories = Category::active()->with([
//            'products' => function ($query) {
//                return $query->cacheTags(["book:{$bookId}:author"]);
//            },
//        ])->get();

        $categories = Category::active()->where('parent_id', 0)
//            ->withCount(['products'=>function ($query) {
//                return $query->cacheFor(3600 * 24 * 7);
//            }])
            ->get();

        $title = 'دسته بندی کالاها';
        $products_query_type = 'category';
        if (\Jenssegers\Agent\Facades\Agent::isMobile()) {
            return view('product::mobile.categories', [
                'categories' => $categories ?? null,
            ])->extends('mobile.layouts.master', [
                'pageTitle'=>'دسته بندی کالاها'
            ]);
        }
        return view('site.categories', [
                'categories' => $categories ?? null,
            ])->extends('site.layouts.master', [
                'pageTitle'=>'دسته بندی کالاها'
            ]);
    }
}
