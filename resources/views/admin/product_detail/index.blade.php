@extends('layouts.admin')

@section('title')
    <h1>Product detail List</h1>
@endsection

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
                    <input type="text" name="key" value="{{ request()->key }}" class="form-control" placeholder="Từ khóa"
                        aria-describedby="helpId">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div> --}}
        <div class="text-right">
            <a class="btn btn-primary" href="{{ route('admin.product_detail.create') }}" role="button">Thêm mới</a>
        </div>
    </div>

    <table class=" table table-striped thead-dark" id="myTable">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Sản phẩm</th>
                <th>Màu</th>
                <th>Ảnh</th>
                <th>Poster</th>
                <th>Quantity</th>
                <th>status</th>
                <th class='text-right'>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td scope="row">{{ $d->id }}</td>
                    <td>{{ $d->product->model->name }} {{ $d->product->name }}</td>
                    {{-- <td>{{$d->sanphams()->count()}}</td> --}}
                    <td>
                        {{ $d->color->name }}
                    </td>
                    <td style="overflow: hidden; !impotant
                               height: 14px;">
                        {{ $d->images }}
                    </td>
                    <td>
                        {{ $d->poster }}
                    </td>
                    <td class="text-center">
                        {{ $d->inventary }}
                    </td>
                    <td>
                        @if ($d->status == 1)
                            <span class="badge badge-success">Hoạt động</span>
                        @else
                            <span class="badge badge-danger">Không hoạt động</span>
                        @endif
                    </td>
                    <td class="text-right" style="width: 10%">
                        <a name="" id="" class="btn btn-sm btn-primary"
                            href="{{ route('admin.product_detail.edit', $d->id) }}" role="button"><i
                                class="fa fa-edit"></i></a>
                        <a name="" id="" class="btn btn-sm btn-danger btndelete"
                            href="{{ route('admin.product_detail.destroy', $d->id) }}" role="button"><i
                                class="fa fa-trash"></i> </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->appends(Request::all())->links() }}

    <form id='formdelete' action="" method="post">
        @csrf @method('DELETE')
    </form>
@endsection

@section('js')
    <script>
        $(".btndelete").click(function(ev) {
            ev.preventDefault();
            let _href = $(this).attr('href');
            $("form#formdelete").attr('action', _href);
            if (confirm('Bạn muốn xóa bản ghi này không?')) {
                $("form#formdelete").submit();
            }
        });
        $(document).ready( function () {
        $('#myTable').DataTable();
    });
    </script>
    
@endsection
