@extends('layouts.admin')

@section('title')
  <h1>Create new category</h1>
@endsection

@section('content')
    <form action="{{route('admin.category.store')}}" method='post'>
        @csrf
        <div class="form-group">
          <label for="category">Tên nhóm sản phẩm</label>
          <input type="text" value="{{old('name')}}" class="form-control" name="name" id="category" aria-describedby="helpId" placeholder="Tên nhóm sản phẩm">
          @error('name')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="status">Trạng thái</label>
          <select class="form-control" name="status" id="status">
            <option value=1 @if (old('status')==1) selected='selected' @endif>Hoạt động</option>
            <option value=0 @if (old('status')!=null and old('status')==0) selected='selected' @endif>Không hoạt động</option>
          </select>
        </div>
        @error('status')
        <small class="text-danger">{{$message}}</small>
        @enderror

        <div class="form-group">
          <label for="piority">Mức ưu tiên</label>
          <input type="number" value="{{old('piority')}}" class="form-control" name="piority" id="piority" aria-describedby="helpId" placeholder="Mức ưu tiên">
          @error('piority')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection