@php
$user=App\Models\User::where('role','user')->count();
$food=App\Models\Product::count();
@endphp

@extends('backend.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce">
                <div class="row match-height">
                    <!-- Medal Card -->
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="card card-congratulation-medal">
                            <div class="card-body">

                                <h2 style="text-align: center;">Total User</h2>
                                <h3 class="mb-75 mt-2 pt-50" style="text-align: center;">
                                    <a href="javascript:void(0);" class="align-items-center">{{$user}}</a>
                                </h3>

                                <!-- <button type="button" class="btn btn-primary"><a href="{{ route('user.list') }}">View User List</a></button> -->
                                <div style="text-align: right;">
                                    <a href="{{ route('user.list') }}" type="button" class="btn btn-primary align-item-last">User List</a>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!--/ Medal Card -->

                    <!-- Statistics Card -->
                    <!-- Medal Card -->
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="card card-congratulation-medal">
                            <div class="card-body">

                                <h2 style="text-align: center;">Total Food</h2>
                                <h3 class="mb-75 mt-2 pt-50" style="text-align: center;">
                                    <a href="javascript:void(0);">{{$food}}</a>
                                </h3>
                                <div style="text-align: right;">
                                <a href="{{route('admin.product.index')}}" type="button" class="btn btn-primary">Food List</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Medal Card -->
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="card card-congratulation-medal">
                            <div class="card-body">

                                <h2>Active Promocode</h2>
                                <h3 class="mb-75 mt-2 pt-50">
                                    <a href="javascript:void(0);">48.9k</a>
                                </h3>
                                <div style="text-align: right;">
                                <a href="{{route('admin.promocode.index')}}" type="button" class="btn btn-primary">Promocode List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Statistics Card -->
                </div>



            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>
@endsection