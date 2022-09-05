<?php

namespace Modules\Menu\Entities;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
//    use QueryCacheable;

//    protected static $flushCacheOnUpdate = true;
//    public           $cacheFor           = 3600;
//    public           $cachePrefix        = 'menu_';
    protected $guarded = [];

    public static function byName($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }

    public static function hasName($slug)
    {
        return self::where('slug', '=', $slug)->exists();
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%' . $query . '%')
                ->orWhere('slug', 'like', '%' . $query . '%');
    }

    public function sub_menus(): HasMany
    {
        return $this->hasMany(SubMenu::class, 'menu_id', 'id')->with('children');
    }

    // Getter for the HTML menu builder

    public function getHTML($items)
    {
        return $this->buildMenu($items);
    }

    public function buildMenu($menu, $parentid = 0)
    {
        $result = null;
        foreach ($menu->sub_menus as $item) {
            if ($item->parent_id != $parentid) {
                return $result ? "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
            }
        }
        $result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
	      <div class='dd-handle nested-list-handle'>
	        <span class='glyphicon glyphicon-move'></span>
	      </div>
	      <div class='nested-list-content'>{$item->label}
	        <div class='pull-right'>
	        </div>
	      </div>" . $this->buildMenu($menu, $item->id) . "</li>";

        return $result ? "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
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
