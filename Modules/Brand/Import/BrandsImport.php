<?php

namespace Modules\Brand\Import;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\Brand\Entities\Brand;

class BrandsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $brand = Brand::create([
                'title' => $row[0],
                'slug' => $row[1],
//                'image' => $row[2],
//                'description' => $row[3],
            ]);
        }
    }
}
