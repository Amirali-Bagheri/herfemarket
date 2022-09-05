<?php

namespace Modules\Menu\Http\Livewire\Admin;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\SubMenu;

class SubMenuCreate extends BaseComponent
{
    public $name;
    public $sort_id;
    public $icon;
    public $link;
    public $type;
    public $color;
    public $menu_id;
    public $status;
    public $parent_id;
    public $role;
    public Menu $menu;
    public $sub_menus;

    public function mount($slug)
    {
        $this->menu      = Menu::firstWhere('slug', $slug);
        $this->sub_menus = $this->menu->sub_menus()->orderBy('sort_id')->get();
        $this->menu_id   = $this->menu->id;
    }

    public function submit()
    {
        $menu = $this->menu;

        $this->validate([
            'name' => 'required',
            'link' => 'required',
        ]);

        $sub_menu = SubMenu::create([
            'menu_id'=>$menu->id,
            'name'      => $this->name,
            'icon'      => $this->icon,
            'sort_id'   => $this->sort_id,
            'status'    => $this->status,
            'parent_id' => $this->parent_id,
            'link'      => $this->link,
            'role' => $this->role,
        ]);

        $this->alert('success', 'انجام شد', [
            'position'          => 'bottom-start',
            'timer'             => 3000,
            'toast'             => true,
            'text'              => 'عملیات با موفقیت انجام شد',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        return view('menu::livewire.admin.sub-menu-update')->extends('admin.layouts.master', [
            'pageTitle' => 'افزودن زیر منو ' . $this->menu->name,
        ]);
    }
}
