<?php

namespace Modules\Menu\Http\Livewire\Admin;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\SubMenu;

class SubMenuUpdate extends BaseComponent
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
    public SubMenu $sub_menu;
    public $sub_menus;

    public function mount($slug, $id)
    {
        $this->menu = Menu::firstWhere('slug', $slug);
        $this->sub_menu = SubMenu::findOrFail($id);
        $this->sub_menus = $this->menu->sub_menus()->orderBy('sort_id')->get();
        $this->name = $this->sub_menu->name;
        $this->icon = $this->sub_menu->icon;
        $this->parent_id = $this->sub_menu->parent_id;
        $this->sort_id = $this->sub_menu->sort_id;
        $this->link = $this->sub_menu->link;
        $this->status = $this->sub_menu->status;
        $this->color = $this->sub_menu->color;
        $this->role = $this->sub_menu->role;
        $this->menu_id = $this->sub_menu->menu_id;
    }

    public function submit()
    {
        $menu = $this->menu;

        $this->validate([
            'name' => 'required',
            'link' => 'required',
        ]);

        $this->sub_menu->update([
            'name' => $this->name,
            'icon' => $this->icon,
            'sort_id' => $this->sort_id,
            'status' => $this->status,
            'parent_id' => $this->parent_id,
            'link' => $this->link,
            'role' => $this->role,
        ]);

        $this->alert('success', 'انجام شد', [
            'position' => 'bottom-start',
            'timer' => 3000,
            'toast' => true,
            'text' => 'عملیات با موفقیت انجام شد',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        return view('menu::livewire.admin.sub-menu-update', [
        ])->extends('admin.layouts.master', ['pageTitle' => 'ویرایش منو ' . $this->menu->title]);
    }
}
