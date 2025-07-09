<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
        ];
    }
} 