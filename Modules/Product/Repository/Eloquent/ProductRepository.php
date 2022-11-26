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

    public function deleteFull($id)
    {
        if (empty($id)) {
            return false;
        }

        $product = Product::findOrFail($id);

        !empty($product->comments) ? $product->comments()->delete() : null;
        !empty($product->categories) ? $product->categories()->detach() : null;

        // visits($product)->reset();

        $product->delete();

        return true;
    }
}
