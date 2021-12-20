<div>
    @if ($viewForm == 'grid')
        <div class="row">
            @if ($products->count() > 0)
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            {{-- <div class="product__item__pic set-bg" data-setbg="{{ url('site') }}/img/product/product-11.jpg"> --}}
                            <div class="product__item__pic set-bg d-flex align-items-center">
                                <a href="{{ route('shop-detail', $product->id) }}"><img
                                        src="{{ url('uploads') }}/{{ $product->poster }}" alt=""
                                        style="width: auto; height: auto"></a>
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    {{-- <li><a href="#" wire:click.prevent="$emit('store',{{ $product->id }},'{{ $product->product->model->name }}
                                {{ $product->product->name }}', {{ $product->product->sale }})"><i
                                        class="fa fa-shopping-cart"></i></a></li> --}}
                                    <li><a href="#"
                                            wire:click.prevent="$emit('store',{{ $product->id }},'{{ $product->product->model->name }} {{ $product->product->name }}','{{ $product->color->name }}',{{ $product->product->sale }})"><i
                                                class="fa fa-shopping-cart"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ route('shop-detail', $product->id) }}" style="
                        overflow: hidden;
                        text-overflow: ellipsis;
                        display: -webkit-box;
                        -webkit-line-clamp: 2;
                                line-clamp: 2; 
                        -webkit-box-orient: vertical;">{{ $product->product->model->name }}
                                        {{ $product->product->name }}</a></h6>
                                @if ($product->product->price > $product->product->sale)
                                    <h6 style="text-decoration: line-through">
                                        {{ number_format($product->product->price) }}
                                        <small class="font-weight-bold">đ</small>
                                    </h6>
                                    <h5>{{ number_format($product->product->sale) }} <small
                                            class="font-weight-bold">đ</small>
                                    </h5>
                                @else
                                    <h5>{{ number_format($product->product->price) }} <small
                                            class="font-weight-bold">đ</small></h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <Div class="container text-center mt-20">
                    <h3>No products found</h3>
                </Div>
            @endif
        </div>
    @elseif ($viewForm == 'list')
        @if ($products->count() > 0)
            @foreach ($products as $product)
                <div class="row product__item">
                    <div class="col-sm-6">
                        <div class="product__item__pic align-items-center">
                            <a class="" style="height: 100%; padding: 0;"
                                href="{{ route('shop-detail', $product->id) }}"><img class="text-center"
                                    src="{{ url('uploads') }}/{{ $product->poster }}" alt="" style=" display: block;
                            margin-left: auto;
                            margin-right: auto;
                            height: 90%"></a>
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="{{ route('shop-detail', $product->id) }}"
                                        wire:click.prevent="$emit('store',{{ $product->id }},'{{ $product->product->model->name }} {{ $product->product->name }}','{{ $product->color->name }}',{{ $product->product->sale }})">
                                        <i class="fa fa-shopping-cart"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="product__item__text">
                            <h6><a href="#">{{ $product->product->model->name }}
                                    {{ $product->product->name }}</a></h6>
                            @if ($product->product->price > $product->product->sale)
                                <h6 style="text-decoration: line-through">
                                    {{ number_format($product->product->price) }}
                                    <small class="font-weight-bold">đ</small>
                                </h6>
                                <h5>{{ number_format($product->product->sale) }} <small
                                        class="font-weight-bold">đ</small>
                                </h5>
                            @else
                                <h5>{{ number_format($product->product->price) }} <small
                                        class="font-weight-bold">đ</small></h5>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <Div class="container text-center mt-20">
                <h3>No products found</h3>
            </Div>
        @endif

    @else
        <div class="text-center">
            Lỗi hiển thị, vui lòng refesh
        </div>
    @endif
    <div>
        {{-- {{ $products->links('livewire.custom-paginate-links') }} --}}
    </div>
</div>
