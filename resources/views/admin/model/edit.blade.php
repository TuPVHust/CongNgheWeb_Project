@extends('layouts.admin')

@section('title')
     <h1>Model Edit </h1>
@endsection

@section('content')
<form action="{{route('admin.model.update',$model->id)}}" method='post' id ='mainForm'>
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="name">Tên model</label>
      <input type="text" value="{{$model->name}}" class="form-control infoInput" name="name" id="name" aria-describedby="helpId" placeholder="Tên model">
      @error('name')
      <small class="text-danger">{{$message}}</small>
      @enderror
    </div>


    <div class="form-group">
      <label for="brand">Thương hiệu</label>
      <select class="form-control infoInput" name="brand" id="brand">
        <option value={{$model->brand->id}}>{{$model->brand->name}}</option>
        @foreach ($brands as $brand)
          @if($brand->id != $model->brand->id)
          <option value={{$brand->id}}>{{$brand->name}}</option>
          @endif
        @endforeach
      </select>
        @error('brand_id')
      <small class="text-danger">{{$message}}</small>
      @enderror
    </div>
    <div class="form-group">
        <label for="category">Loại sản phẩm</label>
        <select class="form-control infoInput" name="category" id="category">
          <option value={{$model->category->id}}>{{$model->category->name}}</option>
          @foreach ($categories as $category)
            @if($category->id != $model->category->id)
            <option value={{$category->id}}>{{$category->name}}</option>
            @endif
          @endforeach
        </select>
        @error('category')
        <small class="text-danger">{{$message}}</small>
        @enderror
      </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

@section('js')
<script>
    $(".btndelete").click(function(ev){
        ev.preventDefault();
        let _href=$(this).attr('href');
        $("form#formdelete").attr('action',_href);
        if (confirm('Bạn muốn xóa bản ghi này không?'))
        {
            $("form#formdelete").submit();
        }
    });
</script>

@endsection