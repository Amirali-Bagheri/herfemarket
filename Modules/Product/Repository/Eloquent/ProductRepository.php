<?php

namespace Modules\Product\Repository\Eloquent;

use Illuminate\Support\Collection;
use Modules\Crawl\Entities\CrawledProducts;
use Modules\Product\Entities\Product;
use Modules\Product\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
//    public function __construct(Product $product)
//    {
//        parent::__construct($product);
//    }

    public function all(): Collection
    {
        return $this->product->all();
    }

    public function deleteFull($id)
    {
        if (empty($id)) {
            return false;
        }

        $product = Product::findOrFail($id);

//        if (isset($product->images)) {
//            foreach ($product->images as $image) {
//                if ($image != 'product.png') {
//                    \Illuminate\Support\Facades\Storage::disk('local')->delete('/uploads/thumbnails/tn_' . $image);
//                    Storage::disk('local')->delete('/uploads/' . $image);
//                }
//            }
//        }


        CrawledProducts::where('product_id', $product->id)->update([
            'status' => 0,
            'product_id' => null
        ]);
//        if (isset($product->crawled_product)) {
//            $product->crawled_product()->update([
//                'product_id' => null
//            ]);
//        }

//        $product->has('crawled_product') ? $product->crawled_product()->delete() : null;
        !empty($product->prices) ? $product->prices()->delete() : null;
        !empty($product->rating) ? $product->rating()->delete() : null;
        !empty($product->reports) ? $product->reports()->delete() : null;
        !empty($product->comments) ? $product->comments()->delete() : null;
        !empty($product->categories) ? $product->categories()->detach() : null;

        visits($product)->reset();

        $product->delete();

        return true;
    }
}
