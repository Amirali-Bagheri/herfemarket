<?php

use Illuminate\Support\Facades\Schema;
use Modules\Menu\Entities\Menu;

if (!function_exists('menu')) {
    function menu($key)
    {
        try {
            if (Schema::hasTable('menus')) {
                $menu = Menu::firstWhere('slug', $key);
                if (!isset($menu->sub_menus)) {
                    return [];
                }
                return Menu::firstWhere('slug', $key)->sub_menus()->where('status', 1)->orderBy('sort_id', 'asc')->get();
            }
        } catch (Throwable $ex) {
            return [];
        }
    }
}
