@extends('layouts.site')
@section('header')
    Shop
@endsection
@section('content')
    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show container">
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
    <!-- Hero Section Begin -->
    @livewire('hero',['thisRoute' => Route::currentRouteName()])
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url('site') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('shop') }}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            {{-- Side search --}}
                            @livewire('side-search')

                            {{-- Latest product --}}
                            @livewire('latest-product')
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    {{-- sale off product --}}
                    @livewire('sale-off-product')
                    {{-- sort bar --}}
                    @livewire('sort-bar', ['products' => $products])
                    {{-- general product --}}
                    @livewire('general-product')
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection
