<?php

namespace Modules\Business\Entities;

use App\Events\NewBusinessEvent;
use App\Models\City;
use App\Models\State;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Models\Transaction;
use Bavix\Wallet\Traits\HasWallet;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Analytics\Entities\Click;
use Modules\Category\Entities\Category;
use Modules\Comments\Entities\Comment;
use Modules\Core\Entities\Model;
use Modules\Crawl\Entities\CrawledProducts;
use Modules\Crawl\Entities\Link;
use Modules\Inquiry\Entities\Inquiry;
use Modules\Inquiry\Entities\InquiryResponse;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductPrices;
use Modules\Rating\Entities\Rating;
use Modules\Report\Entities\Report;
use Modules\User\Entities\User;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Searchable\SearchResult;
use Throwable;

class Business extends Model
{
    use Sluggable;

    protected $appends = ['created_at_human_ago', 'created_at_human', 'logo_url', 'status_name'];

    protected $guarded = [];
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%');
    }

    // public function hasPrices()
    // {
    //     $prices = ProductPrices::where('business_id', $this->attributes['id'])->count();
    //
    //     return $prices > 0 ? true : false;
    // }

    public function scopeOfType($query, $type)
    {
        $busines_type = BusinessType::where('id', $type)->orWhere('slug', $type)->first();
        return $query->where('type_id', $busines_type->id);
    }

    public function getLogoUrlAttribute()
    {
        return (isset($this->attributes['logo']) and !empty($this->attributes['logo'])) ? '/uploads/logos/' . $this->attributes['logo'] : '/uploads/logos/business.png';
    }

    public function visits()
    {
        return visits($this);
    }

    public function lastTransaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function clicks()
    {
        return $this->morphMany(Click::class, 'clickable');
    }

//     public function products_clicks()
//     {
//         return $this->prices()->whereHas('clicks', function ($query) {
//             return $query->where('status', 'new');
//         });
// //        return $this->morphMany(Click::class, 'clickable','Modules\Product\Entities\ProductPrices','clickable_id','id');
// //        return Click::where('clickable_type','Modules\Product\Entities\ProductPrices')->whereIn('clickable_id',$this->prices->pluck('id'));
// //         $this->prices->pluck('id');
// //        return $this->hasManyThrough(Click::class,ProductPrices::class,'business_id','clickable_id');
// //        return $this->hasManyThrough(Click::class,ProductPrices::class,'business_id','clickable_id');
//     }
    //
    // public function prices()
    // {
    //     return $this->hasMany(ProductPrices::class, 'business_id');
    // }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeFilter($query, $params)
    {
        if (!empty($params['sortBy'])) {
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
            }
        }

        if (!empty($params['city'])) {
            $cityArray = explode(',', $params['city']);
            $query->whereIn('city_id', $cityArray);
        }

        if (!empty($params['type'])) {
            $typeArray = explode(',', $params['type']);
            $query->whereIn('type_id', $typeArray);
        }

        if (!empty($params['q'])) {
            $query->search($params['q']);
        }

        return $query;
    }

    public function manager()
    {
        return $this->belongsTo(User::class);
    }

    public function business_type()
    {
        return $this->belongsTo(BusinessType::class, 'type_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getStatusNameAttribute()
    {
        return $this->showStatus();
    }

    public function showStatus()
    {
        if (!isset($this->attributes['status'])) {
            return;
        }
        switch ($this->attributes['status']) {
                case 1:
                    return 'فعال';
                case 0:
                    return 'غیر فعال';
                default:
                    return '-';
            }
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function allProducts()
    {
//        return $this->category_parent->products()->active()->with('rating', 'prices')->get());
        $array = collect();
        foreach ($this->category_parent_children as $category) {
            $array->push($category->products()->active()->with('rating', 'prices')->get());
        }

        return $array->flatten()->unique('id');
    }

    public function crawled_products(): HasMany
    {
        return $this->hasMany(CrawledProducts::class, 'business_id', 'id');
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class, 'business_id', 'id');
    }

//    public function hasSalesExperts()
//    {
//        $sales_experts = SalesExpert::where('business_id', $this->attributes['id'])->count();
//
//        return $sales_experts > 0 ? true : false;
//    }

    public function sales_experts(): HasMany
    {
        return $this->hasMany(SalesExpert::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function ratingAvg()
    {
        return $this->rating()->pluck('rating')->avg();
    }

    public function rating()
    {
        return $this->morphMany(Rating::class, 'ratable');
    }

    public function ratingCount()
    {
        $count = $this->rating()->count();
        return $count == 0 ? $count : $count - 1;
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('site.businesses.single', $this->slug);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function getInquiry($id)
    {
        return $this->inquiries()->firstWhere('inquiry_id', $id);
    }

    public function inquiries()
    {
        return $this->hasManyThrough(
            Inquiry::class,
            InquiryResponse::class,
            'business_id',
            'id',
            'id',
            'inquiry_id',
        );

//        return $this->hasManyThrough(
//            Inquiry::class,
//            InquiryResponse::class,
//
//            'business_id', // Foreign key on users table...
//            'id', // Foreign key on posts table...
//            'id', // Local key on countries table...
//            'inquiry_id' // Local key on users table...
//        );
        // return $this->hasMany(InquiryResponse::class);
    }

    public function responses()
    {
        return $this->hasManyThrough(
            InquiryResponse::class,
            __CLASS__,
            'id',
            'business_id',
            'id',
            'id',
        );
    }

    public function getCategoryParentTypeAttribute()
    {
        try {
            return $this->categories()->where('parent_id', 0)->first();
        } catch (Throwable $exception) {
            return null;
        }
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorable');
    }

    public function getCategoryParentAttribute()
    {
        try {
            return $this->categories()->where('parent_id', 0)->whereHas('parent')->get();
        } catch (Throwable $exception) {
            return null;
        }
    }

    public function getCategoryParentChildrenAttribute()
    {
        try {
            return $this->category_parent->children()->whereIn('id', $this->categories()->pluck('id'))->get();
        } catch (Throwable $exception) {
            return null;
        }
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function getCityNameAttribute()
    {
        return $this->state->name;
    }

    public function getStateNameAttribute()
    {
        return $this->state->name;
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    // public function price_reports()
    // {
    //     return $this->hasManyThrough(Report::class, ProductPrices::class, 'business_id', 'reportable_id', 'id', 'id');
    // }

    public function canPricing(): bool
    {
        if (!($this->isActive() and $this->attributes['pricing_status'] == 1)) {
            return false;
        }

        if ($this->isSpecial() and $this->isSpecialType('no_visit_withdraw')) {
            return true;
        }

//            $business_wallet = $this->manager->getWallet('default');

        if ($this->manager->canWithdraw(109)) {
            return true;
        }


        return false;
    }

    public function isActive(): bool
    {
        return $this->attributes['status'];
    }

    public function isSpecial()
    {
        return $this->attributes['special_status'];
    }

    public function isSpecialType($type): bool
    {
        return in_array($type, json_decode($this->attributes['special_type'], true) ?? [], true);
    }

//    public function getLatestCrawledCountAttribute()
//    {
//        return $this->crawled_products()->where('created_at', "<", Carbon::now()->subDays(2))->count() ?? 0;
//    }
}
