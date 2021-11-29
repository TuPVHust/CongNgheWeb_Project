@extends('layouts.admin')

@section('title')
     <h1>Model create </h1>
@endsection

@section('content')
<form action="{{route('admin.model.store')}}" method='post'>
    @csrf
    <div class="form-group">
      <label for="name">Tên model</label>
      <input type="text" value="{{old('name')}}" class="form-control" name="name" id="category" aria-describedby="helpId" placeholder="Tên model">
      @error('name')
      <small class="text-danger">{{$message}}</small>
      @enderror
    </div>


    <div class="form-group">
      <label for="brand_id">Thương hiệu</label>
      <select class="form-control" name="brand_id" id="brand_id">
        @foreach ($brands as $brand)
          <option value={{$brand->id}}>{{$brand->name}}</option>
        @endforeach
      </select>
        @error('brand_id')
      <small class="text-danger">{{$message}}</small>
      @enderror
    </div>
    <div class="form-group">
        <label for="category_id">Loại sản phẩm</label>
        <select class="form-control" name="category_id" id="category_id">
          @foreach ($categories as $category)
            <option value={{$category->id}}>{{$category->name}}</option>
          @endforeach
        </select>
        @error('category_id')
        <small class="text-danger">{{$message}}</small>
        @enderror
      </div>
    <button type="submit" class="btn btn-primary">Thêm mới</button>
</form>
@endsection

@section('js')
@endsection