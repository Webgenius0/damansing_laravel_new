<?php

namespace App\Http\Controllers\API\promocode;

use App\Models\Cart;
use App\Models\PromoCode;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

            $user = Auth::user();

            $cart = Cart::with('user', 'cart_items')->where('user_id', $user->id)->first();

            if (!$cart || $cart->cart_items->isEmpty()) {
                return $this->success([], 'Cart is empty.', 200);
            }

            $total_price = $cart->cart_items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
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
                case $promo->minimum_order_value > $total_price:
                    return response()->json(['status' => false, 'error' => 'Minimum order value not met.', 'code' => 400], 400);
            }

            if ($promo->discount_type === 'percentage') {
                $discount = ($total_price * $promo->discount_value) / 100;
                $discountMessage = "You get a {$promo->discount_value}% discount.";
            } else {
                $discount = $promo->discount_value;
                $discountMessage = "You get a rs{$promo->discount_value} discount.";
            }

    
        $discountedTotal = max(0, $total_price - $discount);

        return $this->success([
            'total_price' => $total_price,
            'discount' => $discount,
            'discount_price' => $discountedTotal,
            'discount_message' => $discountMessage
        ], 'Promo code applied successfully', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->error([], $e->getMessage(), 500);
        }
    }
}
