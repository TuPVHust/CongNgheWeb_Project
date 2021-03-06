<div>
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item d-flex align-items-center"
                            style="max-width: 540px; height: 560px">
                            <img class="product__details__pic__item--large"
                                src="{{ url('uploads') }}/{{ $product->poster }}" alt=""
                                style="width: 100%; height: auto">
                        </div>
                        <div class="product__details__pic__slider owl-carousel shadow-sm p-3 mb-5 bg-white rounded"
                            id="productImages">
                            <img data-imgbigurl="{{ url('uploads') }}/{{ $product->poster }}"
                                src="{{ url('uploads') }}/{{ $product->poster }}" alt="">
                            @foreach ($images as $image)
                                <img data-imgbigurl="{{ url('uploads') }}/{{ $image }}"
                                    src="{{ url('uploads') }}/{{ $image }}" alt="">
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->product->model->name }} {{ $product->product->name }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">{{ number_format($product->product->sale) }}<small
                                class="font-weight-bold">??</small></div>
                        <p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam
                            vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Vestibulum ac diam sit amet
                            quam vehicula elementum sed sit amet dui. Proin eget tortor risus.</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty" id="pro-qtyId">
                                    <input type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="d-inline" id="div-primary-btn"><a href="javascript:void(0)"
                                class="primary-btn">ADD
                                TO CARD</a></div>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul class="product__figure__color">
                            @if ($product->product->name)
                                @php
                                    // $matchProducts = $products->join('products', 'cert_products.product_id',
                                    // '=','products.id')->where('products.model_id',
                                    // $modelId)->select('cert_products.*')->paginate(100);
                                @endphp
                                <div class="row mb-3">
                                    @foreach ($products as $_product)
                                        @if ($_product->name && $_product->productDetails->first())
                                            @php
                                                $next = $_product->productDetails->first();
                                            @endphp
                                            <div class="col-lg-3 product__figure__color__buttom">
                                                <a @class([
                                                    'btn overflow-hidden w-100',
                                                    'activated' => $product->product->id == $_product->id,
                                                ])
                                                    href="{{ route('shop-detail', $next->id) }}" role="button" style="text-overflow: ellipsis;
                                                        display: -webkit-box;
                                                        -webkit-line-clamp: 2;
                                                        line-clamp: 2; 
                                                        -webkit-box-orient: vertical;">{{ $_product->name }}</a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="row">
                                    @foreach ($colors as $color)
                                        @if ($color->name != 'none')
                                            @php
                                                $next = $productDetails
                                                    ->where('product_id', $productId)
                                                    ->where('color_id', $color->id)
                                                    ->first();
                                            @endphp
                                            <div class="col-lg-3 product__figure__color__buttom">
                                                <a @class([
                                                    'btn btn-outline-primary w-100',
                                                    'activated' => $product->color->id == $color->id,
                                                ])
                                                    href="{{ route('shop-detail', $next->id) }}"
                                                    role="button">{{ $color->name }}</a>
                                            </div>
                                        @else
                                            <div class="col-lg-3 mt-3">
                                                <p>No color found</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="col-lg-3 mt-3">
                                    <p class="ml-10">No model found</p>
                                </div>
                                @if ($product->color->name != 'none')
                                    <div class="row">
                                        @foreach ($colors as $color)
                                            @php
                                                $next = $productDetails
                                                    ->where('product_id', $productId)
                                                    ->where('color_id', $color->id)
                                                    ->first();
                                            @endphp
                                            <div class="col-lg-3 product__figure__color__buttom">
                                                <a @class([
                                                    'btn btn-outline-primary w-100',
                                                    'activated' => $product->color->id == $color->id,
                                                ])
                                                    href="{{ route('shop-detail', $next->id) }}"
                                                    role="button">{{ $color->name }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="col-lg-3 mt-3">
                                        <p>No color found</p>
                                    </div>
                                @endif
                            @endif

                        </ul>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active overflow-hidden " id="tabs-1" role="tabpanel"
                                style="max-height: 500px;">
                                <div class="product__details__tab__desc " onclick='toggle()'>
                                    <h6>Products Infomation</h6>
                                    <p class="cursor-pointer" style="width: 100%">{!! $product->product->description !!}
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $hasProducts = false;
                @endphp
                @foreach ($relatedProducts as $relatedProduct)
                    @if ($relatedProduct->productDetails->first() && $relatedProduct->id != $productId)
                        @php
                            $hasProducts = true;
                            $next = $relatedProduct->productDetails->first();
                        @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg d-flex align-items-center">
                                    <a href="{{ route('shop-detail', $next->id) }}"><img
                                            src="{{ url('uploads') }}/{{ $next->poster }}" alt=""
                                            style="width: auto; height: auto"></a>
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"
                                                wire:click.prevent="$emit('store',{{ $next->id }},'{{ $next->product->model->name }} {{ $next->product->name }}','{{ $next->color->name }}',{{ $next->product->sale }},1)"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('shop-detail', $next->id) }}" style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                            line-clamp: 2; 
                                    -webkit-box-orient: vertical;">{{ $next->product->model->name }}
                                            {{ $next->product->name }}</a></h6>
                                    @if ($next->product->price > $next->product->sale)
                                        <h6 style="text-decoration: line-through">
                                            {{ number_format($next->product->price) }} <small
                                                class="font-weight-bold">??</small></h6>
                                        <h5>{{ number_format($next->product->sale) }} <small
                                                class="font-weight-bold">??</small></h5>
                                    @else
                                        <h5>{{ number_format($next->product->price) }} <small
                                                class="font-weight-bold">??</small></h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @if (!$hasProducts)
                <h4 class="text-center">No product found</h4>
            @endif
        </div>
    </section>
    <!-- Related Product Section End -->
</div>
<script>
    function add() {
        alert('clcik');
    }
</script>
@section('js')
    <script>
        function toggle() {
            let desContainer = document.getElementById('tabs-1');
            if (desContainer.classList.contains('overflow-hidden') && desContainer.style.maxHeight != '') {
                desContainer.classList.remove('overflow-hidden')
                desContainer.style.maxHeight = ''
            } else {
                desContainer.classList.add('overflow-hidden')
                desContainer.style.maxHeight = '500px'
            }
        }
        $("#div-primary-btn").click(function() {
            var $button = document.getElementById('pro-qtyId');
            Livewire.emit('store', "{{ $product->id }}", "{{ $product->product->model->name }}" +
                "{{ $product->product->name }}", "{{ $product->color->name }}",
                "{{ $product->product->sale }}",
                $button.firstElementChild.nextElementSibling.value);
        });
    </script>
@endsection
