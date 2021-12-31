@extends('layouts.admin')

@section('title')
    <h1>Order detail List</h1>
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
                    <input type="text" name="key" value="{{request()->key}}" class="form-control" placeholder="Từ khóa" aria-describedby="helpId">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div> --}}
        <div class="text-right">
            <a class="btn btn-primary" href="{{ route('admin.order_detail.create') }}" role="button">Thêm mới</a>
        </div>
    </div>

    <table class=" table table-striped thead-dark" id="myTable">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Order id</th>
                <th>product id</th>
                <th>Product</th>
                <th>Quantity</th>
                <th class='text-right'>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr style="max-height: 50px; over-flow: auto" id="mytable">
                    <td scope="row">{{ $d->id }}</td>
                    {{-- <td>{{$d->sanphams()->count()}}</td> --}}
                    <td>
                        {{ $d->Order->id }}
                    </td>
                    <td>
                        {{ $d->cert_product_id }}
                    </td>
                    <td>
                        {{-- {{ $d->productDetail->product->name }} - {{$d->productDetail->color->name}} --}}
                        {{ $d->productDetail->product->model->name }} {{ $d->productDetail->product->name }} -
                        {{ $d->productDetail->color->name }}
                    </td>
                    <td>
                        {{ $d->quantity }}
                    </td>
                    <td class="text-right" style="width: 10%">
                        <a name="" id="" class="btn btn-sm btn-primary"
                            href="{{ route('admin.order_detail.edit', $d->id) }}" role="button"><i
                                class="fa fa-edit"></i></a>
                        <a name="" id="" class="btn btn-sm btn-danger btndelete"
                            href="{{ route('admin.order_detail.destroy', $d->id) }}" role="button"><i
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
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
