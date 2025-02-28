<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1, 
                'title' => 'Premium Chicken Dog Food',
                'slug' => Str::slug('Premium Chicken Dog Food'),
                'stock' => 50,
                'net_weight' => 500, 
                'pet_type' => 'Dog',
                'food_details' => 'High-protein chicken-flavored dry dog food with essential vitamins.',
                'price' => 19.99,
                'image' => 'dog-food-chicken.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2, 
                'title' => 'Salmon Delight Cat Food',
                'slug' => Str::slug('Salmon Delight Cat Food'),
                'stock' => 40,
                'net_weight' => 400, 
                'pet_type' => 'Cat',
                'food_details' => 'Delicious salmon-based cat food with omega-3 for healthy fur.',
                'price' => 15.49,
                'image' => 'cat-food-salmon.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3, 
                'title' => 'Mixed Seeds Bird Food',
                'slug' => Str::slug('Mixed Seeds Bird Food'),
                'stock' => 60,
                'net_weight' => 300, 
                'pet_type' => 'Bird',
                'food_details' => 'A nutritious blend of sunflower seeds, millet, and dried fruits for birds.',
                'price' => 12.99,
                'image' => 'bird-food-seeds.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    
    }
}
