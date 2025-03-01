<?php

namespace App\Http\Controllers\API\promocode;

use App\Models\PromoCode;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PromoCodeController extends Controller
{
    use apiresponse;

    public function applyPromoCode(Request $request)
    {
        try {
            $request->validate([
                'promo_code' => 'required|string',
                'total_price' => 'nullable|numeric'
            ]);

            $promo = PromoCode::where('code', $request->promo_code)->first();

            if (!$promo) {
                Log::error("No such coupon: '{$request->promo_code}'");
                return response()->json(['status' => false, 'error' => 'Invalid promo code.', 'code' => 400], 400);
            }

            switch (true) {
                case $promo->isExpired():
                    return response()->json(['status' => false, 'error' => 'Promo code has expired.', 'code' => 400], 400);
                case !$promo->isAvailable():
                    return response()->json(['status' => false, 'error' => 'Promo code usage limit reached.', 'code' => 400], 400);
                case $promo->minimum_order_value > $request->total_price:
                    return response()->json(['status' => false, 'error' => 'Minimum order value not met.', 'code' => 400], 400);
            }

            $discount = ($promo->discount_type === 'percentage')  ? ($request->total_price * $promo->discount_value / 100)
                                                                    : $promo->discount_value;

            $discountedTotal = max(0, $request->total_price - $discount);

            return $this->success([
                'discount' => $discount,
                'discount_price' => $discountedTotal
            ], 'Promo code applied successfully', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->error([], $e->getMessage(), 500);
        }
    }
}
