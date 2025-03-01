@extends('backend.app')

@section('title', 'Faq page')

@push('style')

<style>
    /* {{-- CKEditor CDN --}} */

    .ck-editor__editable_inline {
        min-height: 300px;
    }
</style>
@endpush

@section('content')
<main class="app-content content">
    <h2 class="section-title">Create FAQ Page</h2>
    <nav aria-label="breadcrumb tm-breadcumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tm-breadcumb-item">
                <a href="{{ route('dynamicPages.index') }}">FAQ Pages</a>
            </li>
            <li class="breadcrumb-item tm-breadcumb-item active" aria-current="page">
                Create
            </li>
        </ol>
    </nav>

    <div class="addbooking-form-area">

        <form action="{{ route('faq.title.update') }}" method="POST" class="tm-form">
            @csrf
            <div class="form-field-wrapper">
                {{-- title input field --}}
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title"
                        class="form-control @error('title') is-invalid @enderror" required
                        placeholder="Enter first name here" value="{{ old('title',$faq->title) }}">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="form-field-wrapper">
                {{-- short_description input field --}}
                <div class="form-group">
                    <label for="description">Short Description:</label>
                    <textarea name="description" class=" form-control @error('description') is-invalid @enderror">{{ old('description',$faq->description) }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="button-group" style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('faq.index') }}" class="btn btn-danger">Cancel</a>
            </div>

        </form>

    </div>




    <div class="addbooking-form-area">

        <form action="{{ route('faq.store') }}" method="POST" class="tm-form">
            @csrf
            <div class="form-field-wrapper">
                {{-- title input field --}}
                <div class="form-group">
                    <label for="title">Question:</label>
                    <input type="text" name="title"
                        class="form-control @error('title') is-invalid @enderror" required
                        placeholder="Enter Question" value="{{ old('title') }}">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="form-field-wrapper">
                {{-- short_description input field --}}
                <div class="form-group">
                    <label for="short_description">Answer:</label>
                    <textarea name="short_description" class="ck-editor form-control @error('short_description') is-invalid @enderror">{{ old('short_description') }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="button-group" style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('faq.index') }}" class="btn btn-danger">Cancel</a>
            </div>

        </form>

    </div>

</main>
@endsection

@push('script')
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<script>
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