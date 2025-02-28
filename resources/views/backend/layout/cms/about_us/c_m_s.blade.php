@extends('backend.app')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
<style>
    /* {{-- CKEditor CDN --}} */

    .ck-editor__editable_inline {
        min-height: 160px;
    }
</style>
@endpush
@section('title', 'CMS Create')
@section('content')
<div class="app-content content ">
    <!-- General setting Form section start -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cms Create Form</h3>
        
        </div>
        <div class="card-body">
            <form class="form" method="POST" action="{{ route('cms.createOrUpdateForm', ['page' => 'about_us', 'section' => 'c_m_s', 'id' => $cmsData->id ?? null]) }}" enctype="multipart/form-data">
                @csrf

                <div class="row">

                <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="metadata">Metadata</label>
                            <textarea name="metadata" class="ck-editor form-control @error('metadata') is-invalid @enderror">{{ old('metadata', $cmsData->metadata ?? 'no content') }}</textarea>
                            @error('metadata')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <h4>UnMathch Customer Support</h4>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control"
                                value="{{ old('title', $cmsData->title ?? '') }}"
                                placeholder="Home Banner Title" name="title" />
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" id="description" class="form-control"
                                placeholder="Home Banner Description" name="description" rows="4" >{{ old('description', $cmsData->description ?? '') }}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <h4>Join then movement</h4>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="sub_title"> Title</label>
                            <input type="text" id="sub_title" class="form-control"
                                value="{{ old('sub_title', $cmsData->sub_title ?? '') }}"
                                placeholder="Home Banner Title" name="sub_title" />
                            @error('sub_title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="sub_description">Description</label>
                            <textarea type="text" id="sub_description" class="form-control"
                                placeholder="Home Banner Description" name="sub_description" rows="4" >{{ old('sub_description', $cmsData->sub_description ?? '') }}</textarea>
                            @error('sub_description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    


                    <!-- <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="image">Banner Image</label>
                            <input class="form-control dropify" value="{{ old('image', $cmsData->image ?? '') }}" accept="image/*" type="file" name="image" data-default-file="{{ asset($cmsData->image ?? 'No Image') }}">
                            @error('image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> -->

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
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<script>
    $('.dropify').dropify();

    //classic-editor

    ClassicEditor
        .create(document.querySelector('.ck-editor'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                'ImageToolbar', 'ImageUpload', 'MediaEmbed'
            ],
            height: '500px'
        })
        .catch(error => {
            console.error(error);
        });
    $(".single-select").select2({
        theme: "classic"
    });
    $(document).ajaxStart(function() {
        NProgress.start();
    });

    $(document).ajaxComplete(function() {
        NProgress.done();
    });
</script>
@endpush
@endsection