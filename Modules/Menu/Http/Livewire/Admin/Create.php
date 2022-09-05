<?php

namespace Modules\Menu\Http\Livewire\Admin;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Menu\Entities\Menu;

class Create extends BaseComponent
{
    public $name;
    public $slug;
    public $icon;
    public $sort_id;
    public $description;
    public $language;
    public $status = true;
    protected $rules = [
        'name' => 'required',
        'slug' => 'required|unique:menus',
    ];

    public function submit(): void
    {
        $this->validate();

        $menu = Menu::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'sort_id' => $this->sort_id,
            'status' => $this->status,
            'language' => $this->language,
            'description' => $this->description,
        ]);

        $menu->save();
        $this->resetInput();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'type' => 'success',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center',
        ]);
    }

    private function resetInput()
    {
        $this->name = null;
        $this->slug = null;
        $this->description = null;
        $this->status = true;
    }

    public function render()
    {
        return view('menu::livewire.admin.update')->extends('admin.layouts.master', ['pageTitle' => 'ثبت منو ']);
    }
}
