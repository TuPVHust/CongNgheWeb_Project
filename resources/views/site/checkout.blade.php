@extends('layouts.site')
@section('content')
    @livewire('hero')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url('site') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Check Out</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('shop') }}">Home </a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{ route('placeorder') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            {{-- <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div> --}}
                            <div class="checkout__input">
                                <p>Tên người nhận<span>*</span></p>
                                <input type="text" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text">
                            </div> --}}
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Địa chỉ" class="checkout__input__add" name="address"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text">
                            </div> --}}
                            {{-- <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text">
                            </div> --}}
                            <div class="checkout__input" name="postcode">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text">
                            </div> --}}
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes</p>
                                <input type="text" placeholder="Notes about your order, e.g. special notes for delivery."
                                    name="note" value="{{ old('note') }}">
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products d-flex justify-content-between">
                                    Products
                                    <span>Quantity</span>
                                    <span>Total</span>
                                </div>
                                <ul>
                                    @foreach ($items as $item)
                                        <li class="d-flex justify-content-between align-items-center">
                                            <p style=" overflow: hidden;
                                                                text-overflow: ellipsis;
                                                            display: -webkit-box;                               
                                                            -webkit-line-clamp: 1;                               
                                                            line-clamp: 1; 
                                                            -webkit-box-orient: vertical;
                                                            width: 40%" data-toggle="popover" data-placement="top"
                                                data-content="{{ $item->name }}" class="mt-3">
                                                {{ $item->name }}
                                            </p>
                                            <span>{{ $item->qty }}</span>
                                            <span>{{ number_format($item->qty * $item->price, 0) }} <small
                                                    class="font-weight-bold">
                                                    đ</small></span>
                                        </li>
                                    @endforeach
                                    {{-- <li>Vegetable’s Package <span>$75.99</span></li>
                                    <li>Fresh Vegetable <span>$151.99</span></li>
                                    <li>Organic Bananas <span>$53.99</span></li> --}}
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>{{ Cart::subtotal(0) }}<small
                                            class="font-weight-bold">
                                            đ</small></span>
                                </div>
                                <div class="checkout__order__total">Total <span>{{ Cart::total(0) }}<small
                                            class="font-weight-bold">
                                            đ</small></span></div>
                                {{-- <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}
                                {{-- <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p> --}}
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover({
                placement: 'top',
                trigger: 'hover',
                html: true,
            });
        });
    </script>
@endsection
