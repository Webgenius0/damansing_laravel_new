<?php

namespace App\Http\Controllers\API\Order;

use Exception;
use App\Models\Order;

use App\Traits\apiresponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    use apiresponse;
    public function orderHistory()
    {
        try {
            $user = Auth::user();
            $orders = Order::with('user', 'order_items')
                ->where('user_id', $user->id)
                ->get();

                if(!$orders){
                    return $this->success([], 'No Order History Found.', 200);
                }
    
            $orders = $orders->map(function ($order) {
                return [
                    'order_id' => $order->id,
                    'date' => $order->created_at->format('d-m-Y'),
                    'total' => $order->total,
                    'status' => $order->status,
                ];
            });
    
            return $this->success($orders, 'Order History Retrieved Successfully.', 200);
        } catch (Exception $e) {

            Log::error($e->getMessage());
            return $this->error('An error occurred while retrieving order history.', 500);
        }
    }
    
}
