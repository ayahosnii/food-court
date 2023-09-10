<?php

namespace Database\Seeders;

use App\Models\CategoryBlog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Desserts',
                'slug' => 'desserts',
                'is_active' => 1,
                'provider_id' => 1
            ],
            [
                'id' => 2,
                'name' => 'Ice Creams',
                'slug' => 'ice-creams',
                'is_active' => 1,
                'provider_id' => 1
            ],
            [
                'id' => 3,
                'name' => 'Milkshakes',
                'slug' => 'milkshakes',
                'is_active' => 1,
                'provider_id' => 1
            ],
            [
                'id' => 4,
                'name' => 'Beverages',
                'slug' => 'beverages',
                'is_active' => 1,
                'provider_id' => 4
            ],
            [
                'id' => 5,
                'name' => 'Pastries',
                'slug' => 'pastries',
                'is_active' => 1,
                'provider_id' => 4
            ],
        ]);

    }
}
