@extends('layouts.admin')

@section('title')
    <h1>Product List</h1>
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
            <a class="btn btn-primary" href="{{ route('admin.product.create') }}" role="button">Thêm mới</a>
        </div>
    </div>

    <table class=" table table-striped thead-dark" id="myTable">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th style="word-wrap: break-word;max-width: 150px;overflow: auto;">Model</th>
                <th style="word-wrap: break-word;max-width: 150px;overflow: auto;">Tên</th>
                <th>Price</th>
                <th>Sale</th>
                <th>Mô tả</th>
                <th class='text-right'>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr style="">
                    <td scope="row">{{ $d->id }}</td>
                    {{-- <td>{{$d->sanphams()->count()}}</td> --}}
                    <td style="word-wrap: break-word;max-width: 150px;overflow: auto;">
                        {{ $d->model->name }}
                    </td>
                    <td style="word-wrap: break-word;max-width: 150px;overflow: auto;">@if($d->name ) {{ $d->name }} @else none @endif</td>
                    <td>
                        {{ number_format($d->price) }}
                    </td>
                    <td>
                        {{ number_format($d->sale) }}

                    </td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                            data-target="#Modal_{{ $d->id }}">
                            Xem mô tả
                        </button>
                        {{-- {!!$d->description!!} --}}
                    </td>
                    <td class="text-right" style="width: 10%">
                        <a name="" id="" class="btn btn-sm btn-primary" href="{{ route('admin.product.edit', $d->id) }}"
                            role="button"><i class="fa fa-edit"></i></a>
                        <a name="" id="" class="btn btn-sm btn-danger btndelete"
                            href="{{ route('admin.product.destroy', $d->id) }}" role="button"><i
                                class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>




                <!-- Modal -->
                <div class="modal fade" id="Modal_{{ $d->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Mô tả sản phẩm</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid" style="max-height: 500px; overflow: auto">
                                    {!! $d->description !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Save</button> --}}
                            </div>
                        </div>
                    </div>
                </div>


            @endforeach
        </tbody>
    </table>

    {{ $data->appends(Request::all())->links() }}

    <form id='formdelete' action="" method="post">
        @csrf @method('DELETE')
    </form>

    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM

        });
    </script>
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
