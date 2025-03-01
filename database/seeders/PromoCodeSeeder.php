<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\PromoCode;
use Illuminate\Database\Seeder;


class PromoCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promoCodes = [
            [
                'code' => 'WELCOME10',
                'discount_value' => 10, 
                'discount_type' => 'percentage',
                'expires_at' => Carbon::now()->addDays(30),
                'usage_limit' => 100,
                'used_count' => 0,
                'minimum_order_value' => 50, 
            ],
            [
                'code' => 'FLAT5OFF',
                'discount_value' => 5,
                'discount_type' => 'fixed',
                'expires_at' => Carbon::now()->addDays(15),
                'usage_limit' => 50,
                'used_count' => 0,
                'minimum_order_value' => 20, 
                
            ],
            [
                'code' => 'FREESHIP',
                'discount_value' => 20, 
                'discount_type' => 'percentage',
                'expires_at' => Carbon::now()->addDays(7),
                'usage_limit' => 10,
                'used_count' => 0,
                'minimum_order_value' => 0, 
                
            ]
        ];

        // foreach ($promoCodes as $promo) {
        //     PromoCode::create($promo);
        // }
    }
}
