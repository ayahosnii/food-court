<?php

namespace Database\Seeders;

use App\Models\CategoryBlog;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed posts for each category
        $categories = [
            'Cuisines',
            'Food Reviews',
            'Healthy Eating',
            'Food Court Events',
        ];

        foreach ($categories as $categoryName) {
            $category = \App\Models\CategoryBlog::where('name', $categoryName)->firstOrFail();

            for ($i = 1; $i <= 5; $i++) {
                $title = "{$categoryName} Post {$i}";
                $slug = Str::slug($title);

                Post::create([
                    'id' => $i,
                    'title' => $title,
                    'slug' => $slug,
                    'body' => "This is the body of the {$title} article.",
                    'image' => 'example.jpg',
                    'user_id' => 1,
                    'category_id' => $category->id,
                ]);
            }
        }
    }}
