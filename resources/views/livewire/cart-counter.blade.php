<div>
    <div class="header__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-bag"></i> @if ($count)<span>{{ $count }}</span>@endif</a>
            </li>
        </ul>
        <div class="header__cart__price">item: <span>{{ $cost }} đ</span></div>
    </div>
</div>
