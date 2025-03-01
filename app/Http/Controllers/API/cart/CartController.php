<?php

namespace App\Http\Controllers\API\cart;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use App\Models\PriceCalculation;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use apiresponse;

    public function addToCart(Request $request, $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return $this->success([], 'Product does not exist.', 200);
            }

            $quantity = (int) $request->input('quantity', 1);
            if ($quantity < 1) {
                return $this->success([], 'Invalid quantity provided.', 200);
            }

            if ($product->stock < $quantity) {
                return $this->success([], 'Not enough stock available.', 200);
            }

            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

            $price_calculation = PriceCalculation::where('dog_weight', '>', $request->dog_weight)
                ->where('gender', $request->gender)
                ->where('activity_level', $request->activity_level)
                ->first();

            if (!$price_calculation) {
                return $this->error([], 'Price calculation not found for the given criteria.', 400);
            }

            if ($cartItem) {
                if (($cartItem->quantity + $quantity) > $product->stock) {
                    return $this->success([], 'Not enough stock available.', 200);
                }

                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                $cartItem = CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price_calculation->price,
                    'net_weight' => $price_calculation->calories,
                    'activity' => $price_calculation->activity_level,
                ]);
            }

            return $this->success([
                'product_id' => $product->id,
                'quantity' => $cartItem->quantity,
                'price' => $price_calculation->price,
            ], 'Product successfully added to cart.', 200);
        } catch (Exception $e) {

            Log::error($e->getMessage());
            return $this->error([], 'Something went wrong', 500);
        }
    }


    public function updateCartQuantity(Request $request, $id)
    {
        try {
            $cart = Cart::where('user_id', auth()->id())->first();

            if (!$cart) {
                return $this->error([], 'Cart not found.', 404);
            }

            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $id)->first();

            if (!$cartItem) {
                return $this->error([], 'Product not found in cart.', 404);
            }

            $product = Product::find($id);

            if (!$product) {
                return $this->error([], 'Product does not exist.', 404);
            }

            $action = $request->input('action');

            if ($action === 'increase') {

                if ($cartItem->quantity + 1 > $product->stock) {
                    return $this->error([], 'Not enough stock available.', 400);
                }
                $cartItem->increment('quantity');
            } elseif ($action === 'decrease') {
                if ($cartItem->quantity <= 1) {
                    return $this->error([], 'Quantity cannot be less than 1.', 400);
                }
                $cartItem->decrement('quantity');
            } else {
                return $this->error([], 'Invalid action provided.', 400);
            }

            return $this->success([
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
            ], 'Cart quantity updated.', 200);
        } catch (Exception $e) {
            
            Log::error($e->getMessage());
            return $this->error([], 'Something went wrong', 500);
        }
    }

    public function deleteFromCart($id)
    {
        try {
            $cart = Cart::where('user_id', auth()->id())->first();

            if (!$cart) {
                return $this->error('Cart not found.', 404);
            }

            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $id)->first();

            if (!$cartItem) {
                return $this->error('Product not found in cart.', 404);
            }

            $cartItem->delete();

            return $this->success([], 'Product removed from cart.', 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->error([], 'Something went wrong', 500);
        }
    }

    public function showCart()
    {
        $cart = Cart::with('cart_items.product')
            ->where('user_id', auth()->id())
            ->first();


        if (!$cart || $cart->cart_items->isEmpty()) {
            return $this->error('Cart is empty.', 404);
        }

        $petType = [
            0 => 'puppy',
            1 => 'adult',
            2 => 'large',
        ];

        $cartItems = $cart->cart_items->map(function ($cartItem) use ($petType) {
            $product = $cartItem->product;

            $availableQuantity = $cartItem->quantity;
            $totalPrice = $availableQuantity * $cartItem->price;

            return [
                'cart_id' => $cartItem->id,
                'product_id' => $cartItem->product_id,
                'title' => $product->title,
                'net_weight' => $product->net_weight . ' Calories',
                'pet_type' => array_key_exists($product->pet_type, $petType) ? $petType[$product->pet_type] : 'unknown',
                'price' => $cartItem->price,
                'quantity' => $availableQuantity,
                'total_price' => $totalPrice,
                'product_image' => $product->image ?: asset('images/no-image-placeholder.png')
            ];
        });

        return $this->success($cartItems, 'Cart data retrieved successfully.', 200);
    }
}
