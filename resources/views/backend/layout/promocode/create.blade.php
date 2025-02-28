@extends('backend.app')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush
@section('title', 'Promocode Create')
@section('content')
    <div class="app-content content ">
        <!-- General setting Form section start -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Promocode  Create Form</h3>
                <div>
                    <a href="{{ route('admin.promocode.index') }}" class="btn btn-primary" type="button">
                        <span>Promocode List</span>
                    </a>
                </div>

            </div>
            <div class="card-body">
            <form class="form" method="POST" action="{{ route('admin.promocode.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" id="title" class="form-control"
                                value="{{ old('code') }}" placeholder="Code" name="code" />
                            @error('code')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="discount_type">Discount Type</label>
                            <select id="discount_type" class="form-control" name="discount_type">
                                <option value="" disabled selected>Select Discount Type</option>
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed</option>

                            </select>

                            @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="discount_value">Dicount Value</label>
                            <input type="number" id="price" class="form-control"
                                value="{{ old('discount_value') }}" placeholder="Discount Vlue"
                                name="discount_value" />
                            @error('discount_value')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="minimum_order_value">Minimum Order Value</label>
                            <input type="number" id="minimum_order_value" class="form-control"
                                value="{{ old('minimum_order_value') }}" placeholder="Minimum Order Value"
                                name="minimum_order_value" step="1" min="0" />
                            @error('minimum_order_value')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="usage_limit">Usage Value</label>
                            <input type="number" id="usage_limit" class="form-control"
                                value="{{ old('usage_limit') }}" placeholder="Usage Value"
                                name="usage_limit" step="1" min="0" />
                            @error('usage_limit')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="expires_at">Expires Date </label>
                            <input type="date" id="expires_at" class="form-control"
                                value="{{ old('expires_at') }}" placeholder="Expire Date"
                                name="expires_at" />
                            @error('expires_at')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary mr-1">Submit</button>
                        <a href="{{ route('admin.promocode.index') }}" class="btn btn-outline-danger">Cancel</a>
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
            let today=new Date().toISOString().split('T')[0];
            document.getElementById('expires_at').setAttribute('min',today);
        </script>
    @endpush
@endsection
