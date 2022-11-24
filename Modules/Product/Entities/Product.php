<?php

namespace Modules\Product\Entities;

use App\Models\Model;
use App\MyIndexConfigurator;
use App\Search\ProductsSearchRule;
use Illuminate\Support\Facades\Cache;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use JeroenG\Explorer\Application\Aliased;
use JeroenG\Explorer\Application\BePrepared;
use JeroenG\Explorer\Application\Explored;
use JeroenG\Explorer\Application\IndexSettings;
use JeroenG\Explorer\Domain\Analysis\Analysis;
use JeroenG\Explorer\Domain\Analysis\Analyzer\StandardAnalyzer;
use JeroenG\Explorer\Domain\Analysis\Filter\SynonymFilter;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Scout\Searchable;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Comments\Entities\Comment;
use Modules\Crawl\Entities\CrawledProducts;
use Modules\Rating\Entities\Rating;
use Modules\Report\Entities\Report;
use Modules\Seo\Contracts\MetaTags\RobotsTagsInterface;
use Modules\Seo\Contracts\MetaTags\SeoMetaTagsInterface;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;
use Modules\Wishlist\Traits\Wishlistable;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Searchable\SearchResult;
use Throwable;

class Product extends Model implements
    SeoMetaTagsInterface,
    RobotsTagsInterface
{
    use Sluggable;
    use SerializesModels;
    use Notifiable;

    // use Wishlistable;
    protected $filters = [];

    protected $searchable = [
        'title',
        'en_title',
//        'code',
        'brand.title'
    ];

    protected $casts = [
        // 'images' => 'array',
        'status' => 'boolean',
    ];
    protected $hidden = [
        'view_count',
        //        'buy_count',
        //        'status',
        //        'chef_id',
        'comment_status',
        'description',
    ];
    // protected $appends = ['has_prices_with_stock','has_prices','stock', 'has_discount', 'max_price', 'min_price', 'slider_price', 'thumbnail_url', 'best_price', 'rating_avg', 'rating_count', 'visit_count', 'categories_title', 'created_at_human_ago', 'created_at_human', 'status_name'];
    protected $guarded = [];

    public static $withoutAppends = false;

    public function scopeWithoutAppends($query)
    {
        self::$withoutAppends = true;

        return $query;
    }
    protected function getArrayableAppends()
    {
        if (self::$withoutAppends){
            return [];
        }

        return parent::getArrayableAppends();
    }
//    protected $indexConfigurator = MyIndexConfigurator::class;

    protected $searchRules = [
        //
    ];

    public function shardRouting()
    {
        return $this->slug;
    }

    // Here you can specify a mapping for model fields
    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text',
                // Also you can configure multi-fields, more details you can find here https://www.elastic.co/guide/en/elasticsearch/reference/current/multi-fields.html
                'fields' => [
                    'raw' => [
                        'type' => 'keyword',
                    ]
                ]
            ],
        ]
    ];

    public static function count()
    {
        return Cache::remember('count_products', 3600 * 24, function () {
            return static::query()->count();
        });
    }

    public static function boot()
    {
        parent::boot();

//        static::retrieved(function ($instance) {
//            if (Cache::driver('database')->has('products.' . $instance->slug)){
//                Cache::driver('database')->get('products.' . $instance->slug, $instance);
//            }else{
//                Cache::driver('database')->put('products.' . $instance->slug, $instance);
//            }
//        });
//
//        static::updating(function ($instance) {
//            Cache::driver('database')->put('products.' . $instance->slug, $instance);
//        });
//
//        static::deleting(function ($instance) {
//            Cache::driver('database')->forget('products.' . $instance->slug);
//        });
    }
//
//
//    public static function search($query)
//    {
//        return empty($query) ? static::query()
//            : static::where('title', 'like', '%' . $query . '%')
//                ->orWhere('en_title', 'like', '%' . $query . '%')
//                ->orWhere('code', 'like', '%' . $query . '%')
//            ->cacheFor(3600 * 24)
//            ;
//    }

    public static function paginate(Collection $results, $pageSize)
    {
        $page = Paginator::resolveCurrentPage('page');

        $total = $results->count();

        return self::paginator($results->forPage($page, $pageSize), $total, $pageSize, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }

    protected static function paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items',
            'total',
            'perPage',
            'currentPage',
            'options'
        ));
    }

    public function getCacheTagsToInvalidateOnUpdate($relation = null, $pivotedModels = null): array
    {
        return [
            "product:{$this->id}",
            'products',
        ];
    }

    public function searchableWith()
    {
        return ['brand', 'prices', 'categories'];
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('site.products.single', $this->slug);

        return new SearchResult($this, $this->title, url_decode($url));
    }

    public function getUrl()
    {
        return route('site.products.single', $this->slug);
    }

    public function getCategoriesTitleAttribute()
    {
        return $this->categories->pluck('title')->implode(',');
    }

    public function getHasDiscountAttribute()
    {
        return $this->whereHas('prices', function (Builder $query) {
            $query->whereNotNull('price')->whereNotNull('discount_value');
        })->exists();
    }

    public function getStockAttribute()
    {
        return $this->whereHas('prices', function (Builder $query) {
            $query->whereNotNull('price')->where('stock', 1);
        })->exists();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getCategoryParentTypeAttribute()
    {
        return $this->categories()->where('parent_id', 0)->first();
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorable', 'categorables');
    }

    public function getCategoryParentAttribute()
    {
        return $this->category_parent_type->children()->whereIn('id', $this->categories()->pluck('id'))->first();
    }

    public function getCategoryParentChildrenAttribute()
    {
        return $this->category_parent->children()->whereIn('id', $this->categories()->pluck('id'))->get();
    }

    public function getSlidesAttribute()
    {
        $slides = [];

        $images = json_decode($this->attributes['images'], true, 512, JSON_THROW_ON_ERROR);

        foreach ($images as $slide) {
            $slides[] = empty($slide) ? '<img id="js-image-zoom" class="img-fluid" style="width: 300px;" src="/uploads/product.png">' : '<img id="js-image-zoom" class="img-fluid" style="width: 300px;" src="/uploads/' . $slide . '">';
        }
        return $slides;
    }

    public function property_values()
    {
        return $this->hasMany(PropertyValue::class, 'product_id', 'id');
    }

    public function properties()
    {
        return $this->hasManyThrough(Property::class, PropertyValue::class, 'product_id', 'id', 'id', 'property_id');

//        return $this->HasMany(PropertyValue::class, 'product_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function hasDiscountWithBusiness($business)
    {
        $price = $this->prices()->where('business_id', $business->id)->first();
        return $price->discount_type and $price->discount_value ? true : false;
    }

    // public function prices()
    // {
    //     return $this->hasMany(ProductPrices::class, 'product_id', 'id')->with('business');
    // }

    public function priceOfBusiness($business)
    {
        return $this->prices()->where('business_id', $business->id)->first();
    }

    public function priceOf($business_id)
    {
        return $this->prices()->where('business_id', $business_id)->first();
    }

    public function getAllBrands()
    {
        $sections = new Collection();

        foreach ($this->brands as $section) {
            $sections->push($section);
            $sections = $sections->merge($section->getAllBrands());
        }

        return $sections;
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getRatingCountAttribute()
    {
        return $this->ratingCount();
    }

    public function ratingCount()
    {
        return Cache::rememberForever('rating_count_' . $this->id, function () {

//            return $this->rating()->count() - 1;
            return $this->rating()->count();
        });
    }

    public function rating()
    {
        return $this->morphMany(Rating::class, 'ratable');
    }

    public function scopeWithAll($query)
    {
        $query->with('rating', 'prices');
    }

    public function getMaxPriceAttribute()
    {
//        return Cache::remember($this->id . '_max_price', 3600, function () {
        return $this->prices()
            ->whereHas('business', function ($q) {
                $q->where('status', 1);
                $q->where('pricing_status', 1);
            })
            ->where('stock', 1)
            ->whereNotNull('price')->whereNotIn('price', [0])
//            ->cacheFor(3600)
            ->get()->max('final_price');
//        });


        // return $this->prices()->orderBy('price', 'desc')->get()->final_price;
    }

    public function getMinPriceAttribute()
    {
        // return $this->prices()->orderBy('price', 'asc')->get()->final_price;

//        return Cache::remember($this->id . '_min_price', 3600, function () {
        return $this->prices()
            ->whereHas('business', function ($q) {
                $q->where('status', 1);
                $q->where('pricing_status', 1);
            })
            ->where('stock', 1)
            ->whereNotNull('price')->whereNotIn('price', [0])
//            ->cacheFor(3600)
            ->get()
            ->min('final_price');
//        });
    }

    public function getBestPriceAttribute()
    {
        try {
            //        return Cache::remember($this->id . '_best_price', 3600, function () {
            $price = $this->prices()
                ->whereHas('business', function ($q) {
                    $q->where('status', 1);
                    $q->where('pricing_status', 1);
                })
                ->where('stock', 1)
                ->whereNotNull('price')->whereNotIn('price', [0])
//                ->cacheFor(3600)
                ->get()->sortBy('final_price')->first();
            return $price->business->name ?? null;
//        });
        } catch (Throwable $ex) {
            return null;
        }
    }

    public function getSliderPriceAttribute()
    {
        try {
            $text = '';

            if ($this->has_prices and $this->max_price != 0) {
                if ($this->min_price == $this->max_price) {
                    $text .= number_format($this->min_price);
                }
                $text .= 'از
                                                <span
                                                    style="color: #8BC34A;">';

                $text .= number_format($this->min_price);
                $text .= '</span>
            تا
                                                <span
                                                    style="color:#ff1744; ">';
                $text .= number_format($this->max_price);
                $text .= '</span>';

                $text .= 'تومان';

                if (isset($this->best_price)) {
                    $text .= '<p class="text-center justify-content-center"
                                                   style="color: #8BC34A; font-size: 9px; margin-top: 20px;">
                                                   بهترین
                                                    قیمت در
            <b style="color: #8BC34A;">';
                }

                $text .= $this->best_price;
                $text .= '</b>
                                                </p>';
            } else {
                $text .= '<span class="listing-cat-address">بدون قیمت</span>';
            }

            return $text;
        } catch (Throwable $ex) {
            throw $ex;
//            return null;
        }
    }

    public function hasPrices()
    {
        return $this->has('prices');
//        $prices = ProductPrices::where('product_id', $this->attributes['id'])->count();
//
//        return $prices > 0 ? true : false;
    }

    public function getThumbnailAttribute()
    {
        try {
            $image = str_replace(' ', '%20', Str::of($this->images[0]));
            if (!(isset($this->images[0]) and !in_array($image, ['tn_', '[', ']', '[]', '[""]']))) {
                return 'product.png';
            }
            $this->images = ['product.png'];
            return 'product.png';

            // return str_replace(' ', '%20', '/uploads/' . Str::of(empty($this->images[0])));

            // return $threturnis->images[0];
        } catch (Throwable $ex) {
            return 'product.png';
        }
    }

    public function getThumbnailUrlAttribute()
    {
        try {
            return '/uploads/thumbnails/tn_' . str_replace(' ', '%20', Str::of($this->images[0]));
        } catch (Throwable $ex) {
            return '/uploads/thumbnails/product.png';
        }
    }

    public function getCreatedByNameAttribute()
    {
        if (empty($this->created_by)) {
            return 'خودکار';
        }
        return $this->created_by_user->full_name ?? '-';
    }

    public function created_by_user()
    {
        if (empty($this->created_by)) {
            return null;
        }
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function crawled_product()
    {
        return $this->belongsTo(CrawledProducts::class, 'id', 'product_id');
    }

    public function crawled_products()
    {
        return $this->hasMany(CrawledProducts::class, 'product_id', 'id');
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function getLinkAttribute()
    {
        return route('site.products.single', $this->attributes['slug']);
    }

    public function scopeFilter($query, $params, $perPage = null)
    {

        /*   if (isset($params['sortBy']) && trim($params['sortBy'] !== '')) {
               switch ($params['sortBy']) {
                   case 'view':
                       $query->orderByViews();
                       break;
                   case 'date':
                       $query->orderBy('created_at', 'desc');
                       break;
                   case 'title':
                       $query->orderBy('title', 'asc');
                       break;
                   case 'price':
                       $query->whereHas('prices', function (Builder $q) {
                           $q->orderBy('price', 'asc');
                       });
                       break;
                   case 'price_desc':
   //                    $query->join('prices', 'users.role_id', '=', 'prices.id')->orderBy('prices.price', 'desc');
   //                        ->select('prices.*');

                       $query->whereHas('prices', function (Builder $q) {
                           $q->orderBy('price',);
                       });
                       break;
               }
           }*/

        switch ($params) {
            case 'price_asc':
                $query->whereHas('prices', function (Builder $q) {
                    $q->orderBy('price', 'asc');
                });
                break;
            case 'price_desc':
                $query->whereHas('prices', function (Builder $q) {
                    $q->orderBy('price', 'desc');
                });
                break;

            case 'discounts':


//                $query->whereHas('prices', function ($q) {
//                    $q->orderBy(DB::raw('discount_value IS NOT NULL, discount_value'), 'desc');
//                });

                $query->paginate($perPage)->sortByDesc('prices.discount_value');

                break;

            case 'visits':
                $query->withCount('visits')->orderBy('visits_count', 'desc');
                break;
        }

//        if ((isset($params['min_price']) && trim($params['min_price']) != '') or (isset($params['max_price']) && trim($params['max_price']) == '')) {
//
//            $query->whereHas('prices', function (Builder $q) use ($params) {
//                if (isset($params['min_price'])) {
//                    $q->where('price', '>=', $params['min_price']);
//                }
//                if (isset($params['max_price'])) {
//                    $q->where('price', '<=', $params['max_price']);
//                }
//
//            });
//        }
//
//        if (isset($params['view']) && trim($params['view'] !== '')) {
//            $query->orderByViews();
//        }

//        if (isset($params['title']) && trim($params['title'] !== '')) {
//            $query->orderBy('title', trim($params['title']));
//        }

//        if (isset($params['available']) && trim($params['available'] !== '')) {
//
//            if ($params['available'] == 1) {
//                $query->whereHas('prices');
//            }
//        }
//        if (isset($params['brand']) && trim($params['brand'] !== '')) {
//            $brandArray = explode(',', $params['brand']);
//            $query->whereIn('brand_id', $brandArray);
//        }

//        if (!empty($params['property'])) {
        //            $propertyArray = explode(',', $params['property']);
        //            return $query->whereHas('property_values', function (Builder $query) use ($propertyArray) {
        //                $query->whereIn('property_id', $propertyArray);
        //            });
        //        }

//        if (isset($params['discounted']) && trim($params['discounted'] !== '')) {
//
//            if ($params['discounted'] == 1) {
//                $query->whereHas('prices', function (Builder $query) {
//                    $query->whereNotNull(['discount_value', 'discount_type']);
//                });
//            }
//        }
//


//        if (isset($params['q']) && trim($params['q'] !== '')) {
        // dd($params['q']);
        // $query->whereLike('title', $params['q'])->orWhereLike('en_title', $params['q'])
        //     ->orWhereLike('code', $params['q'])
        // ;

//            $query
//                ->where('title', 'LIKE', "%{$params['q']}%")
//                ->orWhere('en_title', 'LIKE', "%{$params['q']}%")
//                ->orWhere('code', 'LIKE', "%{$params['q']}%");
        //    $query->search($params['q']);
//        }
        $query->with('prices')
//            ->withCount('prices')->orderBy('prices_count', 'desc');

            ->whereHas('prices', function (Builder $query) {
                $query->orderBy('stock', 'ASC');
            })
//            ->join('product_prices', 'products.id', '=', 'product_prices.id')
//            ->orderBy('product_prices.stock', 'desc')

//            ->join('product_prices', 'products.id', '=', 'product_prices.product_id')
//            ->orderBy('product_prices.stock', 'ASC')
//                ->sortBy('prices.stock')
        ;
//        $query->orderBy('prices.stock', 'desc');

//        $query->whereHas('prices', function (Builder $query) {
//
//            $query->orderBy('stock', 'asc');
//        });


        if (!isset($perPage)) {
            return $query;
        }
        return $query->paginate($perPage);
    }

    public function ratingBlade()
    {
        for ($i = 0; $i < 5; $i++) {
            if ($this->ratingAvg() <= $i) {
                echo '<span><i class="far fa-star" style="color: #ffc107"></i></span>';
            } else {
                echo '<span><i class="fas fa-star" style="color: #ffc107"></i></span>';
            }
        }
    }

    public function ratingAvg()
    {
        return Cache::rememberForever('rating_avg_' . $this->id, function () {
            return $this->rating()->pluck('rating')->avg();
        });
    }

    public function getRatingAvgAttribute()
    {
        return $this->ratingAvg();
    }

//     public function getHasPricesAttribute()
//     {
//         return $this->has('prices');
// //        $prices = ProductPrices::where('product_id', $this->attributes['id'])->count();
// //
// //        return $prices > 0 ? true : false;
//     }

//     public function getHasPricesWithStockAttribute()
//     {
//         return $this->whereHas('prices', function (Builder $query) {
//             $query->where('stock', '=', 1)->orWhere('stock', '=', true);
//         })->exists();
//
// //        return $this->whereHas('prices.stock',1)->exists();
//     }

    public function hasPriceAs($business_id)
    {
        $productPrice = ProductPrices::where('product_id', $this->attributes['id'])->where('business_id', $business_id)->get();

        return $productPrice ? true : false;
    }

    public function getTitle(): ?string
    {
        return Setting::get('seo_meta_title') . ' - ' . $this->title;
    }

    public function mappableAs(): array
    {
        return [
//            'suggest' => [
//                'type' => 'completion'
//            ],
//            'id' => 'keyword',
            'title' => [
                'type' => 'text',
//                'analyzer' => 'parsi',
//                'analyzer' => 'persian_analyzer',
//                'analyzer' => 'parsi_no_stem',
//                'analyzer' => [
//                    "parsi_no_stem" => [
//                        "type" => "custom",
//                        "tokenizer" => "standard",
//                        "char_filter" => [
//                            "zwnj_filter"
//                        ],
//                        "filter" => [
//                            "parsi_normalizer",
//                            "parsi_stop_filter"
//                        ]
//                    ]
//                ],
//                'analyzer' => 'frameworks',
                'analyzer' => 'rebuilt_persian',
            ],
            'en_title' => [
                'type' => 'text',
//                'analyzer' => 'standard',

//                'analyzer' => [
//                    "parsi_no_stem" => [
//                        "type" => "custom",
//                        "tokenizer" => "standard",
//                        "char_filter" => [
//                            "zwnj_filter"
//                        ],
//                        "filter" => [
//                            "parsi_normalizer",
//                            "parsi_stop_filter"
//                        ]
//                    ]
//                ],
//                'analyzer' => 'parsi',
//                'analyzer' => 'frameworks',
            ],
//            'status' => 'boolean',
//            'created_at' => 'date',
//            'brand' => 'nested',
//
//            "tokenizer" => "standard",
//            "filter" => ["ngram"],
        ];
    }

    public function shouldBeSearchable()
    {
        return count($this->toSearchableArray()) > 0;
    }

    public function toSearchableArray()
    {
        $array = [
            'title' => $this->title,
            'en_title' => $this->en_title,
//            'code' => $this->code,
            'prices_count' => $this->prices()->where('status',1)->where('stock',1)->count(),
            'has_prices' => $this->prices()->count() > 0,
//            'brand_id' => $this->brand_id,
//            'category_ids' => $this->categories->pluck('id')->toArray(),
//            'description' => $this->description
            'brand_title' => $this->brand->title ?? null,
//            'category_title' => $this->categories->last()->title ?? null,
        ];
//                return $q->whereHas('prices', function ($q) {
//                    $q->where('stock', 1);
//                });
        //                return $q->whereHas('prices', function ($q) {
//                    $q->where('stock', 1);
//                });
//        $array = $this
        ////            ->whereHas('prices', function ($q) {
        ////                $q->where('stock', 1);
        ////            })
//            ->with("brand")
//            ->with("categories")
//            ->where("id", $this->id)->first()
//            ->toArray();

        return $array;
    }
//    public function shouldBeSearchable()
//    {
//        return $this->active();
//    }


    public function prepare($searchable): array
    {
//        if ($searchable['title'] === 'Sicily') {
//            $searchable['title'] = ['Italy', 'Sicily'];
//        }

        return $searchable;
    }

    public function getDescription(): ?string
    {
        return 'لیست قیمت و فروشندگان کالای '.$this->title;
//        return $this->title . '. ' . $this->en_title;
    }

    public function getKeywords()
    {
        if ($this->tags) {
            return $this->tags;
        }
        return Setting::get('seo_meta_keywords');
    }

    // Here you can specify a mapping for a model fields.

    public function getRobots(): ?string
    {
        return 'index, follow';
    }
    public function searchableAs()
    {
        return 'products';
    }
}
