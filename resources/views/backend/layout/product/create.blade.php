@extends('backend.app')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush
@section('title', 'Food Create')
@section('content')
<div class="app-content content ">
    <!-- General setting Form section start -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Food Create</h3>
            <div>
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary" type="button">
                    <span>Food List</span>
                </a>
            </div>

        </div>
        <div class="card-body">
            <form class="form" method="POST" action="{{ route('admin.product.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control"
                                value="{{ old('title') }}" placeholder="Product Title" name="title" />
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select id="category_id" class="form-control" name="category_id">
                                <option value="" disabled selected>Select Product Category</option>

                                <!-- Loop through categories and display titles -->
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                            <label for="location">Price</label>
                            <input type="text" id="price" class="form-control"
                                value="{{ old('price') }}" placeholder="Product Price"
                                name="price" />
                            @error('location')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="location">Stock</label>
                            <input type="text" id="stock" class="form-control"
                                value="{{ old('stock') }}" placeholder="Produc Stock"
                                name="stock" />
                            @error('location')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="net_weight">Net Weight</label>
                            <input type="text" id="net_weight" class="form-control"
                                value="{{ old('net_weight') }}" placeholder="Food Net Weight"
                                name="net_weight" />
                            @error('net_weight')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="pet_type">Pet Type</label>
                            <select id="pet_type" class="form-control" name="pet_type">
                                <option value="" disabled selected>Select Pet Type</option>
                                @foreach(App\Enums\Section::getValues() as $key => $label)
                                <option value="{{ $key }}">
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
                            <input class="form-control dropify" accept="image/*" type="file" name="image">
                            @error('image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="food_details">Food Details</label>
                            <textarea type="text" id="food_details" class="form-control"
                                value="{{ old('food_details') }}" placeholder="Food Details"
                                name="food_details" rows="8"></textarea>
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