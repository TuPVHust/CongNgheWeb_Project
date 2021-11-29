@extends('layouts.admin')

@section('title')
  <h1>Edit demo order detail</h1>
@endsection

@section('content')
    <form action="{{route('admin.order_detail.update',$order_detail->id)}}" method='post'>
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="order">Order id</label>
            <select class="form-control" name="order" id="order">
                <option value={{ $order_detail->order->id }}>{{ $order_detail->order->id }}</option>
                @foreach ($orders as $order)
                    @if($order->id !=$order_detail->order->id)
                    <option value={{ $order->id }}>{{ $order->id }}</option>
                    @endif
                @endforeach
            </select>
            @error('order')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="product_detail">Product</label>
            <select class="form-control" name="product_detail" id="product_detail">
                <option value={{ $order_detail->productDetail->id }}>{{ $order_detail->productDetail->product->name }} - {{$order_detail->productDetail->color->name}}</option>
                @foreach ($product_details as $product_detail)
                    @if($product_detail->id != $order_detail->productDetail->id )
                    <option value={{ $product_detail->id }}>{{ $product_detail->product->name }} - {{$product_detail->color->name}}</option>
                    @endif
                @endforeach
            </select>
            @error('product_detail')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity">Số lượng mua</label>
            <input type="number" value="{{ $order_detail->quantity }}" class="form-control" name="quantity"
                id="quantity" aria-describedby="helpId" placeholder="Số lượng mua">
            @error('quantity')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        
        <button type="submit" class="btn btn-primary mb-2">Cập nhật</button>
    </form>
@endsection
