@extends('layouts.site')

@section('header')
    Shopping Cart
@endsection
@section('content')

    <!-- Hero Section Begin -->
    @livewire('hero',['thisRoute' => Route::currentRouteName()])
    <!-- Hero Section End -->
    {{-- <div>{{$product_detail}}</div> --}}
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url('site') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('shop') }}">Home </a>
                            <span href="{{ route('cart') }}">Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    {{-- Shopping cart section begins --}}
    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show ">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('danger') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    @livewire('shopping-cart-section')
@endsection
