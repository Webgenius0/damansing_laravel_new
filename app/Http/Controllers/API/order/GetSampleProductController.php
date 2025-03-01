<?php

namespace App\Http\Controllers\API\Order;

use Exception;
use App\Models\Order;
use App\Models\Product;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\BillingInfo;

class GetSampleProductController extends Controller
{
    use apiresponse;
    public function sampleProduct(Request $request, $id)
{
    try {
        $user = auth('api')->user();
        $product = Product::find($id);

     
        if (!$product) {
            return $this->success('Product not found.', 200);
        }

        
       $is_first_order = Order::where('user_id', $user->id)->where('is_first_order',true)->first();

        if ($is_first_order) {
            return $this->success([],'You are not eligible for a free sample product.', 200);
        }

      
        $order = Order::create([
            'user_id' => $user->id,
            'is_first_order' => true,
            'total_amount' => 0.00, 
            'payment_method' => 'free',
            'status' => 'completed',
        ]);
       
        $order->order_items()->create([
            'product_id' => $product->id,
            'quantity' => $request->input('quantity', 1),
            'price' => 0.00,
            'total' => 0.00,
        ]);


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

        $data = [
            'order_id' => $order->id,
            'total' => $order->total_amount,
            'status' => $order->status,
            'payment_method' => $order->payment_method,
            'is_sample_product' => true,
        ];

        return $this->success($data, 'Successfully placed the sample product order.', 200);

    } catch (Exception $e) {
        Log::error($e->getMessage());
        return $this->error([], 'Something went wrong: ' . $e->getMessage(), 500);
    }
}

}
