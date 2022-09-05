<?php

namespace Modules\Blog\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Queue\SerializesModels;
use Kyslik\ColumnSortable\Sortable;
use Modules\Analytics\Entities\Click;
use Modules\Core\Entities\Model;
use Modules\Seo\Contracts\MetaTags\RobotsTagsInterface;
use Modules\Seo\Contracts\MetaTags\SeoMetaTagsInterface;
use Modules\Setting\Entities\Setting;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Post extends Model implements SeoMetaTagsInterface, RobotsTagsInterface
{
    // use Sortable;
    use Sluggable;
    use SerializesModels;
    use Notifiable;
    use SoftDeletes;

    protected $casts = [
        'status' => 'boolean',
    ];
    protected $table = 'posts';
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        // static::updating(function ($instance) {
        //     Cache::put('posts.' . $instance->slug, $instance);
        // });
        //
        // static::deleting(function ($instance) {
        //     Cache::forget('posts.' . $instance->slug);
        // });
    }

    public static function search($query)
    {
        return empty($query) ? static::query() : static::query()->where('title', 'like', '%' . $query . '%')
            ->orWhere('slug', 'like', '%' . $query . '%');
    }

    public static function getFeedItems()
    {
        return self::all();
    }

    protected static function booted()
    {
        // static::addGlobalScope('is_published', function (Builder $builder) {
        //     $builder->where('status', 'published');
        // });
    }

    public function clicks()
    {
        return $this->morphMany(Click::class, 'clickable');
    }

    public function visits()
    {
        return visits($this);
    }

    public function getLinkAttribute()
    {
        return route('site.blog.single', $this->slug);
    }

    public function getThumbnailUrlAttribute()
    {
        return '/uploads/' . $this->images;
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->updated_at)
            ->link($this->link)
            ->author(\setting('site_name'));
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'post_id');
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'category_post', 'category_id', 'post_id');
    }

    public function getTitle(): ?string
    {
        return Setting::get('seo_meta_title') . ' - ' . $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getKeywords()
    {
        return $this->tags;
    }

    public function getRobots(): ?string
    {
        return 'index, follow';
    }
}
