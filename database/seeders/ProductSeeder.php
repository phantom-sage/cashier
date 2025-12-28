<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'Premium Wireless Headphones',
            'description' => 'High-quality wireless headphones with noise cancellation, premium sound quality, and long-lasting battery life. Perfect for music lovers and professionals.',
            'price' => 299.99,
            'image' => null,
        ]);

        \App\Models\Product::create([
            'name' => 'Smart Fitness Tracker',
            'description' => 'Advanced fitness tracker with heart rate monitoring, GPS tracking, sleep analysis, and smartphone notifications. Water-resistant design for active lifestyles.',
            'price' => 149.99,
            'image' => null,
        ]);

        \App\Models\Product::create([
            'name' => 'Portable Bluetooth Speaker',
            'description' => 'Compact and powerful Bluetooth speaker with 360-degree sound, waterproof design, and 12-hour battery life. Perfect for outdoor adventures.',
            'price' => 79.99,
            'image' => null,
        ]);

        \App\Models\Product::create([
            'name' => 'Wireless Charging Pad',
            'description' => 'Fast wireless charging pad compatible with all Qi-enabled devices. Sleek design with LED indicator and overcharge protection.',
            'price' => 39.99,
            'image' => null,
        ]);

        \App\Models\Product::create([
            'name' => 'Smart Home Security Camera',
            'description' => 'HD security camera with night vision, motion detection, two-way audio, and cloud storage. Easy setup and mobile app control.',
            'price' => 199.99,
            'image' => null,
        ]);
    }
}
