@extends('layouts.site')
@section('header')
    Search for ...
@endsection

@section('content')
    <!-- Hero Section Begin -->
    @livewire('hero',['thisRoute' => Route::currentRouteName()])
    <!-- Hero Section End -->
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url('site') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Searching with key: {{ $key }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('shop') }}">Home</a>
                            <span>Search</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            {{-- Side search --}}
                            @livewire('side-search')
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    {{-- sort bar --}}
                    @livewire('sort-bar',[
                    'products' => $products,
                    ])
                    {{-- general product --}}
                    @livewire('search-product',[
                    // 'products' => $products,
                    'key' => $key,
                    ])
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
    <!-- Breadcrumb Section End -->
@endsection
