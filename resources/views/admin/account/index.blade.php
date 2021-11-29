@extends('layouts.admin')

@section('title')
<h1>Account List</h1>
@endsection


@section('content')
@if (session('status'))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('status') }}
    </div>  
@endif
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('success') }}
    </div>  
@endif
    {{-- <div class="row my-2">
        <div class="col-md-8">
            <form class="form-inline">
                <div class="form-group">
                    <input type="text" name="key" value="{{request()->key}}" class="form-control" placeholder="Từ khóa" aria-describedby="helpId">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div> --}}
        {{-- <div class="col-md-4 text-right">
            <a class="btn btn-primary" href="{{route('admin.brand.create')}}" role="button">Thêm mới</a>
        </div> --}}
    </div>
    <table class=" table table-striped thead-dark" id="myTable">
        <thead class ="thead-dark">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th>Status</th>
                <th>Role</th>
                {{-- <th>Số sản phẩm</th> --}}
                <th class='text-right'>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td scope="row">{{$d->id}}</td>
                <td>{{$d->email}}</td>
                <td>{{$d->password}}</td>
                <td>
                    @if ($d->status==1)
                        <span class="badge badge-success">Hoạt động</span>
                    @else
                        <span class="badge badge-danger">Không hoạt động</span>
                    @endif
                </td>
                <td>
                    @if ($d->role==0)
                    <span class="badge">SysAdmin</span>
                    @else
                    <span class="badge">User</span>
                    @endif
                </td>
                <td class="text-right">
                    @if ($d->role==0 && $d->id == Auth::user()->id)
                    <span class="btn btn-info disabled">You</span>
                    @else
                        @if ($d->role==0)
                            <span class="btn btn-danger disabled">No action allowed</span>
                        @else
                        <a name="" id="" class="btn btn-sm btn-primary" href="{{route('admin.account.edit', $d->id)}}" role="button"><i class="fa fa-edit"></i></a>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{$data->appends(Request::all())->links()}}

    <form id='formdelete' action="" method="post">
        @csrf @method('DELETE')
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


    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>
@endsection
