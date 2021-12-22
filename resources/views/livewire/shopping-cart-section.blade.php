<div>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th></th>
                                    <th class="m-10" style="width: 50px">color</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="
                                            {{ url('uploads') }}/{{ App\Models\ProductDetail::find($item->id)->poster }}"
                                                alt="">
                                        </td>
                                        <td>
                                            <h5 style="
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            display: -webkit-box;
                                            -webkit-line-clamp: 2;
                                                    line-clamp: 2; 
                                            -webkit-box-orient: vertical;" class="text-left">{{ $item->name }}
                                            </h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{ App\Models\ProductDetail::find($item->id)->color->name }}
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{ number_format($item->price, 0) }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty-cart">
                                                    <span class="dec qtybtn"
                                                        wire:click="$emit('quantityreduce', '{{ $item->rowId }}')">-</span>
                                                    <input type="text" value="{{ $item->qty }}"
                                                        wire:change.prevent="$emit('quantitychange', '{{ $item->rowId }}',$event.target.value )">
                                                    <span class="inc qtybtn"
                                                        wire:click="$emit('quantityincrease', '{{ $item->rowId }}')">+</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            {{ $item->subtotal(0) }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <span class="icon_close"
                                                wire:click.prevent="$emit('delete', '{{ $item->rowId }}' )"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('shop') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="{{ route('cart') }}" class="primary-btn cart-btn cart-btn-right"><span
                                class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>{{ Cart::subtotal(0) }}</span></li>
                            <li>Tax <span>{{ Cart::tax(0) }}</span></li>
                            <li>Total <span>{{ Cart::total(0) }}</span></li>
                        </ul>
                        <a href="{{ route('checkout') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
