<?php

namespace Database\Factories;

use Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Category\Entities\Category;

class CategoriesFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'title'     => \Faker::word(),
            'parent_id' => rand(0, 30),
        ];
    }
}
