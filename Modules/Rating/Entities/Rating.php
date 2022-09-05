<?php

namespace Modules\Rating\Entities;

use Modules\Business\Entities\Business;
use Modules\Comments\Entities\Comment;
use Modules\Core\Entities\Model;
use Modules\Product\Entities\Product;
use Modules\User\Entities\User;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Rating extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'ratings';

    public function ratable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'ratable');
    }

    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'ratable');
    }

    public function businesses()
    {
        return $this->morphedByMany(Business::class, 'ratable');
    }
}
