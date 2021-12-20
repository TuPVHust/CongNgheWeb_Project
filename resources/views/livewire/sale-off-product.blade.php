<div>
    <div class="product__discount">
        <div class="section-title product__discount__title">
            <h2>Sale Off</h2>
        </div>
        <div class="row">
            <div class="product__discount__slider owl-carousel">
                @foreach ($products as $product)
                    @php
                        $exampleProduct = $product->productDetails->sortBy('created_at')->last();
                    @endphp
                    <div class="col-lg-4">
                        <div class="product__discount__item ">
                            <div class="product__discount__item__pic set-bg d-flex align-items-center">
                                <a href="{{ route('shop-detail', $exampleProduct->id) }}"><img
                                        src="{{ url('uploads') }}/{{ $exampleProduct->poster }}" alt=""
                                        style="width: 100%; height: auto"></a>
                                <div class="product__discount__percent">
                                    -{{ number_format((($product->price - $product->sale) * 100) / $product->price) }}%
                                </div>
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"
                                            wire:click.prevent="$emit('store',{{ $exampleProduct->id }},'{{ $exampleProduct->product->model->name }} {{ $exampleProduct->product->name }}','{{ $exampleProduct->color->name }}',{{ $exampleProduct->product->sale }})"><i
                                                class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__discount__item__text">
                                <span>{{ $exampleProduct->product->model->category->name }}</span>
                                <h6><a href="{{ route('shop-detail', $exampleProduct->id) }}" style="
                                overflow: hidden;
                                text-overflow: ellipsis;
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                        line-clamp: 2; 
                                -webkit-box-orient: vertical;">{{ $exampleProduct->product->model->name }}
                                        {{ $exampleProduct->product->name }}</a></h6>
                                <div class="product__item__price">{{ number_format($exampleProduct->product->sale) }}
                                    <span>{{ number_format($exampleProduct->product->price) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
