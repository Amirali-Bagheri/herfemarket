<?php

namespace Modules\Product\Http\Livewire\Admin\Products;

use App\Jobs\RemoveFullProduct;
use Livewire\WithFileUploads;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;
use Modules\Product\Repository\ProductRepositoryInterface;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use App\Traits\Uploadable;

class ProductUpdate extends BaseComponent
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
    public $property_json;
    public $property_key;
    public $property_value;
    public $categories = [];
    public $brands = [];

    public $category_search = '';
    public $category_search_list = [];
    public $new_categories = [];
    public $connect_parent_categories = false;

    public $brand_search = '';
    public $inputs = [];
    public $i = 1;
    protected $updatesQueryString = ['category_search', 'brand_search'];

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
        $this->title = $this->product->title;
        $this->en_title = $this->product->en_title;
        $this->product_id = $id;
        $this->slug = $this->product->slug;
        $this->code = $this->product->code;
        $this->description = $this->product->description;
        $this->excerpt = $this->product->excerpt;
        $this->images = $this->product->images;
        $this->status = $this->product->status;
        $this->comment_status = $this->product->comment_status;
        $this->brand_id = $this->product->brand_id;
        $this->en_title = $this->product->en_title;
        $this->property_json = $this->product->property_json;
        $this->image_old_url = 'https://shago.ir'.$this->product->thumbnail_url;
        $this->image_url = $this->image_old_url;

//        foreach($this->product->categories()->dontCache()->pluck('title', 'id')->toArray() as $key => $value)
//        {
//            $this->removeCategory($key);
//        }
//
//        dd(
//            $this->product->categories()->dontCache()->pluck('title', 'id')->toArray()        );
        $this->categories = $this->product->categories()->dontCache()->pluck('title', 'id')->toArray();
        $this->new_categories = $this->product->categories()->dontCache()->get()->pluck('id')->toArray();

        if (!empty($this->product->property_json) and !empty(json_decode($this->product->property_json))) {
            foreach (json_decode($this->product->property_json) as $key => $value) {
                for ($k = 0; $k < $this->i; $k++) {
                    if (!empty($this->inputs[$k])) {
                        $this->inputs[$k] = $k;
                    }
                    $this->property_key[] = $key;
                    $this->property_value[] = $value;
                }
                ++$this->i;

                $this->property_key = collect($this->property_key)->unique()->values();
                $this->property_value = collect($this->property_value)->unique()->values();
            }
        }
    }

    public function searchCategories()
    {
        if (empty($this->category_search)) {
            $this->category_search_list = Category::where('parent_id', 0)->orderBy('title')->get()->pluck('title', 'id')->toArray();
        } else {
            $this->category_search_list = Category::
//            search($this->category_search, function ($client, $body) {
//                $body->setSize(4000);
//                return $client->search(['index' => 'categories', 'body' => $body->toArray()]);
//            })
            search($this->category_search)
//                         ->take(1000)
//                         ->must(new Matching('title', $this->category_search))
//                         ->must(new Matching('en_title', $this->category_search))

                ->get()->pluck('title', 'id')->toArray();
        }
    }

    public function removeCategory($id)
    {
        $this->product->categories()->dontCache()->detach($id);
        unset($this->categories[$id], $this->new_categories[$id]);
//        $this->product->categories()->dontCache()->sync($this->new_categories);
        $this->product->categories()->dontCache()->detach($id);
        $this->product->save();

        $this->categories = $this->product->categories()->dontCache()->pluck('title', 'id')->toArray();
        $this->new_categories = [];


        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'toast' => true,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center'
        ]);
    }

//    public function updatingNewCategories()
//    {
//        $product = Product::find($this->product->id);
//        foreach ($this->new_categories as $new_category){
//            $product->categories()->associate(Category::find($new_category))->save();
//        }
//
    ////        $product->categories()->sync($this->new_categories);
//
    ////        dd('test',$this->new_categories);
//    }

    public function searchBrands()
    {
//        $this->brands = Brand::search($this->brand_search, function ($client, $body) {
//            $body->setSize(4000);
//            return $client->search(['index' => 'brands', 'body' => $body->toArray()]);
//        })->get();
        $this->brands = Brand::search($this->brand_search)->get();
    }

    public function destroy(ProductRepositoryInterface $productRepository)
    {
//        $productRepository->deleteFull($this->product->id);

        RemoveFullProduct::dispatch($this->product->id);

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
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
//        $this->product->categories()->detach();
//        if(!empty($this->new_categories)){
        ////            $this->product->categories()->attach($this->new_categories);
//            $this->product->categories()->sync($this->new_categories);
        ////        }
        ////        dd();
//
//
//        $this->product->save();

//        dd($this->product->categories);

//        $validated_data = $this->validate([
//            'title' => 'required|max:191',
//            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
//        ]);
        $this->validate([
            "title" => "required|unique:products,title,$this->product_id,id",
            "slug" => "required|unique:products,slug,$this->product_id,id"
        ]);

        $product = Product::findOrFail($this->product_id);

        $properties = [];

        if (!empty($this->property_key)) {
            foreach ($this->property_key as $key => $p_key) {

//            foreach ($this->property_value as $p_value){
                $properties[$p_key ?? ""] = $this->property_value[$key] ?? "";
//            }
            }
        }


        $product->update([
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


            'property_json' => json_encode($properties),
        ]);


        if ($this->new_categories) {
//            $this->business->categories()->attach($this->categories);
//            $this->product->categories()->dontCache()->syncWithoutDetaching($this->new_categories);
            $this->product->categories()->dontCache()->sync($this->new_categories);
//        $this->product->categories()->dontCache()->sync($this->new_categories);

            $this->product->save();
            //        $this->business->categories()->attach($this->category_parent);
//        $this->business->categories()->sync($this->category_parent_children);

//            $this->business->save();
        }
        if ($this->connect_parent_categories) {
            $parent_ids = [];
            foreach ($this->product->categories()->dontCache()->get() as $cat) {
//                $this->product->categories()->attach($cat->parents->pluck('id')->toArray());

                $parent_ids[] = $cat->id;
                $parent_ids[] = $cat->parents->pluck('id')->toArray();
//                dump($cat);
//                dump($cat->parents);
//                dd('tset');
            }
//            $parent_ids = collect($parent_ids)->merge($this->new_categories)->merge($this->product->categories->pluck('id')->toArray())->collapse()->unique()->toArray();

            $parent_ids = collect($parent_ids)->collapse()->unique()->values()->toArray();
//            dump($parent_ids);
//            dump($this->product->categories);
//            dd('test');
//            $this->product->categories()->sync($this->new_categories);
            $this->product->categories()->dontCache()->syncWithoutDetaching($parent_ids);
        }

//        $this->product->categories()->dontCache()->sync();

//        if (!empty($this->new_categories)) {
//
//            $result_array = array();
//            $strings_array = $this->new_categories;
//
//            $this->product->categories()->detach();
//
//            foreach ($strings_array as $each_number) {
        ////                $result_array[] = (int) $each_number;
//                $product->categories()->attach((int) $each_number);
//
//            }
        ////            $this->product->categories()->attach(implode(',',$result_array));
        ////            $product->categories()->sync($result_array);
        ////
//
        ////            $this->product->categories()->sync($this->new_categories);
//        }
//        $product->categories()->attach(1);
//        $product->categories()->attach(2);
//        dd($result_array,$this->new_categories);


        $this->product->save();
//
//        dd($this->product->categories);


        if($this->image_url != $this->image_old_url){

            $image_url = $this->image_url;
            if (!$path = parse_url($image_url, PHP_URL_PATH)) {
                return false;
            }

            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $image_url = \Str::before($image_url, $ext) . $ext;

            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );

            $filename = substr($image_url, strrpos($image_url, '/') + 1);
            $filename_without_ext = \Str::before($filename, '.' . $ext);

            $filename_without_ext = \Str::slug($filename_without_ext, '-');

            if ($ext == 'webp') {
                $ext = 'png';
            }
            $hash = md5($filename_without_ext);

            $fileNameToStore = $hash . '.' . $ext;

            $image_get = file_get_contents($image_url, false, stream_context_create($arrContextOptions));

            $save = $this->resizeImage($image_get, 'thumbnails/tn_' . $fileNameToStore, 256, 256,$ext);

            $this->product->images = [$fileNameToStore];

        }
/*          if ($this->image) {

              $image_url = $crawl_product->image;

              if (!$path = parse_url($image_url, PHP_URL_PATH)) {
                  return false;
              }
              $ext = pathinfo($path, PATHINFO_EXTENSION);
              $image_url = Str::before($image_url, $ext) . $ext;
              $arrContextOptions = array(
                  "ssl" => array(
                      "verify_peer" => false,
                      "verify_peer_name" => false,
                  ),
              );

//              $image_get = file_get_contents($image_url, false, stream_context_create($arrContextOptions));

              $filename = substr($url, strrpos($url, '/') + 1);
              $filename_without_ext = Str::before($filename, '.' . $ext);

              $filename_without_ext = Str::slug($filename_without_ext, '-');

              if ($ext == 'webp') {
                  $ext = 'png';
              }
              $hash = md5($filename_without_ext);

              $fileNameToStore = $hash . '.' . $ext;

              $save = $this->resizeImage($image_get, 'thumbnails/tn_' . $fileNameToStore, 256, 256,$ext);

//              $filename = $this->image->store('/', 'uploads');
//              $product->image = $filename;
          }*/
          /*
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

        $this->product->save();


        $this->flash('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center'
        ]);

        $this->redirect(route('admin.products.update', $this->product->id));
    }

    public function removeProductCategories()
    {
        $this->product->categories()->dontCache()->detach();

        $this->flash('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center'
        ]);

        $this->redirect(route('admin.products.update', $this->product->id));

    }

    public function render()
    {
        return view('product::admin.products.livewire.update')->extends('admin.layouts.master', [
            'pageTitle' => 'ویرایش محصول ' . $this->title
        ]);
    }
}
