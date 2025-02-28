<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable=[
        'code','discount_type','minimum_order_value','discount_value','usage_limit','expires_at'
    ];

    public function isExpired()
    {
        return $this->expires_at < now();
    }


    public function isAvailable()
    {
        return $this->used_count < $this->usage_limit;
    }
}
