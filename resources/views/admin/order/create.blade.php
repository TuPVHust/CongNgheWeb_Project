@extends('layouts.admin')

@section('title')
  <h1>Create demo order</h1>
@endsection

@section('content')
    <form action="{{route('admin.order.store')}}" method='post'>
        @csrf
        <div class="form-group">
          <label for="name">Tên nguời nhận</label>
          <input type="text" value="{{old('name')}}" class="form-control" name="name" id="category" aria-describedby="helpId" placeholder="Tên người nhận">
          @error('name')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>

        <div class="form-group">
            <label for="user">Người đặt (user)</label>
            <select class="form-control" name="user" id="user">
                @foreach ($users as $user)
                    <option value={{ $user->id }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="{{old('email')}}" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Email người nhận">
            @error('email')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" value="{{old('phone')}}" class="form-control" name="phone" id="phone" aria-describedby="helpId" placeholder="Số điện thoại người nhận">
            @error('phone')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" value="{{old('address')}}" class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Địa chỉ người nhận">
            @error('address')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="note">Note</label>
            <textarea name="note" id="" cols="30" rows="10"  class="form-control" name="note" id="note" aria-describedby="helpId" placeholder="Mô tả">{{old('description')}}</textarea> 
            @error('note')
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

        <button type="submit" class="btn btn-primary mb-2">Thêm mới</button>
    </form>
@endsection
