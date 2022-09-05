<?php

namespace Modules\Category\Import;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\Category\Entities\Category;

class CategoriesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $category = Category::create([
                'title' => $row[0],
                'parent_id' => (int)$row[1],
            ]);
        }
    }
}
