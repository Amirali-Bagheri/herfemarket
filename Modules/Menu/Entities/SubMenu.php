<?php

namespace Modules\Menu\Entities;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubMenu extends Model
{
//    use QueryCacheable;
//
//    protected static $flushCacheOnUpdate = true;
//    public           $cacheFor           = 3600;
//    public           $cachePrefix        = 'sub_menu_';
    protected $guarded = [];

    public static function getNextSortRoot($menu)
    {
        return self::where('menu_id', $menu)->max('sort_id') + 1;
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%' . $query . '%')
                ->orWhere('link', 'like', '%' . $query . '%');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id')->with('children');
    }

    public function sub_menus(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id')->with('sub_menus');
    }

    public function getIsParentAttribute()
    {
        return $this->attributes['parent_id'] == 0 or $this->attributes['parent_id'] == null;
    }

    public function getsons($id)
    {
        return $this->where("parent", $id)->get();
    }

    public function getall($id)
    {
        return $this->where("menu_id", $id)->orderBy("sort_id", "asc")->get();
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
}
