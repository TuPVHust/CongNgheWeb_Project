<div>
    <div class="filter__item">
        <div class="row">
            <div class="col-lg-3 col-md-4" wire:ignore>
                <div>
                    <div class="filter__sort">
                        <span>Sort By</span>
                        <select id="selectInput_product" wire:model="sortFeature" style="display: none">
                            {{-- <option value="product_id" {{ $sortFeature == 'product_id' ? 'selected="selected"' : ''}}>Tên</option>
                            <option value="created_at" {{ $sortFeature == 'created_at' ? 'selected="selected"' : ''}}>Ngày tạo</option> --}}
                            <option value='products.sale'
                                {{ $sortFeature == 'products.sale' ? 'selected="selected"' : '' }}>Giá</option>
                            <option value='cert_products.id'
                                {{ $sortFeature == 'cert_products.id' ? 'selected="selected"' : '' }}>Độ mới</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 p-0 m-0">
                @livewire('order-select')
            </div>
            <div class="col-lg-4 col-md-3">
                <div class="filter__found">
                    <h6><span>{{ $count }}</span> Products found</h6>
                </div>
            </div>
            @livewire('view-type-select')
        </div>
    </div>
</div>
