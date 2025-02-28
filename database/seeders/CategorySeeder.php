<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'title' => 'Dog Food',
                'slug' => Str::slug('Dog Food'),
                'status' => 'active',
                'image' => 'dog-food.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cat Food',
                'slug' => Str::slug('Cat Food'),
                'status' => 'active',
                'image' => 'cat-food.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bird Food',
                'slug' => Str::slug('Bird Food'),
                'status' => 'active',
                'image' => 'bird-food.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
