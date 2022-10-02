<?php

namespace Modules\Category\Entities;

use App\Models\Model;
use Chelout\RelationshipEvents\Concerns\HasBelongsToManyEvents;
use Chelout\RelationshipEvents\Traits\HasRelationshipObservables;
use Cviebrock\EloquentSluggable\Sluggable;
use Database\Factories\CategoriesFactory;
use ElasticScoutDriverPlus\Searchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Modules\Brand\Entities\Brand;
use Modules\Business\Entities\Business;
use Modules\Inquiry\Entities\Inquiry;
use Modules\Landing\Entities\Landing;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Property;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Searchable\SearchResult;

//use Spatie\Searchable\Searchable;

//use Modules\Category\Database\factories\CategoryFactory;

class Category extends Model
{
    use Sluggable;
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = ['id'];
    protected $appends = ['image_url', 'url', 'status_name', 'created_at_human_ago', 'created_at_human', 'parent_title'];
    protected $hidden = [
        'description',
        'parent_id',
        'status',
        'image',
        'created_at',
    ];
    protected $casts = [
        'parent_id' => 'integer',
        'priority' => 'integer',
    ];

    protected static function newFactory()
    {
        return CategoriesFactory::new();
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->getKey(), // this *must* be defined
            'title' => $this->title,
        ];
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'like', '%' . $query . '%')
                ->orWhere('slug', 'like', '%' . $query . '%');
    }

//    public static function boot()
//    {
//        parent::boot();
//
//        static::updating(function ($instance) {
//            Cache::put('categories.' . $instance->slug, $instance);
//        });
//
//        static::deleting(function ($instance) {
//            Cache::forget('categories.' . $instance->slug);
//        });
//    }


    public function products()
    {
        return $this->morphedByMany(Product::class, 'categorable');

//        return $this->morphedByMany(Product::class, 'categorable')
//            ->where('status', 1)
//            ;
//        try {
//            return $this->morphedByMany(Product::class, 'categorable','categorables','category_id','categorable_id')
//                ->where('status', 1)
//                ;
//        }catch (\Throwable $ex){
//            throw $ex;
//        }
    }


    public function shouldBeSearchable()
    {
        return $this->active();
    }

    public function visits()
    {
        return visits($this)->relation();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('children');
    }

    public function getUrlAttribute()
    {
        if (isset($this->attributes['slug'])) {
            return url_decode(route('site.products', $this->attributes['slug']));
        }

        return null;
    }

    public function getAllChildren()
    {
        $sections = new Collection();

        foreach ($this->children as $section) {
            $sections->push($section);
            $sections = $sections->merge($section->getAllChildren());
        }

        return $sections;
    }

    public function allProducts()
    {
        //call recursive method to append all children categories
        return $this->getAll([$this])
            //select category products as each item
            ->pluck('products')
            //flatten products into one dimension array
            ->flatten()
            //remove repeated products
            ->unique();
    }

    public function getAll($categories)
    {
        $append = collect();
        foreach ($categories as $category) {
            if ($category->children()->count()) {
                $append->merge($category->children);
            }
        }
        if ($append->count()) {
            $append = $this->getAll($append);
        }
        return $categories->merge($append);
    }

    public function allBusinesses()
    {
        //call recursive method to append all children categories
        return $this->getAll([$this])
            //select category products as each item
            ->pluck('businesses')
            //flatten products into one dimension array
            ->flatten()
            //remove repeated products
            ->unique();
    }

    public function allBrands()
    {
        //call recursive method to append all children categories
        return $this->getAll([$this])
            //select category products as each item
            ->pluck('brand_id')
            //flatten products into one dimension array
            ->flatten()
            //remove repeated products
            ->unique();
    }

    public function brands()
    {
        return $this->morphedByMany(Brand::class, 'categorable')->where('status', 1);
    }

    public function categorable()
    {
        return $this->morphTo();
    }

    public function businesses()
    {
        return $this->morphedByMany(Business::class, 'categorable');
    }

    public function inquiries()
    {
        return $this->morphedByMany(Inquiry::class, 'categorable');
    }

    public function properties()
    {
        return $this->morphedByMany(Property::class, 'categorable');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('site.products', $this->slug);

        return new SearchResult($this, $this->title, url_decode($url));
    }

    public function getRouteKeyName()
    {
        return 'slug';
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

    public function getParentTitleAttribute()
    {
        return !isset($this->parent) ? '-' : $this->parent->title;
    }

    public function getImageUrlAttribute()
    {
        return isset($this->attributes['image']) ? '/' . $this->attributes['image'] : '/uploads/category.png';
    }

    public function mappableAs(): array
    {
        return [
            'id' => 'keyword',
            'title' => 'text',
            'status' => 'boolean',
            'created_at' => 'date',
        ];
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

    public function getProductsCountNumberAttribute()
    {
        try {
            return Cache::rememberForever('cached_products_count_category_'.$this->id, function () {
                return $this->products()->count();
            });
        } catch (\Throwable $ex) {
            return 0;
        }
    }

    public function landing()
    {
        return $this->morphOne(Landing::class, 'landingable');
    }

    public function releatedWith($id)
    {
        return in_array($id, $this->getAllChildren()->pluck('id')->unique()->toArray(), true);
    }
}
