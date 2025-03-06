<?php

namespace App\Http\Controllers\Web\backend\Frontend;
use Illuminate\Support\Facades\Log;
use App\Enums\Section;
use App\Enums\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CmsRequest;
use App\Models\Cms;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Helper\Helper;
use Illuminate\Support\Arr;
use Illuminate\Http\JsonResponse;


use Yajra\DataTables\Facades\DataTables;

use function Laravel\Prompts\alert;

class CmsController extends Controller
{

   // Method to create or update the CMS page (POST request)
//    public function getCmsForm($page, $section)
//    {
//        $cmsData = Cms::where('page', $page)->where('section', $section)->first();
   
//        // Check if the view exists
//        $viewName = "backend.layout.cms.$page.$section";
       
//        if (!view()->exists($viewName)) {
//            $viewName = 'cms.default';
//        }
       
//        // Pass the cmsData to the view if available, otherwise pass an empty array
//        return view($viewName, compact('cmsData'));
//    }
   

public function getCmsForm($page, $section, Request $request, $id = null)
{
    if ($request->ajax()) {
        $data = Cms::where('page', $page)->where('section', $section)->get(); 
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function ($data) {
                return '<img class="rounded-circle" src="' . asset($data->image) . '" width="50px" height="50px">';
            })
            ->addColumn('status', function ($data) {
                return '<div class="form-check form-switch mb-2">
                            <input class="form-check-input" onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" ' . ($data->status == 'active' ? 'checked' : '') . '>
                        </div>';
            })
            ->addColumn('descripton', function ($data) {
                return strip_tags($data->description);
            })
            ->addColumn('bulk_check', function ($data) {
                return Helper::tableCheckbox($data->id);
            })
            ->addColumn('action', function ($data) {
                $viewRoute = route('cms.get', ['page' => $data->page, 'section' => $data->section, 'id' => $data->id]);
                return '<div>
                         <a class="btn btn-sm btn-primary" href="' . $viewRoute . '">
                             <i class="fa-solid fa-pen"></i>
                         </a>
                         <button type="button" onclick="deleteRecord(event, ' . $data->id . ')" class="btn btn-sm btn-danger">
                             <i class="fa-regular fa-trash-can"></i>
                         </button>
                     </div>';
            })
            ->rawColumns(['bulk_check', 'image','description', 'status', 'action'])
            ->make(true);
    }

    // Fetch the specific CMS record if ID is provided
    if ($id) {
        $cmsData = Cms::find($id);
        if (!$cmsData) {
            Log::error('CMS page not found for ID:', ['id' => $id]);
            flash()->error("CMS page not found");
            return redirect()->back();
        }
    }
     else {
        // Fetch the first record if no ID is provided
        $cmsData = Cms::where('page', $page)->where('section', $section)->first();
    }

    $viewName = "backend.layout.cms.$page.$section";
    
    if (!view()->exists($viewName)) {
        $viewName =  abort(404);
    }
    
    return view($viewName, compact('cmsData'));
}

   
   // updateOrCreate

//    public function createOrUpdateForm(CmsRequest $request, $page, $section, $id = null)
//    {
//        Log::info('Creating or updating CMS page', ['section' => $section, 'page' => $page]);
   
//        $cmsData = null;
   
//        if ($id) {
//            $cmsData = Cms::find($id);
//            Log::info('Editing existing CMS page:', ['cmsData' => $cmsData]);
//        }
   
//        if ($section == 'uniquesection') {
//            $isUniqueSection = true;
//            \Log::info('Skipping enum handling for unique section');
//        } else {
//            $isUniqueSection = false;
//            $sectionEnum = Section::from($section); // This converts string to Section enum value
//        }
   
//        $cmsPage = Cms::where('section', $sectionEnum->value ?? '')->where('page', $page)->first();
   
//        Log::info('Existing CMS page:', ['cmsPage' => $cmsPage]);
   
//        if ($request->isMethod('post')) {
//            $validated = $request->validated();
//            Log::info('Form validated:', ['validated_data' => $validated]);
   
//            $imagePath = $this->handleImageUpload($request, $cmsPage);
//            Log::info('Image uploaded', ['image_path' => $imagePath]);
   
//            if ($isUniqueSection) {
//                Cms::create([
//                    'section' => 'create_home_blocks', 
//                    'page' => $page,
//                    'title' => $validated['title'],
//                    'description' => $validated['description'],
//                    'btn_text' => Arr::get($validated, 'btn_text'),
//                    'btn_url' => Arr::get($validated, 'btn_url'),
//                    'slug' => Str::slug($validated['title']),
//                    'image' => $imagePath,
//                ]);
   
//                Log::info('New CMS page created successfully for unique section', ['section' => $section]);
//                flash()->success("Page created successfully");
//                return redirect()->back();
//            } elseif ($isUniqueSection && $id) {
//                if ($cmsPage) {
//                    $cmsPage->update([
//                        'title' => $validated['title'],
//                        'description' => $validated['description'],
//                        'btn_text' => Arr::get($validated, 'btn_text'),
//                        'btn_url' => Arr::get($validated, 'btn_url'),
//                        'slug' => Str::slug($validated['title']),
//                        'image' => $imagePath,
//                    ]);
   
//                    Log::info('CMS page updated successfully for unique section', ['cmsPage' => $cmsPage]);
//                    flash()->success("Page updated successfully");
//                    return redirect()->back();
//                } else {
//                    flash()->error("Page not found");
//                    return redirect()->back();
//                }
//            }
           
//            else {
//                if ($cmsPage) {
//                    $cmsPage->update([
//                        'title' => $validated['title'],
//                        'description' => $validated['description'],
//                        'btn_text' => Arr::get($validated, 'btn_text'),
//                        'btn_url' => Arr::get($validated, 'btn_url'),
//                        'slug' => Str::slug($validated['title']),
//                        'image' => $imagePath, 
//                    ]);
   
//                    Log::info('CMS page updated successfully', ['cmsPage' => $cmsPage]);
//                } else {
//                    $newCmsPage = Cms::create([
//                        'section' => $sectionEnum->value,
//                        'page' => $page,
//                        'title' => $validated['title'],
//                        'description' => $validated['description'],
//                        'btn_text' => Arr::get($validated, 'btn_text'),
//                        'btn_url' => Arr::get($validated, 'btn_url'),
//                        'slug' => Str::slug($validated['title']),
//                        'image' => $imagePath,
//                    ]);
   
//                    Log::info('New CMS page created successfully', ['newCmsPage' => $newCmsPage]);
//                }
   
//                flash()->success("$page $section submitted successfully");
//                return redirect()->back();
//            }
//        }
   
//        $viewName = "backend.layout.cms.$page.$section";
       
//        if (!view()->exists($viewName)) {
//            $viewName = 'cms.default';
//        }
   
//        return view($viewName, compact('cmsData', 'page', 'section'));
//    }
   

public function createOrUpdateForm(CmsRequest $request, $page, $section, $id=null)
{
    Log::info('Creating or updating CMS page', ['section' => $section, 'page' => $page]);

    // Fetch existing data if ID is provided
    $cmsData = null;
    if ($id) {
        $cmsData = Cms::find($id);
        if (!$cmsData) {
            Log::error('CMS page not found for ID:', ['id' => $id]);
            flash()->error("CMS page not found");
            return redirect()->back();
        }
        Log::info('Editing existing CMS page:', ['cmsData' => $cmsData]);
    }

    // Check if the section is unique
    $isUniqueSection = ($section == 'uniquesection');
    if ($isUniqueSection) {
        Log::info('Skipping enum handling for unique section');
    } else {
        $sectionEnum = Section::from($section); // Convert string to Section enum value
    }

    // Handle form submission
    if ($request->isMethod('post')) {
        $validated = $request->validated();
        Log::info('Form validated:', ['validated_data' => $validated]);

        // Handle image upload
        $imagePath = $this->handleImageUpload($request, $cmsData);
        Log::info('Image uploaded', ['image_path' => $imagePath]);

        if ($isUniqueSection) {
            if ($id && $cmsData) {
                // alert($id);
                // Update existing record for unique section
                $cmsData->update([
                    'title' => $validated['title'],
                    'sub_title' => Arr::get($validated, 'sub_title'),
                    'description' =>  $validated['description'],
                    'btn_text' => Arr::get($validated, 'btn_text'),
                    'btn_url' => Arr::get($validated, 'btn_url'),
                    'slug' => Str::slug($validated['title']),
                    'image' => $imagePath ?? $cmsData->image, // Retain existing image if no new image is provided
                ]);
                Log::info('CMS page updated successfully for unique section', ['cmsData' => $cmsData]);
                flash()->success("Page updated successfully");
            } else {
                // Create new record for unique section
                Cms::create([
                    'section' => 'create_home_blocks',
                    'page' => $page,
                    'title' => $validated['title'],
                    'sub_title' => Arr::get($validated, 'sub_title'),
                    'description' => $validated['description'],
                    'btn_text' => Arr::get($validated, 'btn_text'),
                    'btn_url' => Arr::get($validated, 'btn_url'),
                    'slug' => Str::slug($validated['title']),
                    'image' => $imagePath, // Use the new image or null if no image is provided
                ]);
                Log::info('New CMS page created successfully for unique section', ['section' => $section]);
                flash()->success("Page created successfully");
                return redirect()->back();
            }
        } else {
            // Handle non-unique section logic
            $cmsPage = Cms::where('section', $sectionEnum->value ?? '')->where('page', $page)->first();
            if ($cmsPage) {
                // Update existing record for non-unique section
                $cmsPage->update([
                    'title' => $validated['title'],
                    'sub_title' => Arr::get($validated, 'sub_title'),
                    'description' =>Arr::get($validated, 'description'),
                    'sub_description' => Arr::get($validated, 'sub_description'),
                    'metadata' => Arr::get($validated, 'metadata'),
                    'btn_text' => Arr::get($validated, 'btn_text'),
                    'btn_url' => Arr::get($validated, 'btn_url'),
                    'slug' => Str::slug($validated['title']),
                    'image' => $imagePath ?? $cmsPage->image, // Retain existing image if no new image is provided
                ]);
                Log::info('CMS page updated successfully', ['cmsPage' => $cmsPage]);
            } else {
                // Create new record for non-unique section
                $newCmsPage = Cms::create([
                    'section' => $sectionEnum->value,
                    'page' => $page,
                    'title' => $validated['title'],
                    'sub_title' => Arr::get($validated, 'sub_title'),
                    'description' => Arr::get($validated, 'description'),
                    'sub_description' => Arr::get($validated, 'sub_description'),
                    'metadata' => Arr::get($validated, 'metadata'),
                    'btn_text' => Arr::get($validated, 'btn_text'),
                    'btn_url' => Arr::get($validated, 'btn_url'),
                    'slug' => Str::slug($validated['title']),
                    'image' => $imagePath, // Use the new image or null if no image is provided
                ]);
                Log::info('New CMS page created successfully', ['newCmsPage' => $newCmsPage]);
            }
            flash()->success("$page $section submitted successfully");
           return redirect()->back();
        }

        return redirect()->back();
    }

    // Render the view
    $viewName = "backend.layout.cms.$page.$section";
    if (!view()->exists($viewName)) {
        $viewName = 'cms.default';
    }

    return view($viewName, compact('cmsData', 'page', 'section'));
}

private function handleImageUpload(Request $request, Cms $cmsPage = null)
{
    if ($request->hasFile('image')) {
        if ($cmsPage && $cmsPage->image && file_exists(public_path($cmsPage->image))) {
            File::delete(public_path($cmsPage->image));
        }
        $url = Helper::fileUpload($request->file('image'), 'cms', $request->validated('title') . "-" . time());
        return $url;
    }
    return $cmsPage->image ?? null;
}
//homeBlock Edit form

// public function edit($id)
// {
//     $homeBlocks = Cms::find($id);
//     \Log::info('Editing CMS page:', ['cmsPage' => $homeBlocks]);
//     return view('backend.layout.cms.homepage.home_blocks_edit', compact('homeBlocks'));
// }


//delete
public function destroy($id)
{
    Log::info('Deleting CMS page with ID:', ['id' => $id]);

    // Find the CMS record
    $cmsData = Cms::find($id);

    if (!$cmsData) {
        Log::error('CMS page not found for ID:', ['id' => $id]);
        return response()->json([
            'success' => false,
            'message' => 'CMS page not found.',
        ], 404);
    }

    // Delete the record
    $cmsData->delete();

    Log::info('CMS page deleted successfully:', ['id' => $id]);
    return response()->json([
        'success' => true,
        'message' => 'CMS page deleted successfully.',
    ]);
}  

public function status(int $id): JsonResponse
    {
        $data = Cms::findOrFail($id);
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