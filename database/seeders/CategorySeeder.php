<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'الکترونیک', 'slug' => 'electronics', 'description' => 'محصولات الکترونیکی و دیجیتال'],
            ['name' => 'پوشاک', 'slug' => 'clothing', 'description' => 'لباس و پوشاک'],
            ['name' => 'کتاب', 'slug' => 'books', 'description' => 'کتاب و مطالعه'],
            ['name' => 'خانه و آشپزخانه', 'slug' => 'home-kitchen', 'description' => 'لوازم خانه و آشپزخانه'],
            ['name' => 'ورزش', 'slug' => 'sports', 'description' => 'تجهیزات ورزشی'],
            ['name' => 'زیبایی و بهداشت', 'slug' => 'beauty-health', 'description' => 'محصولات بهداشتی و زیبایی'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                array_merge($category, ['is_active' => true])
            );
        }
    }
}
