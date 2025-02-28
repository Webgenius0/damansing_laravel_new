@extends('backend.app')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush
@section('title', 'Pets Health')
@section('content')
    <div class="app-content content ">
        <!-- General setting Form section start -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pets Healths</h3>
                <!-- <div>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-primary" type="button">
                        <span>Category List</span>
                    </a>
                </div> -->

            </div>
            <div class="card-body">
                <form class="form" method="POST" action="{{  route('cms.createOrUpdateForm', ['section' => 'home_pets_helth', 'page' => 'homepage' , 'id' => $cmsData->id ?? null]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control"
                                    value="{{ old('title', $cmsData->title ?? '') }}" placeholder="Home Banner Title" name="title" />
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="btn_text">Button Name</label>
                                <input type="text" id="btn_text" class="form-control"
                                    value="{{ old('btn_name', $cmsData->btn_text ?? '') }}" placeholder="Butto Name" name="btn_text" />
                                @error('btn_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="btn_url">Button Url</label>
                                <input type="text" id="btn_url" class="form-control"
                                    value="{{ old('btn_url', $cmsData->btn_url ?? '') }}" placeholder="Buttone Url" name="btn_url" />
                                @error('btn_url')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" id="description" class="form-control"
                                    value="{{ old('description', $cmsData->description ?? '') }}" placeholder="Home Banner Description" name="description" rows="8" >{{ old('description', $cmsData->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="image">Pets Helth Image</label>
                                <input class="form-control dropify" accept="image/*" type="file" name="image" data-default-file="{{ asset($cmsData->image ?? 'No Image') }}">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                            <a href="{{ route('admin.category.index') }}" class="btn btn-outline-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

        <script>
            $('.dropify').dropify();
        </script>
    @endpush
@endsection


<!-- for information -->
<!-- 
public function createOrUpdateForm($section, $page)
{
    // Convert the section string to the Section enum (Optional: if you're using the Section enum)
    $sectionEnum = Section::from($section);

    // Try to find an existing CMS page based on section and page
    $cmsPage = Cms::where('section', $sectionEnum->value)
                  ->where('page', $page)
                  ->first();

    // Dynamically determine the Blade view based on section and page
    $viewName = "backend.layout.cms.$section.$page"; // Example: cms.home_banner.home_page

    // Set the title dynamically based on the section and page
    $pageTitle = $this->getPageTitle($section, $page);

    // If the view doesn't exist, fall back to a default view
    if (!view()->exists($viewName)) {
        $viewName = 'cms.default'; // Fallback view if the specific view doesn't exist
    }

    // Pass data to the Blade view (either for editing an existing page or creating a new one)
    return view($viewName, compact('cmsPage', 'pageTitle'));
}

// Method to dynamically set the page title
private function getPageTitle($section, $page)
{
    if ($section == 'home_banner' && $page == 'homepage') {
        return 'Home Banner Create';
    }

    if ($section == 'home_welcome' && $page == 'homepage') {
        return 'Welcome Section Create';
    }

    return ucfirst(str_replace('_', ' ', $section)) . ' ' . ucfirst(str_replace('_', ' ', $page)); // Default fallback
} -->
