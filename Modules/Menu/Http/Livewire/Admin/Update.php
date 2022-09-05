<?php

namespace Modules\Menu\Http\Livewire\Admin;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Menu\Entities\Menu;

class Update extends BaseComponent
{
    // use WithFileUploads;

    public $name;
    public $slug;
    public $sort_id;
    public $icon;
    public $description;
    public $status;
    public $language;
    public Menu $menu;

    public function mount($slug)
    {
        $menu = Menu::firstWhere('slug', $slug);
        $this->menu = $menu;
        $this->name = $menu->name;
        $this->icon = $menu->icon;
        $this->slug = $menu->slug;
        $this->description = $menu->description;
        $this->status = $menu->status;
        $this->language = $menu->language;
    }

    public function submit()
    {
        $menu = $this->menu;

        $this->validate([
            'name' => 'required',
            'slug' => "required|unique:menus,slug,$menu->id,id",
        ]);
        //        $menu = Menu::findOrFail($this->menu->id);

        $this->menu->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'sort_id' => $this->sort_id,
            'status' => $this->status,
            'language' => $this->language,
            'description' => $this->description,
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
        return view('menu::livewire.admin.update', [
        ])->extends('admin.layouts.master', ['pageTitle' => 'ویرایش منو ' . $this->menu->title]);
    }
}
