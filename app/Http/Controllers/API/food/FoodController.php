<?php

namespace App\Http\Controllers\API\food;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\apiresponse;
use App\Models\Category;

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


    // show Vegetarian Foods
    public function showVegetarianFoods(Request $request)
    {
        // Define the pet types
        $type = [
            '0' => 'puppy',
            '1' => 'adult',
            '2' => 'large',
        ];
      
        $vegetarianCategoryId = Category::where('title', 'Vegetarian')->pluck('id')->first();

        $foods = Product::where('category_id', $vegetarianCategoryId)
                        ->whereNotNull('category_id') 
                        ->with('category') 
                        ->paginate(4);
        $data = [];
        foreach ($foods as $food) {
            
            $food->pet_type = $type[$food->pet_type] ?? $food->pet_type;
 
            $food->category_name = $food->category ? $food->category->title : null;
            $food->setHidden(['category', 'category_id','created_at', 'updated_at']);

            $data[] = $food;
        }
 
        return response()->json([
            'message' => 'Fetched Successfully',
            'status'  => 200,
            'data'    => $data,
            'pagination' => [
                'current_page' => $foods->currentPage(),
                'per_page' => $foods->perPage(),
                'total_food' => $foods->total(),
                'last_page' => $foods->lastPage(),
            ],
        ]);
    }

    //show non vegetarian foods
    public function showNonVegetarianFoods(Request $request)
    {
        // Define the pet types
        $type = [
            '0' => 'puppy',
            '1' => 'adult',
            '2' => 'large',
        ];
      
        $nonVegetarianCategoryId = Category::where('title', 'non-vegetarian')->pluck('id')->first();

        $foods = Product::where('category_id', $nonVegetarianCategoryId)
                        ->whereNotNull('category_id') 
                        ->with('category') 
                        ->paginate(4);
        $data = [];
        foreach ($foods as $food) {
            
            $food->pet_type = $type[$food->pet_type] ?? $food->pet_type;
 
            $food->category_name = $food->category ? $food->category->title : null;
            $food->setHidden(['category', 'category_id','created_at', 'updated_at']);

            $data[] = $food;
        }
 
        return response()->json([
            'message' => 'Fetched Successfully',
            'status'  => 200,
            'data'    => $data,
            'pagination' => [
                'current_page' => $foods->currentPage(),
                'per_page' => $foods->perPage(),
                'total_food' => $foods->total(),
                'last_page' => $foods->lastPage(),
            ],
        ]);
    }
    

}
