<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceCalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Male - Moderate Activity
            ['dog_weight' => 5, 'gender' => 'male', 'activity_level' => 'moderate', 'calories' => '150', 'price' => 125],
            ['dog_weight' => 10, 'gender' => 'male', 'activity_level' => 'moderate', 'calories' => '250-350', 'price' => 175],
            ['dog_weight' => 20, 'gender' => 'male', 'activity_level' => 'moderate', 'calories' => '450-650', 'price' => 325],
            ['dog_weight' => 30, 'gender' => 'male', 'activity_level' => 'moderate', 'calories' => '650-750', 'price' => 400],
            ['dog_weight' => 40, 'gender' => 'male', 'activity_level' => 'moderate', 'calories' => '750-850', 'price' => 425],
            ['dog_weight' => 50, 'gender' => 'male', 'activity_level' => 'moderate', 'calories' => '850-1050', 'price' => 475],
            ['dog_weight' => 60, 'gender' => 'male', 'activity_level' => 'moderate', 'calories' => '1050-1350', 'price' => 575],
            ['dog_weight' => 70, 'gender' => 'male', 'activity_level' => 'moderate', 'calories' => '1350-1550', 'price' => 625],

            // Male - High Activity
            ['dog_weight' => 5, 'gender' => 'male', 'activity_level' => 'high', 'calories' => '200', 'price' => 150],
            ['dog_weight' => 10, 'gender' => 'male', 'activity_level' => 'high', 'calories' => '300-500', 'price' => 200],
            ['dog_weight' => 20, 'gender' => 'male', 'activity_level' => 'high', 'calories' => '500-700', 'price' => 350],
            ['dog_weight' => 30, 'gender' => 'male', 'activity_level' => 'high', 'calories' => '700-800', 'price' => 400],
            ['dog_weight' => 40, 'gender' => 'male', 'activity_level' => 'high', 'calories' => '800-900', 'price' => 450],
            ['dog_weight' => 50, 'gender' => 'male', 'activity_level' => 'high', 'calories' => '900-1100', 'price' => 500],
            ['dog_weight' => 60, 'gender' => 'male', 'activity_level' => 'high', 'calories' => '1100-1400', 'price' => 600],
            ['dog_weight' => 70, 'gender' => 'male', 'activity_level' => 'high', 'calories' => '1400-1600', 'price' => 650],

            // Female - Moderate Activity
            ['dog_weight' => 5, 'gender' => 'female', 'activity_level' => 'moderate', 'calories' => '150', 'price' => 125],
            ['dog_weight' => 10, 'gender' => 'female', 'activity_level' => 'moderate', 'calories' => '250-350', 'price' => 175],
            ['dog_weight' => 20, 'gender' => 'female', 'activity_level' => 'moderate', 'calories' => '450-650', 'price' => 325],
            ['dog_weight' => 30, 'gender' => 'female', 'activity_level' => 'moderate', 'calories' => '650-750', 'price' => 400],
            ['dog_weight' => 40, 'gender' => 'female', 'activity_level' => 'moderate', 'calories' => '750-850', 'price' => 425],
            ['dog_weight' => 50, 'gender' => 'female', 'activity_level' => 'moderate', 'calories' => '850-1050', 'price' => 475],
            ['dog_weight' => 60, 'gender' => 'female', 'activity_level' => 'moderate', 'calories' => '1050-1350', 'price' => 575],
            ['dog_weight' => 70, 'gender' => 'female', 'activity_level' => 'moderate', 'calories' => '1350-1550', 'price' => 625],

            // Female - High Activity
            ['dog_weight' => 5, 'gender' => 'female', 'activity_level' => 'high', 'calories' => '200', 'price' => 150],
            ['dog_weight' => 10, 'gender' => 'female', 'activity_level' => 'high', 'calories' => '300-500', 'price' => 200],
            ['dog_weight' => 20, 'gender' => 'female', 'activity_level' => 'high', 'calories' => '500-700', 'price' => 350],
            ['dog_weight' => 30, 'gender' => 'female', 'activity_level' => 'high', 'calories' => '700-800', 'price' => 400],
            ['dog_weight' => 40, 'gender' => 'female', 'activity_level' => 'high', 'calories' => '800-900', 'price' => 450],
            ['dog_weight' => 50, 'gender' => 'female', 'activity_level' => 'high', 'calories' => '900-1100', 'price' => 500],
            ['dog_weight' => 60, 'gender' => 'female', 'activity_level' => 'high', 'calories' => '1100-1400', 'price' => 600],
            ['dog_weight' => 70, 'gender' => 'female', 'activity_level' => 'high', 'calories' => '1400-1600', 'price' => 650],
        ];

        DB::table('price_calculations')->insert($data);
    }
}
