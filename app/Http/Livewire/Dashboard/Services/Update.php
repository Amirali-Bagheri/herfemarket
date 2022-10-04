<?php

namespace App\Http\Livewire\Dashboard\Services;

use DB;
use Livewire\WithFileUploads;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;
use Throwable;

class Update extends BaseComponent
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
    public $image_url;
    public $status               = true;
    public $comment_status       = true;
    public $brand_id;
    public $en_title;
    public $property_json;
    public $property_key;
    public $property_value;
    public $categories           = [];
    public $brands               = [];
    public $category_search      = '';
    public $category_search_list = [];
    public $main_price;
    public $category_id;
    public $final_price;
    public $product;

    public function mount($id)
    {
        $this->product  = Product::query()->where('isService', 1)->where('id', $id)->firstOrFail();
        $this->user     = auth()->user();
        $this->business = $this->user->business;

        $this->title       = $this->product->title ?? null;
        $this->image_url   = '/uploads/' . $this->product->images ?? null;
        $this->category_id = $this->product->categories()->get()->first()->id ?? null;
        $this->description = $this->product->description ?? null;
        $this->main_price  = $this->product->main_price ?? null;
    }

    public function submit()
    {

        $this->validate([
            'title'       => 'required|max:255',
            'category_id' => 'required',
            // 'images'      => 'required',
            'main_price'  => 'required',
        ]);

        try {
            DB::beginTransaction();

            $user = auth()->user();
            $this->product->update(
                [
                    'title'       => $this->title,
                    'description' => $this->description,
                    'status'      => $this->status,
                    'main_price'  => $this->main_price,
                    'final_price' => $this->final_price,
                    'business_id' => $this->business->id,
                    'isService'   => 1,
                ]);
            $this->product->categories()->sync($this->category_id);
            $category = Category::find($this->category_id);
            $new_ids  = array_merge($category->parents->pluck('id')->toArray(), [$this->category_id]);
            $this->product->categories()->sync($new_ids);

            if ($this->images) {
                $filename = 'product_' . time() . '.' . $this->images->extension();
                $this->images->storeAs('/uploads', $filename);
                $this->product->images = $filename;
            }
            $this->product->save();

            DB::commit();

            $this->flash('success', 'عملیات با موفقیت انجام شد', [
                'timer'             => 3000,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);

            $this->redirect(route('dashboard.services.index'));
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
        return view('site.dashboard.services.create', [
        ])->extends('site.layouts.master', [
            'pageTitle' => 'ویرایش خدمت',
        ]);
    }
}

