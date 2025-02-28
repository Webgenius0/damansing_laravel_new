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
@section('title', 'Recipes and Nutrition List')
@section('content')
    <div class="app-content content ">
        <!-- General setting Form section start -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recipes and Nutrition List</h3>
                <div>
                    <a href="{{ route('cms.get', ['section' => 'perfect_nutration_index', 'page' => 'recipesAndNutrationList']) }}" class="btn btn-primary" type="button">
                        <span>Card List</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="{{ route('cms.createOrUpdateForm', ['page' => 'recipesAndNutration', 'section' => 'uniquesection', 'id' => $cmsData->id ?? null]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $cmsData->id ?? '' }}">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" value="{{ old('title', $cmsData->title ?? 'N/A') }}" placeholder="Welcome Title" name="title" />
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="btn_text">Button Name</label>
                            <input type="text" id="btn_text" class="form-control"
                                value="{{ old('btn_text', $cmsData->btn_text ?? '') }}"
                                placeholder="Button Name" name="btn_text" />
                            @error('btn_text')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="btn_url">Button Url</label>
                            <input type="text" id="btn_url" class="form-control"
                                value="{{ old('btn_url', $cmsData->btn_url ?? '') }}"
                                placeholder="Button Url" name="btn_url" />
                            @error('btn_url')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="ck-editor form-control @error('description') is-invalid @enderror">{{ old('description', $cmsData->description ?? 'no content') }}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="image">Welcome Image</label>
                                <input class="form-control dropify" accept="image/*" type="file" name="image" data-default-file="{{ isset($cmsData->image) ? asset($cmsData->image) : '' }}" />
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
        <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
        <script>
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happened.'
                }
            });

            //ck-editor
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