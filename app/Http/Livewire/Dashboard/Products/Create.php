<?php

namespace App\Http\Livewire\Dashboard\Products;

use Livewire\WithFileUploads;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;

class Create extends BaseComponent
{
    use WithFileUploads;

    public            $user;
    public            $business;

    public $title;
    public $slug;
    public $code;
    public $description;
    public $excerpt;
    public $images;
    public $image;
    public $status = true;
    public $comment_status = true;
    public $brand_id;
    public $en_title;
    public $property_json;
    public $property_key;
    public $property_value;
    public $categories = [];
    public $brands = [];
    public $category_search = '';
    public $category_search_list = [];

    public $main_price;
    public $final_price;

    public function mount()
    {
        $this->user             = auth()->user();
        $this->business         = $this->user->business;

        Meta::setTitleSeparator('-')->setTitle('ثبت محصول')->prependTitle(Setting::get('seo_meta_title'));

    }

    public function submit()
    {
        $this->validate([
            'title'    => 'required|max:255',
            'categories'  => 'required',
        ]);

        try {
            \DB::beginTransaction();

            $user = auth()->user();

            $product = Product::create(
               [
                   'title' => $this->title,
                   'description' => $this->description,
                   'status' => $this->status,
                   'created_by' => auth()->id(),
                ]);
            $product->categories()->attach($this->categories);
            $product->save();

            \DB::commit();

            $this->alert('success', 'عملیات با موفقیت انجام شد', [
                'timer' => 3000,
                'showCancelButton' => false,
                'showConfirmButton' => false,
                'position' => 'center'
            ]);

        } catch (\Throwable $ex) {
            \DB::rollBack();

            $this->alert('error', 'خطایی رخ داد', [
                'position'          => 'center',
                'timer'             => '3000',
                'toast'             => false,
                'text'              => 'لطفا مجددا تلاش کنید',
                'showConfirmButton' => false,
                'onConfirmed'       => '',
                'confirmButtonText' => 'متوجه شدم',
            ]);

            throw $ex;
        }

    }

    public function render()
    {

        return view('site.dashboard.products.create', [
        ])->extends('site.layouts.master', [
            'pageTitle' => 'داشبورد',
        ]);
    }
}
