@extends('layouts.site')

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
                    <h2>{{$product->product->model->name}} {{$product->product->name}}</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('shop')}}">Home </a>
                        <a href="#">{{$product->product->model->category->name}}</a>
                        <span>{{$product->product->model->name}} {{$product->product->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
{{-- Content --}}
@livewire('product-detail-section',[
'product' => $product,
'images' => $images,
'products' => $products,
])

@endsection