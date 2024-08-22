<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 40; $i++) {
            Product::insert([
                'name' => fake()->word(),
                'description' => fake()->sentence(),
                'price' => random_int(10000, 100000),
                'quantity' => random_int(1,20),
                'image' => fake()->word(),
            ]);
        }
    }
}
