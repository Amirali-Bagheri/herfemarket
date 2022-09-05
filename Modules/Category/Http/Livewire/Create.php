<?php

namespace Modules\Category\Http\Livewire;

use Livewire\WithFileUploads;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;

class Create extends BaseComponent
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $image;
    public $description;
    public $parent_id = 0;
    public $status = true;
    public $categories = [];
    public $category_search = '';
    protected $updatesQueryString = ['category_search'];


    protected $rules = [
        'title' => 'required|max:191',
        'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    public function submit(): void
    {
        $this->validate();


        $category = Category::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'parent_id' => $this->parent_id,
            'description' => $this->description,
            'status' => $this->status,

        ]);

        if ($this->image) {
            $filename = 'category_' . time() . '.' . $this->image->extension();
            $this->image->storeAs('/uploads', $filename);
            $category->image = $filename;
            $category->save();
        }

        $category->save();
        $this->resetInput();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    private function resetInput()
    {
        $this->title = null;
        $this->slug = null;
        $this->description = null;
        $this->parent_id = 0;
        $this->image = null;
        $this->status = true;
    }

    public function searchCategories()
    {
        if (empty($this->category_search)) {
            $this->categories = Category::where('parent_id', 0)->orderBy('title')->get()->pluck('title', 'id');
        } else {
            $this->categories = Category::search($this->category_search)->orderBy('title')->get()->pluck('title', 'id');
        }
    }

    public function render()
    {
        return view('category::livewire.create', [

        ])->extends('admin.layouts.master', ['pageTitle' => 'ثبت دسته بندی']);
    }
}
