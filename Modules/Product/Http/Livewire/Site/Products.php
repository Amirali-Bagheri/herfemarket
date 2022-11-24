<?php

namespace Modules\Product\Http\Livewire\Site;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Jenssegers\Agent\Facades\Agent;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Brand\Entities\Brand;
use Modules\Business\Entities\Business;
use Modules\Category\Entities\Category;
use Modules\Landing\Entities\Landing;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductPrices;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;
use Throwable;
use Illuminate\Support\Facades\View;

class Products extends Component
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

    public function loadMore()
    {
        $this->perPage += 25;
    }

    public function mount($url = null): void
    {
        ini_set('memory_limit', '-1');

        $this->url = $url;
        $this->search = request()->query('search', $this->search);
        $this->sub_search = request()->query('sub_search', $this->sub_search);
        $this->page = request()->query('page', $this->page);

        $this->business = request()->query('business', $this->business);

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

    public function updatingSubSearch()
    {
        $this->resetPage();
    }

    public function updatingBrandsFilter()
    {
        $this->resetPage();
//        $this->dispatchBrowserEvent('addQueryString', ['queryKey' => 'brand', 'queryValue' => implode(',',$this->brands_filter)]);
//        $this->updating('brand', implode(',',$this->brands_filter));
    }

    public function deleteBrandFilter($id)
    {
        $this->brands_filter = array_diff($this->brands_filter, [$id]);
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

    public function render()
    {
        ini_set('memory_limit', '-1');

        $url = $this->url;
        $search = persian_number_to_english($this->search);
        $sub_search = persian_number_to_english($this->sub_search);
        $brands_filter = $this->brands_filter;
        $price_filter = $this->price_filter;
        $min_price_filter = $this->min_price_filter;
        $max_price_filter = $this->max_price_filter;
        $brand_search = $this->brand_search;
        $sortField = $this->sortField;
        $sortAsc = $this->sortAsc;
        $filter = $this->filter;

        $category_url = null;
        $brand_url = null;
        $landing_category_url = null;
        $landing_brand_url = null;
        $ids = [];

        if (empty($url) and empty($search) and empty($this->business)) {
            $categories = Cache::rememberForever('categories', function () {
                return Category::active()->where('parent_id', 0)
                    ->withCount('products')
//                    ->withCount(['products' => function ($query) {
//                        $query->cacheFor(3600 * 24 * 7);
//                    }])
                    ->get();
            });

            $title = 'دسته بندی کالاها';
            $products_query_type = 'category';
            if (Agent::isMobile()) {
                return view('product::mobile.categories', [
                    'categories' => $categories ?? null,
                ])->extends('mobile.layouts.master', [
                    'pageTitle' => $title
                ]);
            }
            return view('site.categories', [
                'categories' => $categories ?? null,
            ])->extends('site.layouts.master', [
                'pageTitle' => $title
            ]);
        }

//        if (empty($url) and empty($search)) {
//            $categories = Category::active()->where('parent_id', 0)->withCount('products')->get();
//            $title = 'دسته بندی کالاها';
//            $products_query_type = 'category';
//            if (Agent::isMobile()) {
//                return view('product::mobile.categories', [
//                    'categories' => $categories ?? null,
//                ])->extends('mobile.layouts.master', [
//                    'pageTitle' => $title
//                ]);
//            }
//
//            return view('site.categories', [
//                'categories' => $categories ?? null,
//            ])->extends('site.layouts.master', [
//                'pageTitle' => $title
//            ]);
//        }

        if (!empty($url)) {
            $category_url = Category::where('slug', $url)->first();
            $brand_url = Brand::where('title', $url)->orWhere('slug', $url)->orWhere('en_title', $url)->first();

            if (empty($search) and empty($category_url) and empty($brand_url)) {
                $this->redirect(route('site.products'));
            }

            if (empty($search)) {
                if (!empty($brand_url)) {
                    $landing_brand_url = Landing::where('type', 'brand')->where('landingable_id', $brand_url->id)->first();
                    $landing_blade_view = 'brand_' . $brand_url->id;
                } elseif (!empty($category_url)) {
                    $landing_category_url = Landing::where('type', 'category')->where('landingable_id', $category_url->id)->first();
                    $landing_blade_view = 'category_' . $category_url->id;
                }
                $landing_final = ($landing_category_url ?? $landing_brand_url) ?? null;
                if (!empty($landing_final)) {
                    if ($landing_final->title) {
                        Meta::setTitleSeparator('-')->setTitle($landing_final->title)->prependTitle(Setting::get('seo_meta_title'));
                    }

                    try {
                        $visit = new_visit($landing_final, [
                            'url' => route('site.landing.show', ['slug', $landing_final->slug]),
                        ]);
                    } catch (Throwable $ex) {
                    }

//                Meta::setMetaFrom($landing_final);
                    if (isset($landing_blade_view) and !View::exists($landing_blade_view)) {
                        $landing_blade_view = 'main_landing_slider';
                    }

                    if (Agent::isMobile()) {
                        return view('mobile.landings.' . $landing_blade_view, [
                            'category' => $category_url,
                            'brand' => $brand_url,
                        ])->extends('mobile.layouts.master');
                    }

                    return view('landings.' . $landing_blade_view, [
                        'category' => $category_url,
                        'brand' => $brand_url,
                    ])->extends($landing_final->blade_extends ?? 'site.layouts.master');
                }
            }
        } elseif (!empty($search)) {
            $category_url = Category::query()->where('title', $search)->orWhere('slug', $search)->first();
            $brand_url = Brand::query()->where('title', $search)->orWhere('slug', $search)->orWhere('en_title', $search)->first();
        }
//        var_dump($category_url->title ?? '');

        $query = Product::query();

        $ids = [];
        if (!empty($search)) {
            if (empty($this->sortBy)) {
                $this->sortBy = 'related';
            }
            $q = $this->escapeElasticReservedChars($search);

            $ids = Product::search('', function ($client, $body) use ($q, $search) {
                return $client->search([
//                    'body' => [
//                        'query' => [
//                            'bool' => [
//                                'must' => [
////                                "query_string" => [
////                                    "query" => $q,
////                                    "fields" => [
////                                        "title",
////                                        "en_title",
////                                    ],
////                                    "fuzziness" => "AUTO",
////                                ]
////                            ],
//                                    "fuzzy" => [
//                                        "title" => [
//                                            "value"=> $q
//                                        ]
//                                    ]
//                                ],
//                                'should' => [
//                                    [
//                                        "multi_match" => [
//                                            "query" => $q,
//                                            "type" => "cross_fields",
//                                            "fields" => [
//                                                "title",
//                                                "en_title"
//                                            ]
//                                        ],
//                                    ],
//                                    [
//                                        'match' => [
//                                            "field" => "title"
//                                        ]
//                                    ],
//                                    [
//                                        'match' => [
//                                            "operator" => "and"
//                                        ]
//                                    ],
//                                    [
//                                        'match_phrase' => [
//                                            "field" => "title"
//                                        ]
//                                    ],
//                                    [
//                                        'match' => [
//                                            "operator" => "or"
//                                        ]
//                                    ]
//                                ],
//
//                                /*'must' => [
//
//
//
//                                "query_string" => [
//                                    "query" => $q,
//                                    "fields" => [
//                                        "title",
//                                        "en_title",
//                                    ],
//                                    "fuzziness" => "AUTO",
//                                ]
////                            ],
////                                    "fuzzy" => [
////                                        "title" => [
////                                            "value" => $q
////                                        ]
////                                    ]
//                                ],
//                                'should' => [
////                                    "multi_match" => [
////                                        "query" => $q,
////                                        "type" => "cross_fields", "fields" => [
////                                            "title^2", "en_title","brand.title"
////                                        ],
////                                    ],
////                                    "query_string" => [
////                                        "query" => $q,
////                                        "fields" => [
////                                            "title",
////                                            "en_title",
////                                        ],
////                                        "fuzziness" => "AUTO",
////                                    ],
//                                    [
//                                        "multi_match" => [
//                                            "query" => $q,
//                                            "type" => "cross_fields",
//                                            "fields" => [
//                                                "title^2", "en_title","brand.title"
//                                            ],
//                                            "boost" =>2.
//                                        ],
//                                    ],
//                                    [
//                                        'match' => [
//                                            "field" => "title"
//                                        ]
//                                    ],
//                                    [
//                                        'match' => [
//                                            "operator" => "and"
//                                        ]
//                                    ],
//                                    [
//                                        'match_phrase' => [
//
//                                            "title" => [
//                                                "query" => $q,
////                                                "boost"=>2
//
//                                            ],
//                                        ]
//                                    ],
//                                    [
//                                        'match_phrase' => [
//
//                                            "brand.title" => [
//                                                "query" => $q,
////                                                "boost"=>2
//
//                                            ],
//                                        ]
//                                    ],
//
//                                    [
//                                        'match' => [
//                                            "operator" => "or"
//                                        ]
//                                    ],
//                                    [
//                                        'match_phrase' => [
//                                            "field" => "en_title"
//                                        ]
//                                    ],
//                                ],*/
//                                /*    'must' => [
//                                        "query_string" => [
//                                            "query" => $q,
//                                            "fields" => [
//                                                "title",
//                                                "en_title",
//                                            ],
//                                            "fuzziness" => "AUTO",
//                                        ]
//                                    ],
//                                    'should' => [
//                                        [
//                                            "multi_match" => [
//                                                "query" => $q,
//                                                "type" => "cross_fields",
//                                                "fields" => [
//                                                    "title",
//                                                    "en_title"
//                                                ]
//                                            ],
//                                        ],
//                                        [
//                                            'match' => [
//                                                "field" => "title"
//                                            ]
//                                        ],
//                                        [
//                                            'match' => [
//                                                "operator" => "and"
//                                            ]
//                                        ],
//                                        [
//                                            'match_phrase' => [
//                                                "field" => "title"
//                                            ]
//                                        ],
//                                        [
//                                            'match' => [
//                                                "operator" => "or"
//                                            ]
//                                        ],
//                                        [
//                                            'match_phrase' => [
//                                                "field" => "en_title"
//                                            ]
//                                        ],
//    //                                    [
//    //                                        'match' => [
//    //                                            'category_id' => [
//    //                                                'query' => 3,
//    //                                            ]
//    //                                        ]
//    //                                    ],
//
//                                    ],*/
////                                'should' => [
////                                    [
////                                        'query_string' => [
////                                            'query' => "\"$q\""
////                                        ],
////                                        'match' => [
////                                            'query' => "\"$q\"",
////                                            'field'=>'title'
////                                        ]
////                                    ]
////                                ] ,
//                            ]
//                        ]
////                        "query" => [
////                            "bool"=>[
////                                "query_string" => [
////                                    "query" => $q,
////                                    "fields" => [
////                                        "title",
////                                        "en_title",
////                                    ],
////                                    "fuzziness" => "AUTO",
////                                ],
////                            ]
////
//////                            [
//////                                "match" => [
//////                                    "field" => "title"
//////                                ]
//////                            ],
//////                            [
//////                                "match" => [
//////                                    "operator" => "and"
//////                                ]
//////                            ],
//////                            [
//////                                "match_phrase" => [
//////                                    "field" => "title"
//////                                ]
//////                            ]
////                        ],
//                    ],
                    'body' => [
//                        "sort" => [
////                            ["prices_count" => ["order" => "desc", "unmapped_type" => "long"]]
//                            ["has_prices" => ["order" => "desc", "unmapped_type" => "long"]]
//                        ],
                        'query' => [
                            'bool' => [
                                'must' => [
//                                    "fuzzy" => [
//                                        "title" => [
//                                            "value" => $q
//                                        ]
//                                    ],
                                    "query_string" => [
                                        "query" => $q
//                                            .'~'
                                        ,

                                        "fields" => [
                                            "title",
                                            "en_title",
                                        ],
                                        "fuzziness" => "AUTO",
                                    ]
                                ],
                                'should' => [
//                                    [
//                                        "fuzzy" => [
//                                            "title" => [
//                                                "value" => $q
//                                            ]
//                                        ],
//                                    ],
//                                    [
//                                        'match' => [
//                                            "operator" => "or"
//                                        ]
//                                    ],
                                    [
                                        "match" => ["brand_title" => ["query" => $q]]
                                    ],
                                    [
                                        'match' => [
                                            "operator" => "or"
                                        ]
                                    ],
                                    [
                                        "match" => ["category_title" => ["query" => $q]]
                                    ],
////                                    [
//                                        "multi_match" => [
//                                            "query" => $q,
//                                            "type" => "cross_fields",
//                                            "fields" => [
//                                                "title",
//                                                "en_title"
//                                            ]
//                                        ],
//                                    ],
//                                    [
//                                        'match' => [
//                                            "field" => "title"
//                                        ]
//                                    ],
//                                    [
//                                        'match' => [
//                                            "operator" => "and"
//                                        ]
//                                    ],
//                                    [
//                                        'match_phrase' => [
//                                            "field" => "title"
//                                        ]
//                                    ],
//                                    [
//                                        'match_phrase' => [
//                                            "field" => "brand.title"
//                                        ]
//                                    ],
//                                    [
//                                        'match' => [
//                                            "operator" => "or"
//                                        ]
//                                    ],
//                                    [
//                                        'match_phrase' => [
//                                            "field" => "en_title"
//                                        ]
//                                    ],
                                ],
                            ]
                        ]
                    ],
                    "from" => 0,
                    "size" => 10000,
                ]);
            })
//                 ->within(implode(',', [
//                     (new Category())->searchableAs(),
//                     (new Brand())->searchableAs(),
//                 ]))
                ->get()->pluck('id')->toArray();
        }

        $query =

            $query
                ->when(!empty($this->business), function ($query) {
                    $business = Business::where('slug', $this->business)->orWhere('name', $this->business)->orWhere('id', $this->business)->firstOrFail();
                    $query->whereHas('prices', function ($q) use ($business) {
                        $q->where('business_id', $business->id);
                    });
                })
                ->when(!empty($url) and !empty($brand_url), function ($q1) use ($brand_url) {
                    $q1->where('brand_id', $brand_url->id);
                })
                ->when(!empty($ids), function ($q3) use ($ids, $search) {
                    $ids_ordered = implode(',', $ids);

                    $q3->whereIn('id', $ids);
                })
                ->when(empty($ids) and empty($url), function ($query) use ($search) {
                    try {
                        $query->whereLike('title', $search);
                    } catch (Throwable $ex) {
                        return;
                    }
                })
                ->when(!empty($this->sub_search), function ($query) use ($sub_search) {
                    try {
                        $query->whereLike('title', $sub_search)->orWhereLike('en_title', $sub_search);
                    } catch (Throwable $ex) {
                        return;
                    }
                })
                ->when(!empty($price_filter), function (Builder $query) use ($min_price_filter, $max_price_filter) {
                    $query->whereHas('prices', function (Builder $q) use ($min_price_filter, $max_price_filter) {
                        if (isset($min_price_filter)) {
                            $q->where('stock', 1)->where('price', '>=', $min_price_filter);
                        }
                        if (isset($max_price_filter)) {
                            $q->where('stock', 1)->where('price', '<=', $max_price_filter);
                        }
                    });
                })
                ->when(isset($this->only_instock) and (bool)$this->only_instock, function (Builder $query) {
                    $query->whereHas('prices', function (Builder $q) {
                        $q->where('stock', 1)->where('price', '>', 0);
                    });
                })
                ->when(isset($this->only_discount) and (bool)$this->only_discount, function (Builder $query) {
                    $query->whereHas('prices', function (Builder $q) {
                        $q->where('stock', 1)->where('price', '>', 0)->whereNotNull('discount_value');
                    });
                })


//                ->withCount('prices')
//                ->withCount('visits')
//                ->when(!empty($sort_field), function ($q) use ($sort_field) {
//                    $q->orderBy($sort_field, 'desc');
//                })
//            ->dontCach
//e()
//                ->when(!empty($products_has_prices_ids_ordered), function ($query) use ($products_has_prices_ids_ordered) {
//                    $query->orderByRaw(DB::raw("FIELD(id, $products_has_prices_ids_ordered) desc"));
//                })
//                
        ;
//        $products_ids = $query->get(['id'])->pluck('id')->unique()->toArray();


        $brands = [];
        if (!empty($brand_url)) {
            $products_ids = $query->pluck('id')->unique()->toArray();
        } else {
            $get_products_ids = $query->pluck('id', 'brand_id')->unique()->toArray();
            $brand_ids = collect($get_products_ids)->keys()->unique()->values();
            $products_ids = collect($get_products_ids)->values()->unique()->values();
//        $products_ids = $query->get('id')->modelKeys();

//            dd($brand_ids);

            $brands = Brand::query()
////            ->whereIn('id', $query->get()->pluck('brand_id')->unique()->toArray())
                ->whereIn('id', $brand_ids)
                ->when(!empty($brand_search), function ($query) use ($brand_search) {
                    $query->whereLike('title', $brand_search);

//            ->when(!empty($brand_search), function ($query) use ($brand_search) {
////            if (isset($brand_search)) {
////                $matching = Brand::search($brand_search)->get()->pluck('id');
////                $query->whereIn('id', $matching);
////            }
                })
                ->orderBy('title')
//                
//                ->cacheFor(3600 * 7 * 24)
                ->get();
        }

        if (!empty($brands_filter)) {
            $query = $query->whereIn('brand_id', $brands_filter);

            $products_ids = $query->pluck('id')->unique()->toArray();
        }


        /*        $query = $query->when(!empty($brands_filter), function ($query) use ($brands_filter) {
                    $query->whereIn('brand_id', $brands_filter);

                });
        */

//        $categories= [];
//        $brands = [];

//        dd($query->get()->pluck());

//        if (empty($this->sortBy)) {
//            $this->sortBy = 'price_desc';
//        }
//        if (empty($this->sub_search)) {
//            $this->sub_search = $this->search;
//        }
        ////        dd($products);
        ///
        if (!empty($url) and !empty($category_url) and $category_url->parent_id != 0) {
            $categories = $category_url
                ->children()
                ->whereHas('products', function ($q2) use ($products_ids) {
                    return $q2->whereIn('id', $products_ids);
                })
                
//                ->cacheFor(3600 * 7 * 24)
                ->get();
        } else {
            $categories = Category::query()
                ->whereHas('products', function ($q2) use ($products_ids) {
                    return $q2->whereIn('id', $products_ids);
                })
//                ->orWhere(function ($q) use ($category_url, $brands_filter) {
//                    if (!empty($category_url) and empty($brands_filter)) {
//                        $ids = $category_url->products()->active()->pluck('id')->toArray();
//                        return $q->whereHas('products', function ($q2) use ($ids) {
//                            $ids_ordered = implode(',', $ids);
//                            if (!empty($ids_ordered)) {
//                                $q2->whereIn('id', $ids)->orderByRaw(DB::raw("FIELD(id, $ids_ordered)"));
//                            }
//                        });
//                    }
//                })
                ->get()
                ->unique()
                ->values()
                ->sortByDesc('parent_id');
        }

        $products = $query

//            ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc')


//            ->when(empty($url) and !empty($search) and !empty($brand_url), function ($q1) use ($brand_url) {
//                $ids = $brand_url->products->pluck('id')->toArray();
//                $ids_ordered = implode(',', $ids);
//
//                $q1->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc');
//                $q1->orderByRaw(DB::raw("FIELD(id, $ids_ordered) desc"));
//            })
//
//            ->when(empty($url) and !empty($search) and !empty($category_url), function ($q2) use ($category_url,$query) {
//                $ids = $category_url->products()->get()->pluck('id')->toArray();
//                $ids_ordered = implode(',', $ids);
//
//                $q2->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc');
//                $q2->orderByRaw(DB::raw("FIELD(id, $ids_ordered) desc"));
//
//            })
//            ->with(['prices', 'visits'])
//            ->withCount(['visits','prices'])
//            ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc')
            ->when($this->sortBy === 'visits', function ($q) {
//                $q->orderByRaw(\DB::raw('(select count(*) from `visits` where `products`.`id` = `visits`.`secondary_key` and `primary_key` = ?) as `visits_count` from `products` order by `visits_count` desc'));
                $q->withCount(['visits'])->orderBy('visits_count', 'desc');
            })
            ->when($this->sortBy === 'price_desc', function ($q) use ($brand_url, $search, $sub_search, $category_url, $url) {
                $q
                    ->orderByRaw(DB::raw('(select `price` from `product_prices` where `product_prices`.`product_id` = `products`.`id` limit 1) desc'));
//                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))
//                    ->orderBy(ProductPrices::select('price')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc');


            })
            ->when($this->sortBy === 'price_asc', function ($q) {
                $q
//                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))
//                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))
//                    ->orderBy(ProductPrices::select('price')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'asc');
                    ->orderByRaw(DB::raw('(select `price` from `product_prices` where `product_prices`.`product_id` = `products`.`id` limit 1) asc'));
            })
            ->when(empty($url) and !empty($search) and !empty($brand_url), function ($q1) use ($brand_url) {
                $ids = $brand_url->products->pluck('id')->toArray();
                $ids_ordered = implode(',', $ids);

//                $q1->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc');
                $q1
                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc')
                    ->orderByRaw(DB::raw("FIELD(id, $ids_ordered) desc"));
            })
            ->when(empty($url) and !empty($search) and !empty($category_url), function ($q2) use ($category_url) {
                $ids = $category_url->products()->get()->pluck('id')->toArray();
                $ids_ordered = implode(',', $ids);

//                $q2->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc');
                $q2
                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc')
                    ->orderByRaw(DB::raw("FIELD(id, $ids_ordered) desc"));
            })
            ->when(!empty($url) and !empty($category_url), function ($q2) use ($category_url) {
                $q2
                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc')
                    ->whereHas('categories', function ($q) use ($category_url) {
                        $q->where('id', $category_url->id);
                    });
            })



            //            ->orderBy('product_prices.stock', 'd@endifesc')
//            ->orderBy('prices_count', 'desc')

//            ->orderBy(\DB::raw('POSITION("'.$search.'" IN title)', 'desc'))
//            ->when(!empty($search),function ($q) use($search){
//                $q->orderBy(\DB::raw('POSITION("'.$search.'" IN title)', 'asc'));
//            })

            ->when($this->sortBy === 'related', function ($q) use ($ids, $search, $sub_search) {

                $q
                    ->orderBy(ProductPrices::select('price')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc')
                    ->when(!empty($ids), function ($q3) use ($ids, $search) {
                        $ids_ordered = implode(',', $ids);

                        $q3
//                        ->orderBy(ProductPrices::select('price')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc')
//                        ->whereIn('id', $ids)
//                        ->with(['prices', 'visits'])
//                        ->withCount(['visits'])
//                    ->withCount('prices')
//                    ->withCount('visits')
//                    ->orderBy('prices_count', 'desc')
//                    ->orderBy('visits_count', 'desc')
//                        ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc')
//                    $q

//                        ->orderByRaw(DB::raw('POSITION("' . $search . '" IN title) desc'))
//                        ->orderByRaw(DB::raw('POSITION("' . $search . '" IN title) asc'))
//                        ->orderByRaw(DB::raw("select * from `products` order by (select `stock` from `product_prices` where `product_prices`.`product_id` = `products`.`id` limit 1) desc"))
                            ->orderByRaw(DB::raw("FIELD(id, $ids_ordered) asc"))
//                                                ->orderByRaw(DB::raw('POSITION("' . $search . '" IN title) asc'))

                            //                        ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))

                        ;
                    })//                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc');
//                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc')


                ;
//                $ids_ordered = implode(',', $ids);
//                $search_ids= $q->whereLike('title', $search);


//                $products_ids = $q->get()->pluck('id')->toArray();
//
//                $products = Product::query()->whereIn('id', $products_ids)->whereLike('title', $search)->get()->pluck('id')->toArray();
//                $ids_ordered = implode(',', $products);
//
//                $q
//                    //                    ->orderBy(ProductPrices::select('price')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc')
//
//                    ->orderByRaw(DB::raw("FIELD(id, $ids_ordered) desc"))

//                    ->whereLike('title', $search)

//                    ->with('user')
//                    ->join('users', 'users.id', '=', 'positions.user_id') // Or whatever the join logic is
//                    ->orderBy('prices.stock')

//                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))
//                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))
//$query->whereLike('title', $sub_search);
//                    ->orderByRaw(DB::raw('POSITION("' . $search . '" IN title) asc'))

//                    ->orderByRaw(DB::raw("FIELD(id, $ids_ordered) desc"))
//                    ->orderBy(ProductPrices::select('price')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'desc')

//                ;
////                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))
////                    ->orderBy(ProductPrices::select('price')->whereColumn('product_prices.product_id', 'products.id')->limit(1), 'asc')
//                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1));
////                $ids_ordered = implode(',', $ids);
//////                $hasPriceeIds = $q->clone()->whereIn('id',$ids)->whereHas('prices')
////////                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))
//////                    ->pluck('id')->toArray();
//////                $hasPriceeIds_ordered = implode(',', $hasPriceeIds);
//////
//////                dd($hasPriceeIds,$hasPriceeIds_ordered);
////                return $q
//////                    ->whereIn('id',$hasPriceeIds)
//////                     ->whereHas('prices')
////                    ->orderByRaw(DB::raw("FIELD(id, $ids_ordered)"))
//////                    ->orderByRaw(DB::raw("FIELD(id, $hasPriceeIds_ordered)"))
//////                     ->orderByRaw('has_prices');
//////                     ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))
//////                     ->orderByRaw(DB::raw("FIELD(id, $ids_ordered)"))
//////                     ->orderBy(function ($q2){
//////                         $q2->whereHas('prices');
//////                     })
//////                     ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))
//////                    ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))//                     ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1));
////                    ;
//////                     ->orderBy(ProductPrices::whereHas('prices')->whereColumn('product_prices.product_id', 'products.id')->limit(1));
////
            })


//            ->orderBy(ProductPrices::select('stock')->whereColumn('product_prices.product_id', 'products.id')->limit(1))
//            ->offset(0)
//            ->limit(500)
//            ->get();
////
//        $products = collect($products)
//            
            ->paginate($this->perPage);

//        if (!empty($sort_field)) {
//            $products->sortBy($sort_field);
//        }


        $meta_description = 'فهرست کالا ها';


        if (!isset($title)) {
            $title = 'کالا ها';
        }

        if (!empty($brand_url)) {
            $title = 'لیست قیمت و فروشندگان کالاهای برند ' . $brand_url->title . ' ، ' . verta()->format('d F');
            $meta_description = 'خرید کالاهای برند ' . $brand_url->title . ' در معتبرترین فروشگاهها با بهترین قیمت بازار';
            $header_title = 'لیست قیمت و فروشندگان کالاهای برند ' . $brand_url->title;

        } elseif (!empty($category_url)) {
            $meta_description = 'خرید انواع ' . $category_url->title . ' در معتبرترین فروشگاهها با بهترین قیمت بازار';
            $title = 'لیست قیمت و فروشندگان کالاهای دسته ' . $category_url->title . ' ، ' . verta()->format('d F');
            $header_title = 'لیست قیمت و فروشندگان کالاهای دسته ' . $category_url->title;
        }

        Meta::setDescription($meta_description);
        $final_title = $title;
        Meta::setTitleSeparator('-')->setTitle($final_title);


        if (Agent::isMobile()) {
            return view('product::mobile.products', [
                'url' => $url ?? null,
                'products' => $this->readyToLoad ? $products : collect([])->paginate($this->perPage),

//                'products' => $products ?? collect([])->paginate($this->perPage),
                'category' => $category_url ?? null,
                'category_url' => $category_url ?? null,
                'brand' => $brand_url ?? null,
                'categories' => $categories ?? null,
                'brands' => $brands ?? null,
                'products_query_type' => $products_query_type ?? null,
            ])->extends('mobile.layouts.master', [
                'pageTitle' => $final_title,
                'title' => $header_title ?? $final_title,
                'pageDescription' => $meta_description,
            ]);
        }

        return view('product::site.products.livewire.products', [
            'url' => $url ?? null,
            'products' => $this->readyToLoad ? $products : collect([])->paginate($this->perPage),
            'category_url' => $category_url ?? null,
            'categories' => $categories ?? null,
            'brand' => $brand_url ?? null,
            'brands' => $brands ?? null,
            'products_query_type' => $products_query_type ?? null,
        ])->extends('site.layouts.master', [
            'pageTitle' => $final_title,
            'pageDescription' => $meta_description,
        ]);
    }

    public function escapeElasticReservedChars($string)
    {
        $regex = "/[\\+\\-\\=\\&\\|\\!\\(\\)\\{\\}\\[\\]\\^\\\"\\~\\*\\<\\>\\?\\:\\\\\\/]/";
        return preg_replace($regex, addslashes('\\$0'), $string);
    }

    public function getQueryString()
    {
        return array_merge([
            'page' => ['except' => 1],
            'search' => ['except' => null],
            'brands_filter' => ['except' => null],
            'price_filter' => ['except' => false],
            'only_instock' => ['except' => false],
            'only_discount' => ['except' => false],
            'min_price_filter' => ['except' => 0],
            'max_price_filter' => ['except' => 0],
            'sortBy' => ['except' => null],
        ], $this->queryString);
    }
}
