<div>
    <div class="filter__item">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div>
                    <div class="filter__sort">
                        <span>Sort By</span>
                        <select id="selectInput_product" wire:model = "sortFeature" style="display: none">
                            {{-- <option value="product_id" {{ $sortFeature == 'product_id' ? 'selected="selected"' : ''}}>Tên</option>
                            <option value="created_at" {{ $sortFeature == 'created_at' ? 'selected="selected"' : ''}}>Ngày tạo</option> --}}
                            <option value='products.sale' {{ $sortFeature == 'products.sale' ? 'selected="selected"' : ''}} >Giá</option>
                            <option value='cert_products.id' {{ $sortFeature == 'cert_products.id' ? 'selected="selected"' : ''}}>Độ mới</option>
                        </select>
                        {{-- <div class="nice-select" tabindex="0">
                            <span class="current">

                            </span>
                            <ul class="list">
                                <li data-value= "product_id" class="option"> Tên</li>
                                <li data-value = "created_at" class="option selected">Ngày tạo</li>
                            </ul>
                        </div> --}}
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
    </div>
</div>
