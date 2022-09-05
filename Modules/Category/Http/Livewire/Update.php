<?php

namespace Modules\Category\Http\Livewire;

use Livewire\WithFileUploads;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;

class Update extends BaseComponent
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $image;
    public $image_url;
    public $description;
    public $parent_id;
    public $status = true;
    public $category;


    public function mount($slug)
    {
        $this->category = Category::where('slug', $slug)->orWhere('id', $slug)->first();
        $this->title       = $this->category->title;
        $this->slug        = $this->category->slug;
        $this->description = $this->category->description;
        $this->parent_id   = $this->category->parent_id;
        $this->status      = $this->category->status;
        $this->image_url   = $this->category->image_url;
    }

    public function submit()
    {

//        dd('test');
        $this->validate([
            'title' => 'required|max:191',
//            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
        ]);
//
        $category = Category::findOrFail($this->category->id);

        $category->update([
            'title'       => $this->title,
            'slug'        => $this->slug,
            'parent_id'   => $this->parent_id,
            'description' => $this->description,
            'status'      => $this->status,

        ]);

        if ($this->image) {
            $filename = 'category_' . time() . '.' . $this->image->extension();
            $this->image->storeAs('/uploads', $filename);
            $category->image = $filename;
            $category->save();
        }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center'
        ]);
    }

    public function render()
    {
        return view('category::livewire.update', [
            'categories' => Category::query()->orderBy('title', 'desc')->get()
        ])->extends('admin.layouts.master', ['pageTitle' => 'ویرایش دسته بندی ' . $this->category->title]);
    }
}
