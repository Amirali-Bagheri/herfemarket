<?php

namespace Modules\Notification\Entities;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Notification\Database\factories\NotificationFactory;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $guarded = [];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('type', 'like', '%'.$query.'%')
                    ->orWhere('data', 'like', '%'.$query.'%')
                    ->orWhere('notifiable_type', 'like', '%'.$query.'%');
    }

    protected static function newFactory()
    {
        return NotificationFactory::new();
    }

    public function notifiable()
    {
        return $this->morphTo();
    }
}
