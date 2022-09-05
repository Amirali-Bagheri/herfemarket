<?php

namespace Modules\Blog\Entities;

use Hootlex\Moderation\Moderatable;
use Kyslik\ColumnSortable\Sortable;
use Modules\Core\Entities\Model;
use Modules\Rating\Entities\Rating;
use Modules\User\Entities\User;

class BlogComment extends Model
{
    use Moderatable/*, Sortable*/
        ;

    public $sortable = [
        'id',
        'user_id',
        'status',
        'created_at',
    ];
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'ratable');
    }
    //    protected $fillable = ['user_id', 'article_id', 'parent_id', 'body', 'name', 'email'];

    //    public function articles()
    //    {
    //        return $this->belongsToMany(Article::class, 'article_comments')->where('status', 1)->orderBy('created_at', 'DESC')->paginate(5);
    //    }
    //
    //    public function products()
    //    {
    //        return $this->belongsToMany(Product::class, 'product_comments')->where('status', 1)->orderBy('created_at', 'DESC')->paginate(5);
    //    }
    //
    //    public function user()
    //    {
    //        return $this->belongsTo(User::class);
    //    }
    //
    //    public function replies()
    //    {
    //        return $this->hasMany(Comment::class, 'parent_id');
    //    }
    //
    //    public function gravatar($email)
    //    {
    //        if ($email != null) {
    //            return "https://www.gravatar.com/avatar/" . md5($email) . "?d=mm";
    //        } else {
    //            return "/storage/avatars/avatar.jpg";
    //        }
    //    }
}
