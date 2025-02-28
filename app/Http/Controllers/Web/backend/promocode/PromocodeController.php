<?php

namespace App\Http\Controllers\Web\backend\promocode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PromocodeRequest;
use App\Models\Category;
use App\Models\PromoCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
class PromocodeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PromoCode::latest();
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
                    //return Helper::tableCheckbox($data->id);
                    static $data=0;
                    $data++;
                    return '<h6>'.$data.'</h6>';
                    
                })
                ->addColumn('action', function ($data) {
                    $viewRoute = route('admin.promocode.edit', ['promocode' => $data->id]);
                    return '<div>
                         <a class="btn btn-sm btn-primary" href="' . $viewRoute . '">
                             <i class="fa-solid fa-pen"></i>
                         </a>
                         <button type="button" onclick="showDeleteAlert(' . $data->id . ')" class="btn btn-sm btn-danger">
                             <i class="fa-regular fa-trash-can"></i>
                         </button>
                     </div>';
                })
                ->rawColumns(['bulk_check', 'image', 'status', 'action'])
                ->make(true);
        }

        return view('backend.layout.promocode.index');
    }

    /**
     * Store a newly created resource in storage.
     * @return View
     */
    public function create()
    {
        return view('backend.layout.promocode.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


   

     public function store(PromocodeRequest $request)
{
    
    try {
        $validatedData = $request->validated();

       
        if (isset($validatedData['expires_at'])) {
            $date = trim($validatedData['expires_at']);

            try {
               
                $validatedData['expires_at'] = $date;
            } catch (\Exception $e) {
               
                flash()->error('Invalid date format for expiration date.');
                return redirect()->back()->withInput();
            }
        }

        $promocode = new Promocode();
        $promocode->fill($validatedData);
        $promocode->save();

        flash()->success('Promocode created successfully');
        return redirect()->route('admin.promocode.index');
    } catch (\Exception $exception) {
        flash()->error($exception->getMessage());
        return redirect()->route('admin.promocode.index');
    }
}
    /**
     * Edit the specified resource in storage.
     * @return View
     */
    public function edit(PromoCode $promocode)
    {
        
        return view('backend.layout.promocode.edit', compact('promocode'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PromocodeRequest $request, Promocode $promocode)
{
    try {
        
        $validatedData = $request->validated();
        
       
        if (isset($validatedData['expires_at'])) {
            $date = trim($validatedData['expires_at']);
            try {
     
                $validatedData['expires_at'] = $date;
            } catch (\Exception $e) {
                flash()->error('Invalid date format for expiration date.');
                return redirect()->back()->withInput();
            }
        }

     
        $promocode->fill($validatedData);

        
        $promocode->save();

        flash()->success('Promocode updated successfully');
        return redirect()->route('admin.promocode.index');
    } catch (\Exception $exception) {
        flash()->error($exception->getMessage());
        return redirect()->route('admin.promocode.index');
    }
}


    /**
     * Delete the specified resource from storage.
     * @param  Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoCode $promocode)
    {
        try {
           
            $promocode->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully',
            ]);
        } catch (\Exception $exception) {
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
            $result = Category::whereIn('id', $request->ids)->get();

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

    //status change
    public function status(int $id): JsonResponse
    {
        $data = Category::findOrFail($id);
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


