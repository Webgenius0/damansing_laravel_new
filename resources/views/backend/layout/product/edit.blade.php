@extends('backend.app')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush
@section('title', 'Food Edit')
@section('content')
<div class="app-content content">
    <!-- General setting Form section start -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Food Edit</h3>
            <div>
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary" type="button">
                    <span>Food List</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form class="form" method="POST" action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- This is used to indicate the update method in Laravel -->
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control" value="{{ old('title', $product->title) }}" placeholder="Product Title" name="title" />
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select id="category_id" class="form-control" name="category_id">
                                <option value="" disabled>Select Product Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" id="price" class="form-control" value="{{ old('price', $product->price) }}" placeholder="Product Price" name="price" />
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}" placeholder="Product Stock" name="stock" />
                            @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="net_weight">Net Weight</label>
                            <input type="text" id="net_weight" class="form-control" value="{{ old('net_weight', $product->net_weight) }}" placeholder="Food Net Weight" name="net_weight" />
                            @error('net_weight')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="pet_type">Pet Type</label>
                            <select id="pet_type" class="form-control" name="pet_type">
                                <option value="" disabled>Select Pet Type</option>
                                @foreach(App\Enums\Section::getValues() as $key => $label)
                                    <option value="{{ $key }}" {{ old('pet_type', $product->pet_type) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pet_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="image">Food Image</label>
                            <input class="form-control dropify" accept="image/*" type="file" name="image" data-default-file="{{ asset($product->image) }}">
                            <!-- <small>Current Image: <img src="{{ asset('storage/'.$product->image) }}" width="100" alt="current image"></small> -->
                            @error('image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="food_details">Food Details</label>
                            <textarea type="text" id="food_details" class="form-control" placeholder="Food Details" name="food_details" rows="8">{{ old('food_details', $product->food_details) }}</textarea>
                            @error('food_details')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary mr-1">Submit</button>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-danger">Cancel</a>
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
