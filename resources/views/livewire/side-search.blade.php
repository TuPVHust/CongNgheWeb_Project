<div>
    <div class="sidebar">
        <div class="sidebar__item">
            <h4>Categories</h4>
            <ul>
                @foreach ($categories as $category)
                    <li class="w-100"><a href="#"
                            wire:click.prevent="selectCategory({{ $category->id }})">{{ $category->name }}
                            @if ($category->id == $this->selectionCatid)
                                <span class="ml-2 float-right"><i class="fas fa-check"></i></span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="sidebar__item" wire:ignore>
            <h4>Price</h4>
            <div class="price-range-wrap">
                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                    data-min="{{ $pMin }}" data-max="{{ $pMax }}">
                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                </div>
                <div class="range-slider">
                    <div class="price-input d-flex justify-content-between">
                        <input type="text" id="minamount" class="number-separator">
                        <input type="text" id="maxamount" class="number-separator">
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar__item sidebar__item__color--option">
            <h4>Colors</h4>
            @foreach ($colors as $color)
                @if ($color->name != 'none')
                    <div class="sidebar__item__color sidebar__item__color--gray"
                        wire:click.prevent="selectColor({{ $color->id }})"
                        style="--my-color-var : {{ $color->code }}">
                        <label for="{{ $color->id }}">
                            {{ $color->name }}
                            <input type="radio" id="{{ $color->id }}">
                            @if ($color->id == $this->colorId)
                                <span class="ml-2 float-right"><i class="fas fa-check"></i></span>
                            @endif
                        </label>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="sidebar__item">
            <h4>Popular Size</h4>
            <div class="sidebar__item__size">
                <label for="large">
                    Large
                    <input type="radio" id="large">
                </label>
            </div>
            <div class="sidebar__item__size">
                <label for="medium">
                    Medium
                    <input type="radio" id="medium">
                </label>
            </div>
            <div class="sidebar__item__size">
                <label for="small">
                    Small
                    <input type="radio" id="small">
                </label>
            </div>
            <div class="sidebar__item__size">
                <label for="tiny">
                    Tiny
                    <input type="radio" id="tiny">
                </label>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script type="text/javascript">
        function update_price(minPrice, maxPrice) {
            @this.call('updatePrice', minPrice, maxPrice);
        }
    </script>
@endpush
