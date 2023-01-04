<?php

namespace App\Http\Livewire\Dashboard\Products;

use DB;
use Livewire\WithFileUploads;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;
use Throwable;

class Create extends BaseComponent
{
    use WithFileUploads;

    public $user;
    public $business;
    public $title;
    public $slug;
    public $code;
    public $description;
    public $excerpt;
    public $images;
    public $image;
    public $status               = true;
    public $comment_status       = true;
    public $brand_id;
    public $en_title;
    public $property_json;
    public $property_key;
    public $property_value;
    public $brands               = [];
    public $category_search      = '';
    public $category_search_list = [];
    public $main_price;
    public $category_id;
    public $final_price;

    public function mount()
    {
        $this->user     = auth()->user();
        $this->business = $this->user->business;

        Meta::setTitleSeparator('-')->setTitle('ثبت محصول')->prependTitle(Setting::get('seo_meta_title'));
    }

    public function submit()
    {

        $this->validate([
            'title'      => 'required|max:255',
            'category_id' => 'required',
            'images' => 'required',
            'main_price' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // $user = auth()->user();

            $product = Product::create(
                [
                    'title'       => $this->title,
                    'description' => $this->description,
                    'status'      => 0,
                    'main_price'      => $this->main_price,
                    'final_price'      => $this->final_price,
                    'business_id'      => $this->business->id,
                ]
            );
            $product->categories()->sync($this->category_id);
            // $category = Category::find($this->category_id);
            // $new_ids  = array_merge($category->parents->pluck('id')->toArray(), [$this->category_id]);
            // $this->product->categories()->sync($new_ids);
            $product->categories()->sync($this->category_id);

            if ($this->images) {
                $filename = 'product_' . time() . '.' . $this->images->extension();
                $this->images->storeAs('/uploads', $filename);
                $product->images = $filename;
            }
            $product->save();

            DB::commit();

            $this->flash('success', 'عملیات با موفقیت انجام شد', [
                'timer'             => 3000,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);

            $this->redirect(route('dashboard.products.index'));
        } catch (Throwable $ex) {
            DB::rollBack();

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
            'categories' => \Modules\Category\Entities\Category::orderBy('title', 'asc')->get(),
        ])->extends('site.layouts.master', [
            'pageTitle' => 'داشبورد',
        ]);
    }
}
