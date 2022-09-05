<?php

namespace Modules\Brand\Http\Livewire\Admin;

use Livewire\WithFileUploads;
use Modules\Brand\Entities\Brand;
use Modules\Core\Http\Livewire\BaseComponent;

class Update extends BaseComponent
{
    use WithFileUploads;

    public $brand;
    public $title;
    public $slug;
    public $image;
    public $image_url;
    public $description;
    public $status = true;

    protected $rules = [
        'title' => 'required|max:191',
        'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];


    public function mount($id)
    {
        $brand = Brand::where('slug', $id)->orWhere('id', $id)->first();
        $this->brand = $brand;
        $this->title = $brand->title;
        $this->slug = $brand->slug;
        $this->description = $brand->description;
        $this->status = $brand->status;
        $this->image_url = $brand->image_url;
    }

    public function submit(): void
    {
        $this->validate();


        $this->brand->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,

        ]);
        if ($this->image) {
            $filename = $this->image->store('/brands', 'uploads');
            $this->brand->image = $filename;
        }

        $this->brand->save();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function render()
    {
        return view('brand::admin.livewire.update')->extends('admin.layouts.master', [
            'pageTitle' => 'ویرایش برند ' . $this->title
        ]);
    }
}
