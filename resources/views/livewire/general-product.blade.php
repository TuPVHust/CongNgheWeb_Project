<div>
    {{-- <div class="filter__item">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div>
                    <div class="filter__sort">
                        <span>Sort By</span>
                        <select id="selectInput_product" wire:model="sortFeature" style="display: none">
                            <option value='products.sale' {{ $sortFeature=='products.sale' ? 'selected="selected"' : ''
                                }}>Giá</option>
                            <option value='cert_products.id' {{ $sortFeature=='cert_products.id' ? 'selected="selected"'
                                : '' }}>Ngày tạo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="filter__found">
                    <h6><span>{{$products->count()}}</span> Products found</h6>
                </div>
            </div>
            <div class="col-lg-4 col-md-3">
                <div class="filter__option">
                    <span class="icon_grid-2x2"></span>
                    <span class="icon_ul"></span>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">

        @foreach ($products as $product)
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
                {{-- <div class="product__item__pic set-bg" data-setbg="{{ url('site') }}/img/product/product-11.jpg">
                    --}}
                    <div class="product__item__pic set-bg d-flex align-items-center">
                        <img src="{{ url('uploads') }}/{{$product->poster}}" alt="" style="width: auto; height: auto">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{route('shop-detail', $product->id)}}" style="
                        overflow: hidden;
                        text-overflow: ellipsis;
                        display: -webkit-box;
                        -webkit-line-clamp: 2;
                                line-clamp: 2; 
                        -webkit-box-orient: vertical;">{{$product->product->model->name}}
                                {{$product->product->name}}</a></h6>
                        @if ($product->product->price > $product->product->sale )
                        <h6 style="text-decoration: line-through">{{ number_format($product->product->price) }} <small
                                class="font-weight-bold">đ</small></h6>
                        <h5>{{ number_format($product->product->sale) }} <small class="font-weight-bold">đ</small></h5>
                        @else
                        <h5>{{ number_format($product->product->price) }} <small class="font-weight-bold">đ</small></h5>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div>
            {{ $products->links('livewire.custom-paginate-links') }}
        </div>
    </div>
</div>
<script>
    // let select = document.getElementById("selectInput_product");
    // select.onchange = function(e) {
    //     Livewire.emit('changeSort', select.value);
    // }
    
    // $(document).ready(function() {
    //     alert('oki')
    //     });
    // });

</script>