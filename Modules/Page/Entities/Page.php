<?php

namespace Modules\Page\Entities;

use App\Models\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Queue\SerializesModels;
use Kyslik\ColumnSortable\Sortable;
use Modules\Analytics\Entities\Click;
use Modules\Seo\Contracts\MetaTags\RobotsTagsInterface;
use Modules\Seo\Contracts\MetaTags\SeoMetaTagsInterface;
use Modules\Setting\Entities\Setting;

class Page extends Model implements SeoMetaTagsInterface, RobotsTagsInterface
{
    // use Sortable;
    use Sluggable;
    use SerializesModels;
    use Notifiable;

    // use Shareable;

    public $sortable = [
        'title',
        'slug',
        'id',
        'view_count',
        'status',
        'updated_at',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    protected $hidden = [];
    protected $guarded = [];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'like', '%' . $query . '%')
                ->orWhere('slug', 'like', '%' . $query . '%');
    }

    public static function boot()
    {
        parent::boot();

        // static::updating(function ($instance) {
        //     // update cache content
        //     Cache::put('pages.' . $instance->slug, $instance);
        // });
        //
        // static::deleting(function ($instance) {
        //     // delete post cache
        //     Cache::forget('pages.' . $instance->slug);
        // });
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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',

            ],
        ];
    }

    public function visits()
    {
        return visits($this);
    }

    public function getTitle(): ?string
    {
        return Setting::get('seo_meta_title') . ' - ' . $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description ?? ' ';
    }

    public function getKeywords()
    {
        return $this->keywords ?? ' ';
    }

    public function getRobots(): ?string
    {
        return 'index, follow';
    }

    public function clicks()
    {
        return $this->morphMany(Click::class, 'clickable');
    }
}
