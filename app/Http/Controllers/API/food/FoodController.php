<?php

namespace App\Http\Controllers\API\food;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\apiresponse;

class FoodController extends Controller
{
    use apiresponse;
    public function viewDetails($slug)
{
   
    $food = Product::where('slug', $slug)->first(); 
    
   
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

   
    $food->setHidden(['created_at', 'updated_at']);

   
    return $this->success([
        'food' => $food,
    ], 'Fetched Successfully');
}


    //show all products according to category

    // public function showAllFood()
    // {
    //     $type = [
    //         '0' => 'puppy',
    //         '1' => 'adult',
    //         '2' => 'large',
    //     ];    
    //     $foods = Product::with('category')->get()->groupBy('category_id');
    
    //     $data = [];
    //     foreach ($foods as $group) {
            
    //         $products = $group->map(function ($product) use ($type) {
    //             $product->pet_type = $type[$product->pet_type] ?? $product->pet_type;
    //             $product->setHidden(['category','created_at','updated_at']);
    //             return $product;
    //         })->values();
    
    //         $data[] = [
    //             'category_name' => $group->first()->category->title,
    //             'foods'         => $products,
    //         ];
    //     }
    //     return response()->json([
    //         'message' => 'Fetched Successfully',
    //         'status'  => 200,
    //         'data'    => $data,
    //     ]);
    // }

    public function showAllFood()
{
    $type = [
        '0' => 'puppy',
        '1' => 'adult',
        '2' => 'large',
    ];    
   
    $foods = Product::with('category')->paginate(4);

    $groupedFoods = $foods->groupBy('category_id');

    $data = [];
    foreach ($groupedFoods as $group) {
        $products = $group->map(function ($product) use ($type) {
            $product->pet_type = $type[$product->pet_type] ?? $product->pet_type;
            $product->setHidden(['category', 'created_at', 'updated_at']);
            return $product;
        })->values();

        $data[] = [
            'category_name' => $group->first()->category->title,
            'foods'         => $products,
        ];
    }

    $response = [
        'data' => $data,
        'current_page' => $foods->currentPage(),
        'last_page' => $foods->lastPage(),
        'per_page' => $foods->perPage(),
        'total' => $foods->total(),
        'next_page_url' => $foods->nextPageUrl(),
        'prev_page_url' => $foods->previousPageUrl(),
    ];

    return response()->json([
        'message' => 'Fetched Successfully',
        'status'  => 200,
        'data' => $response,
    ]);
}

    
}
