<?php

namespace Database\Seeders;

use App\Models\admin\Banner;
use App\Models\admin\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SlidersTableSeeder extends Seeder
{
    public function run()
    {
        // Sample data for food court banners
        $banners = [
            [
                'title' => 'Experience the Taste of Paradise',
                'description' => 'Indulge in a culinary journey like no other at our food court. From sizzling street food to gourmet delights, our diverse menu will satisfy every craving. Join us today and experience the true taste of paradise!',
                'link' => 'https://www.example.com/food-court',
                'background_image' => 'main.jpg', // Replace with your image path
            ],
            [
                'title' => 'Foodie Heaven Awaits You',
                'description' => 'Step into a world of flavor and aroma at our food court. We take pride in serving the finest dishes prepared with love and passion. Explore our menu, and let your taste buds dance with joy!',
                'link' => 'https://www.example.com/food-court-menu',
                'background_image' => 'hero-3.jpg', // Replace with your image path
            ],
            [
                'title' => 'Experience the Taste of Paradise',
                'description' => 'Indulge in a culinary journey like no other at our food court. From sizzling street food to gourmet delights, our diverse menu will satisfy every craving. Join us today and experience the true taste of paradise!',
                'link' => 'https://www.example.com/food-court',
                'background_image' => 'hero-2.jpg', // Replace with your image path
            ],
            [
                'title' => 'Family-Friendly Dining Experience',
                'description' => 'At our food court, we offer more than just food; we offer memories. Bring your loved ones and enjoy quality time together over delicious meals. Our warm and inviting atmosphere awaits your family!',
                'link' => 'https://www.example.com/family-dining',
                'background_image' => 'hero-4.jpg',
            ],
            // Add more banner data as needed
        ];

        // Loop through the data and insert into the database
        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
