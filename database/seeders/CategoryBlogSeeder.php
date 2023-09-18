<?php

namespace Database\Seeders;

use App\Models\CategoryBlog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Cuisines', 'slug' => 'cuisines'],
            ['name' => 'Food Reviews', 'slug' => 'food-reviews'],
            ['name' => 'Healthy Eating', 'slug' => 'healthy-eating'],
            ['name' => 'Food Court Events', 'slug' => 'food-court-events'],
        ];

        foreach ($categories as $category) {
            CategoryBlog::create($category);
        }
    }
}
