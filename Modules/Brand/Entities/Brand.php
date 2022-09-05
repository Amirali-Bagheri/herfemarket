<?php

namespace Modules\Brand\Entities;

use App\Models\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\Searchable\SearchResult;

class Brand extends Model
{
    use Sluggable;

    public $asYouType = true;

    protected $guarded = ['id'];

    protected $appends = ['url', 'status_name', 'created_at_human_ago', 'created_at_human'];

    protected $searchable = [
        'title',
        'slug',
    ];
    public function toSearchableArray()
    {
        $array = [
            'title' => $this->title,
            'slug' => $this->slug,
        ];

        return $array;
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'like', '%' . $query . '%')
                ->where('id', $query)
                ->orWhere('slug', 'like', '%' . $query . '%');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('site.products', $this->slug);

        return new SearchResult($this, $this->title, url_decode($url));
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function allProducts()
    {
        //call recursive method to append all children brands
        return $this->getAll([$this])
            //select brand products as each item
            ->pluck('products')
            //flatten products into one dimension array
            ->flatten()
            //remove repeated products
            ->unique();
    }

    public function getAll($brands)
    {
        //appending brands array
        $append = collect();
        //walk-through input brands
        foreach ($brands as $brand) {
            //if brand has children add them to $append
            if ($brand->children()->count()) {
                $append->merge($brand->children);
            }
        }
        //if there were children brands, also add their children to $append
        if ($append->count()) {
            $append = $this->getAll($append);
        }
        //merge children and brands
        return $brands->merge($append);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorable');
    }

    public function visits()
    {
        return visits($this)->relation();
    }

    public function getUrlAttribute()
    {
        if (isset($this->attributes['slug'])) {
            return url_decode(route('site.products', $this->attributes['slug']));
        }

        return null;
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
}
