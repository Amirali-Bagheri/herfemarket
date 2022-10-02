<?php

namespace Modules\Product\Http\Livewire\Admin\Products;

use Livewire\WithFileUploads;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;
use function GuzzleHttp\json_encode;

class ProductCreate extends BaseComponent
{
    use WithFileUploads;

    public $product;
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
    public $brand_search = '';
    public $inputs = [];
    public $i = 1;
    protected $updatesQueryString = ['category_search', 'brand_search'];

    public function searchCategories()
    {
        $this->category_search_list = Category::search($this->category_search)->orderBy('title')->get()->pluck('id');
    }

    public function searchBrands()
    {
        $this->brands = Brand::search($this->brand_search)->orderBy('title')->get();
    }

    public function add($i)
    {
        ++$i;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i], $this->property_key[$i], $this->property_value[$i]);
    }

    public function submit()
    {

//        $validated_data = $this->validate([
//            'title' => 'required|max:191',
//            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
//        ]);

        $product = Product::create([
            'title' => $this->title,
            'en_title' => $this->en_title,
            'slug' => $this->slug,
            'code' => $this->code,
            'description' => $this->description,
            'excerpt' => $this->excerpt,
//            'images' => $this->images,
            'status' => $this->status,
            'comment_status' => $this->comment_status,
            'brand_id' => $this->brand_id,
            'created_by' => auth()->id(),

            'property_json' => json_encode(array_combine_($this->property_key, $this->property_value)),
        ]);
        $product->categories()->attach($this->categories);

        /*  if ($this->image) {
              $filename = $this->image->store('/', 'uploads');
              $product->image = $filename;
          }
              if ($request->has('categories')) {
              $product->categories()->sync($request['categories']);
              foreach ($request->categories as $categoryID) {
                  $category = Category::find($categoryID);
                  $product->categories()->sync($category->id);
                  $product->categories()->attach($category->parents->pluck('id'));
              }
          }

          if ($request->has('property_id', 'property_value')) {
              $properties = collect($request->property_id)->filter()->flatten()->all();
              $property_values = collect($request->property_value)->filter()->flatten()->all();

              if (count($properties) > count($property_values)) {
                  $count = count($property_values);
              } else {
                  $count = count($properties);
              }
              $insertData = collect([]);
              for ($i = 0; $i < $count; $i++) {
                  $data = [
                      'value' => $property_values[$i],
                      'product_id' => $product->id,
                      'property_id' => intval($properties[$i]),
                  ];

                  $insertData->push($data);
              }

              $product->property_values()->createMany($insertData);
          }

        */

        $product->save();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center'
        ]);
    }

    public function render()
    {
        return view('product::admin.products.livewire.create')->extends('admin.layouts.master', [
            'pageTitle' => 'ایجاد محصول جدید'
        ]);
    }
}
