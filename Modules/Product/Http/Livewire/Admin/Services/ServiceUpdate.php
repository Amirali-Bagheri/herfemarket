<?php

namespace Modules\Product\Http\Livewire\Admin\Services;

use App\Traits\Uploadable;
use Livewire\WithFileUploads;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;
use Modules\Product\Repository\ProductRepositoryInterface;

class ServiceUpdate extends BaseComponent
{
    use WithFileUploads;
    use Uploadable;

    public $product;

    public $title;

    public $slug;

    public $code;

    public $description;

    public $excerpt;

    public $image;

    public $image_url;

    public $image_old_url;

    public $images;

    public $status = true;

    public $comment_status = true;

    public $brand_id;

    public $product_id;

    public $en_title;

    public $categories = [];

    public $brands = [];

    public $category_search = '';

    public $category_search_list = [];

    public $new_categories = [];

    public $main_price;

    public $final_price;

    protected $updatesQueryString = ['category_search', 'brand_search'];

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
        $this->title = $this->product->title;
        $this->product_id = $id;
        $this->slug = $this->product->slug;
        $this->description = $this->product->description;
        $this->excerpt = $this->product->excerpt;
        $this->images = $this->product->images;
        $this->status = $this->product->status;
        $this->main_price = $this->product->main_price;
        $this->final_price = $this->product->final_price;

        $this->categories = $this->product->categories()->pluck('title', 'id')->toArray();
        $this->new_categories = $this->product->categories()->get()->pluck('id')->toArray();
    }

    public function searchCategories()
    {
        if (empty($this->category_search)) {
            $this->category_search_list = Category::where('parent_id', 0)->orderBy('title')->get()->pluck('title', 'id')->toArray();
        } else {
            $this->category_search_list = Category::search($this->category_search)->get()->pluck('title', 'id')->toArray();
        }
    }

    public function removeCategory($id)
    {
        $this->product->categories()->detach($id);
        unset($this->categories[$id], $this->new_categories[$id]);
        $this->product->categories()->detach($id);
        $this->product->save();

        $this->categories = $this->product->categories()->pluck('title', 'id')->toArray();
        $this->new_categories = [];

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'toast' => true,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center',
        ]);
    }

    public function destroy(ProductRepositoryInterface $productRepository)
    {
        $productRepository->deleteFull($this->product->id);

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function submit()
    {
        $this->validate([
            'title' => "required|unique:products,title,$this->product_id,id",
            'slug' => "required|unique:products,slug,$this->product_id,id",
        ]);

        $product = Product::findOrFail($this->product_id);

        $product->update([
            'title' => $this->title,
            'en_title' => $this->en_title,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'main_price' => $this->main_price,
            'final_price' => $this->final_price,
        ]);

        if ($this->new_categories) {
            $product->categories()->sync($this->new_categories);
            $product->save();
        }

        if ($this->image) {
            $filename = 'service_'.time().'.'.$this->image->extension();
            $this->image->storeAs('/uploads', $filename);
            $product->images = $filename;
            $product->save();
        }
        $product->save();

        $this->flash('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center',
        ]);

        $this->redirect(route('admin.services.update', $product->id));
    }

    public function render()
    {
        return view('product::admin.products.livewire.update')->extends('admin.layouts.master', [
            'pageTitle' => 'ویرایش محصول '.$this->title,
        ]);
    }
}
