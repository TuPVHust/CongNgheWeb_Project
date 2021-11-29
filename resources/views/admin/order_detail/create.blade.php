@extends('layouts.admin')

@section('title')
  <h1>Create demo order detail</h1>
@endsection

@section('content')
    <form action="{{route('admin.order_detail.store')}}" method='post'>
        @csrf
        <div class="form-group">
            <label for="order">Order id</label>
            <select class="form-control" name="order" id="order">
                @foreach ($orders as $order)
                    <option value={{ $order->id }}>{{ $order->id }}</option>
                @endforeach
            </select>
            @error('order')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="product_detail">Product</label>
            <select class="form-control" name="product_detail" id="product_detail">
                @foreach ($product_details as $product_detail)
                    <option value={{ $product_detail->id }}>{{ $product_detail->product->name }} - {{$product_detail->color->name}}</option>
                @endforeach
            </select>
            @error('product_detail')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity">Số lượng mua</label>
            <input type="number" value="{{ old('quantity') }}" class="form-control" name="quantity"
                id="quantity" aria-describedby="helpId" placeholder="Số lượng mua">
            @error('quantity')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        
        <button type="submit" class="btn btn-primary mb-2">Thêm mới</button>
    </form>
@endsection
