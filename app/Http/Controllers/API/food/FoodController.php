<?php

namespace App\Http\Controllers\API\food;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\apiresponse;

class FoodController extends Controller
{
    use apiresponse;
    public function viewDetails($id)
    {
        $food = Product::find($id);
        if (!$food) {
            return $this->error([], 'Product not found', 404);
        }
        $petTypeNames = [
            0 => 'puppy',
            1 => 'adult',
            2 => 'large',
        ];
    
        if (array_key_exists($food->pet_type, $petTypeNames)) {
            $food->pet_type = $petTypeNames[$food->pet_type];
        } else {
            $food->pet_type = 'unknown';
        }
    
        $food->setHidden(['created_at','updated_at']);
        return $this->success([
            'food' => $food,
        ], 'Fetched Successfully');
    }

    //show all products according to category

    public function showAllFood()
    {
        $type = [
            '0' => 'puppy',
            '1' => 'adult',
            '2' => 'large',
        ];    
        $foods = Product::with('category')->get()->groupBy('category_id');
    
        $data = [];
        foreach ($foods as $group) {
            
            $products = $group->map(function ($product) use ($type) {
                $product->pet_type = $type[$product->pet_type] ?? $product->pet_type;
                $product->setHidden(['category','created_at','updated_at']);
                return $product;
            })->values();
    
            $data[] = [
                'category_name' => $group->first()->category->title,
                'foods'         => $products,
            ];
        }
        return response()->json([
            'message' => 'Fetched Successfully',
            'status'  => 200,
            'data'    => $data,
        ]);
    }
}
