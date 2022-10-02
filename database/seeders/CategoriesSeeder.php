<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Entities\Category;

class CategoriesSeeder extends Seeder
{
	public function run()
	{
         Category::factory()->count(50)->create();
    }
}
