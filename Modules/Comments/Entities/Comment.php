<?php

namespace Modules\Comments\Entities;

use App\Models\Model;
use App\Models\Service;
use Hootlex\Moderation\Moderatable;
use Modules\Rating\Entities\Rating;
use Modules\User\Entities\User;

class Comment extends Model
{
    use Moderatable/*, Sortable*/
        ;

    public $sortable = [
        'id',
        'user_id',
        'status',
        'created_at',
    ];
    protected $guarded  = ['id'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('body', 'like', '%' . $query . '%');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'commentable_id');
    // }
    //

    public function replies()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'commentable_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function showStatus()
    {
        if (! isset($this->attributes['status'])) {
            return;
        }
        switch ($this->attributes['status']) {
            case 1:
                return 'تایید شده';
            case 0:
                return 'بررسی نشده';
            case 2:
                return 'رد شده';
            default:
                return '-';
        }
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
