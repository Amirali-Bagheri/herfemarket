<?php

namespace Modules\Advert\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
use Modules\Core\Entities\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Ad extends Model
{
    use Sluggable;

    protected $guarded = ['id'];

    public static function get($slug, $column)
    {
        $setting = new self();
        $entry = $setting->firstWhere('slug', $slug);
        if (!$entry) {
            return;
        }

        return $entry->$column;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',

            ],
        ];
    }
}
