@extends('layouts.admin')

@section('title')
    <h1>Order List</h1>
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
            <a class="btn btn-primary" href="{{ route('admin.order.create') }}" role="button">Thêm mới</a>
        </div>
    </div>

    <table class=" table table-striped thead-dark" id="myTable">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>SĐT</th>
                <th>Note</th>
                <th>trạng thái</th>
                <th class='text-right'>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr style="max-height: 50px; over-flow: auto">
                    <td scope="row">{{ $d->id }}
                    </td>
                    {{-- <td>{{$d->sanphams()->count()}}</td> --}}
                    <td>
                        {{ $d->user->name }} (id: {{ $d->user->id }})
                    </td>
                    <td>
                        {{ $d->name }}
                    </td>

                    <td>
                        {{ $d->email }}
                    </td>
                    <td>
                        {{ $d->address }}
                    </td>
                    <td>
                        {{ $d->phone }}
                    </td>
                    <td>
                        {{ $d->note }}
                    </td>
                    <td>
                        @if ($d->status == 1)
                            <span class="badge badge-success">Hoạt động</span>
                        @else
                            <span class="badge badge-danger">Không hoạt động</span>
                        @endif
                    </td>
                    <td class="text-right" style="white-space: nowrap;">
                        <a name="" id="" class="btn btn-sm btn-info" role="button"><i class="fas fa-info-circle"
                                data-toggle="modal" data-target="#model{{ $d->id }}"></i> </a>
                        <a name="" id="" class="btn btn-sm btn-primary" href="{{ route('admin.order.edit', $d->id) }}"
                            role="button"><i class="fa fa-edit"></i></a>
                        <a name="" id="" class="btn btn-sm btn-danger btndelete"
                            href="{{ route('admin.order.destroy', $d->id) }}" role="button"><i class="fa fa-trash"></i>
                        </a>
                    </td>
                    <!-- Button trigger modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="model{{ $d->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Chi tiết đơn hàng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        {{-- {{$d->orderdetails}} --}}
                                        @php($sum = 0)
                                        @foreach ($d->orderdetails as $d2)
                                            <p>{{ $d2->productDetail->product->model->name }}
                                                {{ $d2->productDetail->product->name }} -
                                                {{ $d2->productDetail->color->name }} -
                                                {{ $d2->productDetail->product->sale }} x {{ $d2->quantity }}</p>
                                            @php($sum += $d2->productDetail->product->sale * $d2->quantity)
                                        @endforeach
                                        <hr>
                                        <h5>Tổng tiền: {{ $sum }}</h5>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    {{-- <button type="button" class="btn btn-primary">Save</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
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
