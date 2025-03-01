<?php

namespace App\Http\Controllers\Web\backend;

use App\Enums\Section;
use Exception;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $image = $data->image;
                    return '<img class="rounded-circle" src="' . asset($image) . '" width="50px" height="50px">';
                })
                ->addColumn('status', function ($data) {
                    $status = $data->status;
                    return '<div class="form-check form-switch mb-2">
                                <input class="form-check-input" onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" ' . ($status == 'active' ? 'checked' : '') . '>
                            </div>';
                })
                ->addColumn('bulk_check', function ($data) {
                    static $data=0;
                    $data++;
                    return '<h6>'.$data.'</h6>';
                })
                ->addColumn('stock', function ($data) {
                    if ($data->stock == 0) {
                        return '<span class="badge badge-danger">Out of Stock</span>';
                    } elseif ($data->stock <= 5) {
                        return '<span class="badge badge-warning">Low Stock</span>';
                    }
                    return $data->stock;
                })
                
                
                ->addColumn('action', function ($data) {
                    $viewRoute = route('admin.product.edit', ['product' => $data->id]);
                    return '<div>
                         <a class="btn btn-sm btn-primary" href="' . $viewRoute . '">
                             <i class="fa-solid fa-pen"></i>
                         </a>
                         <button type="button" onclick="showDeleteAlert(' . $data->id . ')" class="btn btn-sm btn-danger">
                             <i class="fa-regular fa-trash-can"></i>
                         </button>
                     </div>';
                })
                ->rawColumns(['bulk_check', 'image', 'status', 'action', 'stock'])
                ->make(true);
        }
        return view('backend.layout.product.index');
    }

    /**
     * Store a newly created resource in storage.
     * @return View
     */

    public function create()
    {
        $categories = Category::all();
        return view('backend.layout.product.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        $product = new Product();
        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->slug = Str::slug($request->title);
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->net_weight = $request->net_weight;
        $product->pet_type = $request->pet_type;
        $product->food_details = $request->food_details;
        $product->status = 'active';     
        if ($request->hasFile('image')) {
            $url = Helper::fileUpload($request->file('image'), 'food', $request->title . "-" . time());
            $product->image = $url;
        }
        DB::commit();
        try {
            $product->save();
            flash()->success('Product created successfully');
            return redirect()->route('admin.product.index');
        } catch (Exception $e) {
            flash()->error($e->getMessage());
            DB::rollBack();
            return redirect()->route('admin.product.index');
        }
    }

    /**
     * Edit the specified resource in storage.
     * @return View
     */

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('backend.layout.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function update(ProductRequest $request, Product $product)
    {
        DB::beginTransaction();
        try {
            // Update the product attributes
            $product->title = $request->validated('title');
            $product->slug = Str::slug($request->validated('title'));
            $product->price = $request->validated('price');
            $product->stock = $request->validated('stock');
            $product->net_weight = $request->validated('net_weight');
            $product->pet_type = $request->validated('pet_type');
            $product->food_details = $request->validated('food_details');
            if ($request->hasFile('image')) {
                if ($product->image && file_exists(public_path($product->image))) {
                    File::delete(public_path($product->image));
                }
                $url = Helper::fileUpload($request->file('image'), 'food', $request->validated('title') . "-" . time());
                $product->image = $url;
            }
            $product->save();
            DB::commit();
            flash()->success('Product updated successfully');
            return redirect()->route('admin.product.index');
        } catch (Exception $e) {
            DB::rollBack();
            flash()->error('Failed to update product: ' . $e->getMessage());
            return redirect()->route('admin.product.index');
        }
    }


    /**
     * Delete the specified resource from storage.
     * @param  Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            if ($product->image) {
                File::delete(public_path($product->image));
            }
            DB::commit();
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully',
            ]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }




    /**
     * multiple user destroy resource
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function bulkDelete(Request $request)
    {
        if ($request->ajax()) {
            $result = Product::whereIn('id', $request->ids)->get();

            if ($result) {
                foreach ($result as $value) {
                    if (!empty($value->image)) {
                        if (File::exists(public_path($value->image))) {
                            File::delete(public_path($value->image));
                        }
                    }
                }
                Category::destroy($request->ids);
                return response()->json([
                    'success' => true,
                    'message' => 'Categories deleted successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Categories not found',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }


    public function status(int $id): JsonResponse
    {
        $data = Product::findOrFail($id);
        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data' => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data' => $data,
            ]);
        }
    }
}

