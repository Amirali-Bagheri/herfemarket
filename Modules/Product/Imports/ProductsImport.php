<?php

namespace Modules\Product\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $product = Product::create([
                'title' => $row[0],
                'en_title' => $row[7],
                'slug' => $row[1],
                'code' => $row[2],
                'description' => $row[3],
                'brand_id' => intval($row[4]),
                'images' => Str::of($row[5])->explode(','),
            ]);

            if (!$row[6]) {

//            $product->save();
//
//            if (array($row[6]) != null) {
//                $product->categories()->sync(array($row[7]));
//            }
                continue;
            }
            $product->categories()->sync(Str::of($row[6])->explode(','));
            foreach (Str::of($row[6])->explode(',') as $categoryID) {
                $category = Category::find($categoryID);
                $product->categories()->sync($category->id);
                $product->categories()->attach($category->parents->pluck('id'));
            }


//            $product->save();
//
//            if (array($row[6]) != null) {
//                $product->categories()->sync(array($row[7]));
//            }
        }
    }
}
