<?php

namespace Modules\Blog\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Modules\Core\Entities\Model;

class BlogCategory extends Model
{
    use Sluggable;

    protected $casts = [
        'status' => 'boolean',
    ];
    protected $guarded = ['id'];

    public function visits()
    {
        return visits($this);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function parent()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(BlogCategory::class, 'parent_id', 'id')->with('children');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'post_id', 'category_id');
    }
}
