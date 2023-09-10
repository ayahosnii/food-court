<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurantNames = [
            'Borcelle kitchen',
            'Fauget',
            'Healthy food',
            'Queen Cafe',
            'Bor celle',
        ];

        $restaurantEmails = [];
        $restaurantUsername = [];
        $restaurantPhoneNumbers = [];

        for ($i = 0; $i < count($restaurantNames); $i++) {
            $restaurantEmails[$i] = strtolower(str_replace(' ', '_', $restaurantNames[$i])) . '@email.com';
            $restaurantUsername[$i] = strtolower(str_replace(' ', '_', $restaurantNames[$i]));

            do {
                $restaurantPhoneNumbers[$i] = '0' . rand(11, 15) . rand(10000000, 99999999);
            } while (in_array($restaurantPhoneNumbers[$i], array_slice($restaurantPhoneNumbers, 0, $i)));

            DB::table('providers')->insert([
                'name' => $restaurantNames[$i],
                'email' => $restaurantEmails[$i],
                'password' => bcrypt('12345678'),
                'phone' => $restaurantPhoneNumbers[$i],
                'user_name' => $restaurantUsername[$i],
                'ar_details' => Str::random(100),
                'en_details' => Str::random(100),
                'logo' => 'cat_' . ($i + 1) . '.jpg',
                'address' => Str::random(100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
