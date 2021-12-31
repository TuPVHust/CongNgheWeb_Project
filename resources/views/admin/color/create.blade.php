@extends('layouts.admin')

@section('title')
    <h1>Color create </h1>
@endsection

@section('content')
    <form action="{{ route('admin.color.store') }}" method='post'>
        @csrf
        <div class="form-group">
            <label for="name">Tên màu</label>
            <input type="text" value="{{ old('name') }}" class="form-control" name="name" id="category"
                aria-describedby="helpId" placeholder="Tên màu">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
                <br>
            @enderror

            <label for="code">code màu</label>
            <input type="text" value="{{ old('code') }}" class="form-control" name="code" id="category"
                aria-describedby="helpId" placeholder="code màu">
            @error('code')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Minimal</label>
            <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection

@section('js')

@endsection
