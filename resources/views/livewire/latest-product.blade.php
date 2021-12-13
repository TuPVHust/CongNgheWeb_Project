<div>
    <div class="sidebar__item">
        <div class="latest-product__text">
            <h4>Latest Products</h4>
            <div class="latest-product__slider owl-carousel">
                <div class="latest-prdouct__slider__item">
                    @foreach ($products as $product)
                    <a href="{{route('shop-detail', $product->id)}}" class="latest-product__item">
                        <div class="latest-product__item__pic d-flex align-items-center"
                            style="width: 100px; height:100px">
                            <img src="{{ url('uploads') }}/{{$product->poster}}" alt=""
                                style="width: 100%; height: auto">
                        </div>
                        <div class="latest-product__item__text ">
                            <h6 style="
                            overflow: hidden;
                            text-overflow: ellipsis;
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                                    line-clamp: 2; 
                            -webkit-box-orient: vertical;">{{$product->product->model->name}}
                                {{$product->product->name}}</h6>
                            {{-- <span>{{ number_format($product->product->sale) }} <small class="bold">đ</small></span>
                            --}}
                            @if ($product->product->price > $product->product->sale )
                            <h6 style="text-decoration: line-through">{{ number_format($product->product->price) }}
                                <small>đ</small></h6>
                            <h5 class="font-weight-bold">{{ number_format($product->product->sale) }} <small
                                    class="font-weight-bold">đ</small></h5>
                            @else
                            <h5 class="font-weight-bold">{{ number_format($product->product->price) }} <small>đ</small>
                            </h5>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
                {{-- <div class="latest-prdouct__slider__item">
                    <a href="#" class="latest-product__item">
                        <div class="latest-product__item__pic">
                            <img src="{{ url('site') }}/img/latest-product/lp-1.jpg" alt="">
                        </div>
                        <div class="latest-product__item__text">
                            <h6>Crab Pool Security</h6>
                            <span>$30.00</span>
                        </div>
                    </a>
                    <a href="#" class="latest-product__item">
                        <div class="latest-product__item__pic">
                            <img src="{{ url('site') }}/img/latest-product/lp-2.jpg" alt="">
                        </div>
                        <div class="latest-product__item__text">
                            <h6>Crab Pool Security</h6>
                            <span>$30.00</span>
                        </div>
                    </a>
                    <a href="#" class="latest-product__item">
                        <div class="latest-product__item__pic">
                            <img src="{{ url('site') }}/img/latest-product/lp-3.jpg" alt="">
                        </div>
                        <div class="latest-product__item__text">
                            <h6>Crab Pool Security</h6>
                            <span>$30.00</span>
                        </div>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
</div>