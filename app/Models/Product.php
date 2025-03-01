<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $guarded=[];

  public function updateStock($quantity)
  {
      $this->stock -= $quantity;
      $this->save();
  }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
