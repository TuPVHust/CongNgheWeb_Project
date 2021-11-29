@extends('layouts.admin')

@section('title')
<h1>Edit Account</h1>
@endsection


@section('content')
    <form action="{{route('admin.account.update',$user->id)}}" method='post'>
        @csrf
        @method('PUT')
        <h3> Updating account of: <span class="ml-2">{{$user->email}}</span></h1>
        {{-- <div class="form-group">
          <label for="brand">Brand Name</label>
          <input type="text" value="{{old('name')}}" class="form-control" name="name" id="brand" aria-describedby="helpId" placeholder="Tên nhóm thương hiệu">
          @error('name')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div> --}}
        <div class="form-group">
          <label for="status">Trạng thái</label>
          <select class="form-control" name="status" id="status">
            <option value=1 @if ($user->status==1) selected='selected' @endif>Hoạt động</option>
            <option value=0 @if ($user->status==0) selected='selected' @endif>Không hoạt động</option>
          </select>
          @error('status')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <select class="form-control" name="role" id="role">
            <option value=1 @if (old('status')==1) selected='selected' @endif>User</option>
            <option value=0 @if (old('status')!=null and old('status')==0) selected='selected' @endif>Admin</option>
          </select>
          @error('role')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
