<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::factory(5)->create();
        $brands = Brand::factory(5)->create();

        foreach ($categories as $category) {
            foreach ($brands as $brand) {
                Product::factory(10)->create([
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
        ]);
            }
        }
    }
}
