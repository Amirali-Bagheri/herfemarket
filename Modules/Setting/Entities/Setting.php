<?php

namespace Modules\Setting\Entities;

use Illuminate\Support\Facades\Config;
use Modules\Core\Entities\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Setting extends Model
{
//     use QueryCacheable;
    ////
//     protected static $flushCacheOnUpdate = true;
//     public           $cacheFor           = 3600 * 24 * 7;
//     public           $cachePrefix        = '_setting';

    public $timestamps = false;
    protected $table = 'settings';
    protected $guarded = [];

    public static function get($key)
    {
        $setting = new self();
        $entry = $setting->where('key', $key)->first();
        if (!$entry) {
            return;
        }

        return $entry->value;
    }

    public static function set($key, $value = null)
    {
        $setting = new self();
        $entry = $setting->where('key', $key)->firstOrFail();
        $entry->value = $value;
        $entry->saveOrFail();
        Config::set('key', $value);
        if (Config::get($key) == $value) {
            return true;
        }

        return false;
    }
}
