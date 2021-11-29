@extends('layouts.admin')

@section('title')
     <h1>Color edit </h1>
@endsection

@section('content')
<form action="{{route('admin.color.update',$color->id)}}" method='post'>
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="name">Tên màu</label>
      <input type="text" value="{{$color->name}}" class="form-control" name="name" id="category" aria-describedby="helpId" placeholder="Tên màu">
      @error('name')
      <small class="text-danger">{{$message}}</small>
      @enderror

      <label for="code">code màu</label>
      <input type="text" value="{{$color->code}}" class="form-control" name="code" id="category" aria-describedby="helpId" placeholder="code màu">
      @error('code')
      <small class="text-danger">{{$message}}</small>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">cập nhật</button>
</form>
@endsection

@section('js')

@endsection