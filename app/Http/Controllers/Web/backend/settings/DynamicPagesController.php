<?php

namespace App\Http\Controllers\Web\backend\settings;

use App\Models\DynamicPage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class DynamicPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = DynamicPage::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('page_content', function ($data) {
                    // Strip HTML tags and truncate the content
                    $content = strip_tags($data->page_content);
                    return $content;
                })
                ->addColumn('status', function ($data) {
                    $status = '<div class="form-check form-switch">';
                    $status .= '<input onclick="changeStatus(event,' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem;"' . $data->id . '" name="status"';
                    if ($data->status == "active") {
                        $status .= ' checked';
                    }
                    $status .= '>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="action-wrapper">
                                <button class="action-btn edit-btn" title="Edit" type="button" onclick="window.location.href=\'' . route('dynamicPages.edit', $data->id) . '\'">
                                     <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="action-btn delete-btn" type="button" onclick="deleteRecord(event,' . $data->id . ')">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>';
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.layout.setting.dynamic_page.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('backend.layout.setting.dynamic_page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([

            'page_title' => 'required|max:255|string',
            'page_content' => 'required',

        ]);

        $page = new DynamicPage();
        $page->page_title = $request->page_title;
        $page->page_content = $request->page_content;
        $page->page_slug = Str::slug($request->page_title);
        $page->status = 'active';
        $page->save();

        flash()->success('page created successfully');
        return redirect()->route('dynamicPages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data = DynamicPage::findOrFail($id);
        return view('backend.layout.setting.dynamic_page.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([

            'page_title' => 'required|max:255|string',
            'page_content' => 'required',

        ]);

        $page = DynamicPage::findOrFail($id);
        $page->page_title = $request->page_title;
        $page->page_content = $request->page_content;
        $page->page_slug = Str::slug($request->page_title);
        $page->status = 'active';
        $page->save();

        flash()->success('page updated successfully');
        return redirect()->route('dynamicPages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $page = DynamicPage::findOrFail($id);
            $page->delete();
            flash()->success('page deleted successfully');
            return response()->json([

                'success' => true,
                "message" => "Page deleted successfully."

            ]);
        } catch (\Exception $e) {
            return response()->json([

                'error' => true,
                "message" => "Failed to delete page."

            ]);
        }
    }

    public function changeStatus($id)
    {

        $page = DynamicPage::find($id);

        if (empty($page)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }

        if ($page->status == "active") {
            $page->status = "inactive";
        } else {
            $page->status = "active";
        }
        $page->save();
        return response()->json([
            'success' => true,
            'message' => 'Item status changed successfully.'
        ]);
    }
}
