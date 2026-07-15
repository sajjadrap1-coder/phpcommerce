<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@phpcommerce.ir'],
            [
                'name'     => 'مدیر سیستم',
                'email'    => 'admin@phpcommerce.ir',
                'password' => 'password',
                'is_admin' => true,
            ]
        );

        // Create a demo customer
        User::firstOrCreate(
            ['email' => 'customer@phpcommerce.ir'],
            [
                'name'     => 'کاربر نمونه',
                'email'    => 'customer@phpcommerce.ir',
                'password' => 'password',
                'is_admin' => false,
            ]
        );

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}

