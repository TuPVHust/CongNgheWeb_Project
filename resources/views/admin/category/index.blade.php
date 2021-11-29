@extends('layouts.admin')

@section('title')
     <h1>Category List</h1>
@endsection
{{-- @section('filter')
    <input id="myInput" type="text" placeholder="Search..">
@endsection --}}


@section('content')
@if (session('danger'))
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('danger') }}
</div>  
@endif
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}
</div>  
@endif
    <div class="my-2">
        {{-- <div class="col-md-8">
            <form class="form-inline">
                <div class="form-group">
                    <input id="myInput" type="text" name="key" value="{{request()->key}}" class="form-control" placeholder="Từ khóa" aria-describedby="helpId">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div> --}}
        <div class="text-right">
            <a class="btn btn-primary" href="{{route('admin.category.create')}}" role="button">Thêm mới</a>
        </div>
    </div>
    
    <table class=" table table-striped thead-dark" id="myTable">
        <thead class ="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                {{-- <th>Số sản phẩm</th> --}}
                <th>Trạng thái</th>
                <th>Mức ưu tiên</th>
                <th class='text-right'>Hành động</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td scope="row">{{$d->id}}</td>
                <td>{{$d->name}}</td>
                {{-- <td>{{$d->sanphams()->count()}}</td> --}}
                <td>
                    @if ($d->status==1)
                        <span class="badge badge-success">Hoạt động</span>
                    @else
                        <span class="badge badge-danger">Không hoạt động</span>
                    @endif
                </td>
                <td>{{$d->piority}}</td>
                <td class="text-right">
                    <a name="" id="" class="btn btn-sm btn-primary" href="{{route('admin.category.edit', $d->id)}}" role="button"><i class="fa fa-edit"></i></a>
                    <a name="" id="" class="btn btn-sm btn-danger btndelete" href="{{route('admin.category.destroy',$d->id)}}" role="button"><i class="fa fa-trash"></i> </a>
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

    $(document).ready(function(){
    $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>
@endsection