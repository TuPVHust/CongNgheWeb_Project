@extends('layouts.admin')

@section('title')
     <h1>Product edit </h1>
@endsection

@section('content')
<form action="{{route('admin.product.update', $product->id)}}" method='post'>
    @csrf
    @method('put')
    <div class="form-group">
      <label for="name">Tên sản phẩm</label>
      <input type="text" value="{{$product->name}}" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Tên sản phẩm">
      @error('name')
      <small class="text-danger">{{$message}}</small>
      @enderror
    </div>


    <div class="form-group">
      <label for="model">Model</label>
      <select class="form-control" name="model" id="model">
        <option value={{$product->model->id}}>{{$product->model->name}}</option>
        @foreach ($models as $model)
            @if($model->id !=$product->model->id)
                <option value={{$model->id}}>{{$model->name}}</option>
            @endif        
        @endforeach
      </select>
        @error('model')
      <small class="text-danger">{{$message}}</small>
      @enderror
    </div>
    
    <div class="form-group">
        <label for="description">Mô tả</label>
        <textarea name="description" id="" cols="30" rows="10"  class="form-control" name="description" id="description" aria-describedby="helpId" placeholder="Mô tả">{{$product->description}}</textarea> 
        @error('description')
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>


    <div class="form-group">
        <label for="price">Giá khởi đầu</label>
        <input type="number" value="{{$product->price}}" class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="Giá khởi đầu">
        @error('price')
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="sale">Giá sau sale</label>
        <input type="number" value="{{$product->sale}}" class="form-control" name="sale" id="sale" aria-describedby="helpId" placeholder="Giá sau sale">
        @error('sale')
        <small class="text-danger">{{$message}}</small>
        @enderror
      </div>

    <button type="submit" class="btn btn-primary mb-5">Cập nhật</button>
</form>
@endsection

@section('js')
@endsection