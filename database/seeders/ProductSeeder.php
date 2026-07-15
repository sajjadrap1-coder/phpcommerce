<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Electronics
            [
                'category_slug' => 'electronics',
                'name'          => 'هدفون بی‌سیم',
                'description'   => 'هدفون بی‌سیم با کیفیت صدای عالی و باتری با دوام',
                'price'         => 850000,
                'sale_price'    => 720000,
                'stock'         => 25,
                'is_featured'   => true,
            ],
            [
                'category_slug' => 'electronics',
                'name'          => 'ساعت هوشمند',
                'description'   => 'ساعت هوشمند با قابلیت‌های پیشرفته سلامت',
                'price'         => 1200000,
                'sale_price'    => null,
                'stock'         => 15,
                'is_featured'   => true,
            ],
            [
                'category_slug' => 'electronics',
                'name'          => 'پاوربانک ۲۰۰۰۰mAh',
                'description'   => 'پاوربانک با ظرفیت بالا و شارژ سریع',
                'price'         => 450000,
                'sale_price'    => 380000,
                'stock'         => 50,
                'is_featured'   => false,
            ],
            // Clothing
            [
                'category_slug' => 'clothing',
                'name'          => 'تیشرت اسپرت',
                'description'   => 'تیشرت اسپرت راحت مناسب برای ورزش و روزمره',
                'price'         => 185000,
                'sale_price'    => null,
                'stock'         => 100,
                'is_featured'   => false,
            ],
            [
                'category_slug' => 'clothing',
                'name'          => 'شلوار جین',
                'description'   => 'شلوار جین مد روز با کیفیت بالا',
                'price'         => 420000,
                'sale_price'    => 350000,
                'stock'         => 60,
                'is_featured'   => true,
            ],
            // Books
            [
                'category_slug' => 'books',
                'name'          => 'آموزش PHP',
                'description'   => 'کتاب جامع آموزش برنامه‌نویسی PHP از مقدماتی تا پیشرفته',
                'price'         => 125000,
                'sale_price'    => null,
                'stock'         => 30,
                'is_featured'   => true,
            ],
            [
                'category_slug' => 'books',
                'name'          => 'مرجع Laravel',
                'description'   => 'کتاب مرجع فریم‌ورک Laravel',
                'price'         => 145000,
                'sale_price'    => 120000,
                'stock'         => 20,
                'is_featured'   => false,
            ],
            // Home & Kitchen
            [
                'category_slug' => 'home-kitchen',
                'name'          => 'قهوه‌ساز اتوماتیک',
                'description'   => 'قهوه‌ساز اتوماتیک با قابلیت تنظیم قوت قهوه',
                'price'         => 680000,
                'sale_price'    => null,
                'stock'         => 12,
                'is_featured'   => true,
            ],
        ];

        foreach ($products as $data) {
            $category = Category::where('slug', $data['category_slug'])->first();
            if (!$category) {
                continue;
            }

            $name = $data['name'];
            Product::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'category_id' => $category->id,
                    'name'        => $name,
                    'description' => $data['description'],
                    'price'       => $data['price'],
                    'sale_price'  => $data['sale_price'],
                    'stock'       => $data['stock'],
                    'is_active'   => true,
                    'is_featured' => $data['is_featured'],
                ]
            );
        }
    }
}
