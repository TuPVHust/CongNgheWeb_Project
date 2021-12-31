<div>
    <div class="header__cart">
        <ul>
            <li><a href="javascript:void(0)"><i class="nav-icon fas fa-shipping-fast" data-toggle="modal"
                        data-target="#myModal"></i>
                    @if ($orderCount > 0)<span>{{ $orderCount }}</span> @endif
                </a>
            </li>
            <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-bag"></i> @if ($count)<span>{{ $count }}</span>@endif</a>
            </li>
        </ul>
        <div class="header__cart__price">item: <span>{{ $cost }} đ</span></div>
    </div>
</div>
@if ($orderDetails)
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Đơn Hàng đang sử lý</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                @if ($orderDetails->count())
                    <div class="modal-body">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Lượng</th>
                                    <th>Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($sum = 0)
                                @foreach ($orderDetails as $orderDetail)
                                    <tr>
                                        <td>{{ $orderDetail->productDetail->product->model->name }}
                                            {{ $orderDetail->productDetail->product->name }} -
                                            {{ $orderDetail->productDetail->color->name }}</td>
                                        <td>{{ $orderDetail->quantity }}</td>
                                        <td>{{ number_format($orderDetail->productDetail->product->sale * $orderDetail->quantity, 0) }}
                                        </td>
                                        @php($sum += $orderDetail->productDetail->product->sale * $orderDetail->quantity)
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h5>Tổng: {{ number_format($sum, 0) }}</h5>
                    </div>
                @else
                    <h5 class="text-center">Bạn không có đơn hàng nào</h5>
                @endif
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endif

</div>
