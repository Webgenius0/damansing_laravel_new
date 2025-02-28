@extends('backend.app')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush
@section('title', 'Contact Section')
@section('content')
    <div class="app-content content ">
        <!-- General setting Form section start -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact Us Section</h3>
                <!-- <div>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-primary" type="button">
                        <span>Category List</span>
                    </a>
                </div> -->

            </div>
            <div class="card-body">
                <form class="form" method="POST" action="{{  route('cms.createOrUpdateForm', ['page' => 'homepage','section' => 'home_contact', 'id' => $cmsData->id ?? null ]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control"
                                    value="{{ old('title' , $cmsData->title ?? '') }}" placeholder="Welcome Title" name="title" />
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" id="description" class="form-control"
                                    value="{{ old('description ', $cmsData->description ?? 'no content') }}" placeholder="welcome Description" name="description" rows="8" >{{ old('description', $cmsData->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="image">Welcome Image</label>
                                <input class="form-control dropify" accept="image/*" type="file" name="image" data-default-file="{{ asset($cmsData->image ?? 'No Image') }}">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                            <!-- <a href="{{ route('admin.category.index') }}" class="btn btn-outline-danger">Cancel</a> -->
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
