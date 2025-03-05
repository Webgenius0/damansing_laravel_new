<?php

namespace App\Http\Controllers\API\Order;

use Exception;
use Stripe\Webhook;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\PromoCode;
use App\Models\BillingInfo;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderPaymentController extends Controller
{
    use apiresponse;
    public function OrderSummary(Request $request)
    {
        try {
            $user = auth('api')->user();

            if (!$user) {
                return $this->error([], 'User not found.', 404);
            }

            $cart = Cart::with('cart_items.product')
                ->where('user_id', $user->id)
                ->first();

            if (!$cart || $cart->cart_items->isEmpty()) {
                return $this->error([], 'Cart is empty.', 200);
            }


            $subtotal = $cart->cart_items->sum(function ($cartItem) {
                return $cartItem->quantity * $cartItem->price;
            });

            $shipping = 00.00;
            $discount = 0;


            if ($request->has('promo_code')) {
                $promo = PromoCode::where('code', $request->promo_code)->first();

                if ($promo && !$promo->isExpired() && $promo->isAvailable()) {

                    if ($promo->discount_type === 'percentage') {

                        $discount = ($subtotal * $promo->discount_value) / 100;
                    } else {

                        $discount = $promo->discount_value;
                    }


                    $discount = min($discount, $subtotal);
                }
            }

            $total = $subtotal + $shipping - $discount;


            $orderSummary = [
                'items' => $cart->cart_items->map(function ($cartItem) {
                    return [
                        'product_id' => $cartItem->product_id,
                        'product_name' => $cartItem->product->title,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->price,
                        'total' => $cartItem->quantity * $cartItem->price,
                        'image' => $cartItem->product->image
                    ];
                }),
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'discount' => $discount,
                'total' => $total,
            ];


            return $this->success($orderSummary, 'Order summary retrieved successfully.', 200);
        } catch (Exception $e) {

            Log::error($e->getMessage());
            return $this->error([], $e->getMessage(), 500);
        }
    }




    public function placeOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = auth('api')->user();
            $cart = Cart::with('cart_items')->where('user_id', $user->id)->first();

            if (!$cart || $cart->cart_items->isEmpty()) {
                return $this->success([], 'Cart is empty.', 200);
            }

            // Get selected cart item IDs from the request
            $selectedCartItemIds = $request->input('selected_cart_items', []);

            // Filter cart items to only include selected items
            $selectedCartItems = $cart->cart_items->filter(function ($item) use ($selectedCartItemIds) {
                return in_array($item->id, $selectedCartItemIds);
            });

            if ($selectedCartItems->isEmpty()) {
                return $this->success([], 'No items selected for checkout.', 200);
            }

            $subtotal = $selectedCartItems->sum(fn($item) => $item->quantity * $item->price);

            $discount = 0;
            $discountMessage = '';

            if ($request->has('promo_code')) {
                $promo = PromoCode::where('code', $request->promo_code)->first();

                if ($promo && !$promo->isExpired() && $promo->isAvailable()) {
                    if ($promo->discount_type === 'percentage') {
                        $discount = ($subtotal * $promo->discount_value) / 100;
                        $discountMessage = "You get a {$promo->discount_value}% discount. Promo Code: {$promo->code}";
                    } else {
                        $discount = $promo->discount_value;
                        $discountMessage = "You get a \${$promo->discount_value} discount. Promo Code: {$promo->code}";
                    }

                    $discount = min($discount, $subtotal);
                }
            }

            $shipping = 0.00;
            $total = $subtotal + $shipping - $discount;
            $paymentMethod = $request->payment_method;

            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $total,
                'status' => 'processing',
                'payment_method' => $paymentMethod,
                'shipping_fee' => $shipping,
                'discount' => $discount,
                'discount_message' => $discountMessage
            ]);

            foreach ($selectedCartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'total' => $cartItem->quantity * $cartItem->price
                ]);

                // Decrement product stock
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            BillingInfo::create([
                'order_id' => $order->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'country' => $request->country,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'notes' => $request->notes,
                'different_address' => $request->different_address
            ]);

            if ($paymentMethod === 'stripe') {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                $lineItems = [];

                foreach ($selectedCartItems as $cartItem) {
                    $lineItems[] = [
                        'price_data' => [
                            'currency' => 'inr',
                            'product_data' => [
                                'name' => $cartItem->product->title,
                            ],
                            'unit_amount' => $cartItem->price * 100
                        ],
                        'quantity' => $cartItem->quantity,
                    ];
                }

                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'inr',
                        'product_data' => [
                            'name' => 'Shipping',
                        ],
                        'unit_amount' => $shipping * 100
                    ],
                    'quantity' => 1,
                ];

                $checkoutSession = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'success_url' => 'https://damanasing/payment-success',
                    'cancel_url'  => 'https://damanasing/payment-cancel',
                    'metadata' => [
                        'order_id' => $order->id,
                        'user_id' => $user->id,
                        'selected_cart_items' => json_encode($selectedCartItemIds)
                    ],
                    'expires_at' => now()->addMinutes(30)->timestamp,
                ]);

                $order->update([
                    'checkout_url' => $checkoutSession->url
                ]);

                DB::commit();
                return $this->success([
                    'checkout_url' => $checkoutSession->url,
                    'payment_method' => $paymentMethod
                ], 'Payment URL generated', 200);
            }

            $order->update([
                'status' => 'completed'
            ]);

            if ($order->discount > 0) {
                $promo = PromoCode::where('code', $order->discount_message)->first();

                if ($promo) {
                    $promo->increment('used_count');
                    Log::info("Promo Code {$promo->code} usage incremented. New count: {$promo->used_count}");
                }
            }

            // Delete only the selected cart items
            $cart->cart_items()->whereIn('id', $selectedCartItemIds)->delete();

            DB::commit();
            return $this->success([
                'order_id' => $order->id,
                'payment_method' => $paymentMethod
            ], 'Order placed successfully', 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->error([$e->getMessage()], $e->getMessage(), 500);
        }
    }


    public function stripeWebhook(Request $request)
    {
        // change 
        Log::info('stripe webhook is running');

        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');


        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {

            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);

            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;
                    $this->handlePaymentIntentSucceeded($paymentIntent);
                    break;
                case 'checkout.session.expired':
                    $paymentIntent = $event->data->object;
                    $this->handlePaymentIntentFailed($paymentIntent);
                    break;

                case 'checkout.session.completed':
                    $session = $event->data->object;
                    $this->handleCheckoutSessionCompleted($session);
                    break;
                default:
                    Log::info('Unhandled event type: ' . $event->type);
            }

            Log::info('Webhook handled successfully');

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            Log::error('Webhooks error: ' . $e->getMessage());
            return response()->json(['error' => 'Webhook handling failed'], 400);
        }
    }

    protected function handlePaymentIntentSucceeded($paymentIntent)
    {
        $orderId = $paymentIntent->metadata->order_id;
        $userId = $paymentIntent->metadata->user_id;
        $selectedCartItemIds = json_decode($paymentIntent->metadata->selected_cart_items, true);

        $order = Order::find($orderId);
        if ($order) {
            $order->update(['status' => 'completed']);

            foreach ($order->orderItems as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->decrement('stock', $item->quantity);
                }
            }
        }

        $cart = Cart::with('cart_items')->where('user_id', $userId)->first();
        $cart->cart_items()->whereIn('id', $selectedCartItemIds)->delete();

        Log::info("PaymentIntent succeeded for order. Deleted selected cart items for order {$orderId}");
    }



    protected function handlePaymentIntentCreated($paymentIntent)
    {
        Log::info($paymentIntent->OrderSummury);
        $orderId = $paymentIntent->metadata->order_id;
        $userId = $paymentIntent->metadata->user_id;
        $order = Order::find($orderId);
        if ($order) {
            $order->update(['status' => 'completed']);
        }

        $cart = Cart::with('product')->where('user_id', $userId)->first();
        $cart->product()->delete();

        Log::info("PaymentIntent succeeded for order .card dele {$orderId}");
    }

    protected function handlePaymentIntentFailed($paymentIntent)
    {
        $orderId = $paymentIntent->metadata->order_id;
        $order = Order::find($orderId);
        if ($order) {
            $order->update(['status' => 'cancelled']);

            foreach ($order->orderItems as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }
        }

        Log::info("PaymentIntent failed for order {$orderId}");
    }

    protected function handleCheckoutSessionCompleted($session)
    {
        Log::info($session->OrderSummury);
        $orderId = $session->metadata->order_id;

        $order = Order::find($orderId);
        if ($order) {
            $order->update(['status' => 'completed']);

            foreach ($order->orderItems as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->decrement('stock', $item->quantity);
                }
            }

            if ($order->discount > 0) {
                $promo = PromoCode::where('code', $order->discount_message)->first();

                if ($promo) {
                    $promo->increment('used_count');
                    Log::info("Promo Code {$promo->code} usage incremented. New count: {$promo->used_count}");
                }
            }
        }

        $cart = Cart::with('cart_items')->where('user_id', Auth::user()->id)->first();
        $cart->cart_items()->delete();


        Log::info("Checkout session completed for order . with delete card {$orderId}");
    }
}
