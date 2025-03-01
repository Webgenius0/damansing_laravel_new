<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'unique_order_id',
        'total_amount',
        'status',
        'checkout_url',
        'payment_method',
        'shipping_fee',
        'discount',
        'is_first_order'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {

            $randomId = random_int(1000, 9999);
            while (Order::where('unique_order_id', $randomId)->exists()) {
                $randomId = random_int(1000, 9999);
            }
            $order->unique_order_id = $randomId;
        });
    }


    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
