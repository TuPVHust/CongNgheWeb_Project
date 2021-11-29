@extends('layouts.admin')

@section('title')
  Edit category
@endsection

@section('content')
    <form action="{{route('admin.category.update',$category->id)}}" method='post'>
        @csrf @method('PUT')
        <div class="form-group">
          <label for="name">Tên nhóm sản phẩm</label>
          <input type="text" value="{{$category->name}}" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Tên nhóm sản phẩm">
          @error('name')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="status">Trạng thái</label>
          <select class="form-control" name="status" id="status">
            <option value=1 @if ($category->status==1) selected='selected' @endif>Hoạt động</option>
            <option value=0 @if ($category->status==0) selected='selected' @endif>Không hoạt động</option>
          </select>
        </div>
        <div class="form-group">
          <label for="piority">Mức ưu tiên</label>
          <input type="number" value="{{$category->piority}}" class="form-control" name="piority" id="piority" aria-describedby="helpId" placeholder="Mức ưu tiên">
          @error('piority')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection