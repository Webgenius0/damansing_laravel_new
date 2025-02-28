<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price', 'net_weight', 'activity'];

    protected $hidden = ['created_at', 'updated_at'];

    public function cart()
    {
        return $this->belongsTo(Cart::class,'cart_id' , 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id' , 'id');
    }
}
