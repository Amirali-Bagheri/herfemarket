<?php

namespace Modules\Brand\Http\Livewire\Admin;

use Livewire\WithFileUploads;
use Modules\Brand\Entities\Brand;
use Modules\Core\Http\Livewire\BaseComponent;

class Create extends BaseComponent
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $image;
    public $description;
    public $status = true;

    protected $rules = [
        'title' => 'required|max:191',
        'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    public function submit(): void
    {
        $this->validate();


        $brand = Brand::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,

        ]);
        if ($this->image) {
            $filename = $this->image->store('/brands', 'uploads');
            $brand->image = $filename;
        }

        $brand->save();
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
        $this->image = null;
        $this->status = true;
    }

    public function render()
    {
        return view('brand::admin.livewire.create')->extends('admin.layouts.master', [
            'pageTitle' => 'برند جدید'
        ]);
    }
}
