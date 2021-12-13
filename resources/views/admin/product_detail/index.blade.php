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
            <th style="word-wrap: break-word;max-width: 150px;overflow: auto;">Sản phẩm</th>
            <th>Màu</th>
            <th>Ảnh</th>
            <th style="height: 100%">Poster</th>
            <th>Quantity</th>
            <th>status</th>
            <th class='text-right'>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td scope="row" class="text-center">{{ $d->id }}</td>
            <td style="word-wrap: break-word;max-width: 250px;overflow: auto;">
                <div class="" style="white-space: nowrap;text-overflow: ellipsis;max-width: 100%">
                    {{ $d->product->model->name }} {{ $d->product->name }}
                </div>
            </td>
            {{-- <td>{{$d->sanphams()->count()}}</td> --}}
            <td class="text-center">
                {{ $d->color->name }}
            </td>
            <td>
                {{-- Images --}}
                {{-- <img src="{{ url('uploads') }}/{{$d.}}" alt=""> --}}
                <div style="max-height: 30px">
                    <div class="" id="showImages" style="">
                    </div>
                </div>
            </td>
            <td>
                {{-- poster --}}
                <img src="{{ url('uploads') }}/{{ $d->poster }}" alt="" style="height: 30px">
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
            <td class="text-right w-10">
                <a name="" id="" class="btn btn-sm btn-primary" href="{{ route('admin.product_detail.edit', $d->id) }}"
                    role="button"><i class="fa fa-edit"></i></a>
                <a name="" id="" class="btn btn-sm btn-danger btndelete"
                    href="{{ route('admin.product_detail.destroy', $d->id) }}" role="button"><i class="fa fa-trash"></i>
                </a>
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


        window.addEventListener('load', (event) => {
            {
                // Initail data for images
                var _links = $('input#images').val();
                let _html = '';
                if (/^[\],:{}\s]*$/.test(_links.replace(/\\["\\\/bfnrtu]/g, '@').replace(
                        /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(
                        /(?:^|:|,)(?:\s*\[)+/g, ''))) {

                    var imgArr = $.parseJSON(_links);
                    for (var i = 0; i < imgArr.length; i++) {
                        let url = "{{ url('uploads') }}" + "/" + imgArr[i];
                        console.log(url);
                        _html += '<div class="col-md-3 shadow p-3 mb-5 bg-white rounded m-1" style="height: 100%">';

                        _html += '<img src="' + url + '" alt="" style="width: 100%">';
                        _html += '</div>';

                    }

                } else {
                    let url = "{{ url('uploads') }}" + "/" + _links;
                    console.log(url);
                    _html += '<div class="col-md-3 shadow p-3 mb-5 bg-white rounded m-1" style="height: 100%">';

                    _html += '<img src="' + url + '" alt="" style="width: 100%">';
                    _html += '</div>';

                }
                $('#showImages').html(_html);
                // Initail data for images end
                //Initail data for poster 
            }
        });
</script>




@endsection