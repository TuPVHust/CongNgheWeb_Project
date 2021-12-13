@extends('layouts.admin')

@section('title')
<h1>Product detail edit </h1>
@endsection

@section('content')
<form action="{{ route('admin.product_detail.update', $product_detail->id) }}" method='post'
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="product"> tên Sản phẩm</label>
                <select class="form-control" name="product" id="product">
                    <option value={{ $product_detail->product->id }}>{{ $product_detail->product->model->name }} {{
                        $product_detail->product->name }}</option>
                    @foreach ($products as $product)
                    @if ($product->id != $product_detail->product->id)
                    <option value={{ $product->id }}>{{ $product->model->name }}{{ $product->name }}</option>
                    @endif
                    @endforeach
                </select>
                @error('product')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="color">Màu</label>
                <select class="form-control" name="color" id="color">
                    <option value={{ $product_detail->color->id }}>{{ $product_detail->color->name }}</option>
                    @foreach ($colors as $color)
                    @if ($color->id != $product_detail->color->id)
                    <option value={{ $color->id }}>{{ $color->name }}</option>
                    @endif
                    @endforeach
                </select>
                @error('color')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select class="form-control" name="status" id="status">
                    <option value=1 @if ($product_detail->status == 1) selected='selected' @endif>Hoạt động</option>
                    <option value=0 @if ($product_detail->status == 0) selected='selected' @endif>Không hoạt động
                    </option>
                </select>
            </div>
            @error('status')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label for="inventary">Số lượng hàng nhập vào</label>
                <input type="number" value="{{ $product_detail->inventary }}" class="form-control" name="inventary"
                    id="inventary" aria-describedby="helpId" placeholder="Số lượng hàng nhập vào">
                @error('inventary')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="images">Ảnh</label>
                <div class="mb-3">
                    <div class="input-group-prepend">
                        <input type="text" class="" id="images" name="images" placeholder="choose images"
                            style="width: 100%" value="{{ $product_detail->images }}">
                        <span class="input-group-text" id="basic-addon3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
                                <i class="fa fa-folder-open"></i>
                            </button>
                        </span>
                    </div>
                    <div style="max-height: 150px; overflow: auto">
                        <div class="row container" id="showImages" style="height: 150px">
                        </div>
                    </div>
                </div>
            </div>
            @error('images')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label for="poster">Poster</label>

                <div class="mb-3">
                    <div class="input-group-prepend">
                        <input type="text" class="" id="poster" name="poster" placeholder="choose poster image"
                            style="width: 100%" value="{{ $product_detail->poster }}">
                        <span class="input-group-text" id="basic-addon3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId2">
                                <i class="fa fa-folder-open"></i>
                            </button>
                        </span>
                    </div>
                    <div style="max-height: 150px; overflow: auto">
                        <div class="row" id="showPoster" style="height: 150px;">
                        </div>
                    </div>
                </div>
            </div>
            @error('poster')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="w-100">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </div>
</form>


{{-- modal for images --}}
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kho ảnh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <iframe src="{{ url('file/dialog.php/?field_id=images') }}" frameborder="0"
                        style="width:100%; height:500px; overflow-y:auto; border:none"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal for poster -->
<div class="modal fade" id="modelId2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kho ảnh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <iframe src="{{ url('file/dialog.php/?field_id=poster') }}" frameborder="0"
                        style="width:100%; height:500px; overflow-y:auto; border:none"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





@section('js')
<script>
    window.addEventListener('load', (event) => {
            var _links = $('input#poster').val();
            console.log(_links);
            let _html = '';
            if (/^[\],:{}\s]*$/.test(_links.replace(/\\["\\\/bfnrtu]/g, '@').replace(
                    /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(
                    /(?:^|:|,)(?:\s*\[)+/g, ''))) {

                var imgArr = $.parseJSON(_links);
                console.log(imgArr2);

                for (var i = 0; i < imgArr.length; i++) {
                    let url = "{{ url('uploads') }}" + "/" + imgArr[i];
                    _html2 += '<div class="col-md-3 shadow p-3 mb-5 bg-white rounded m-1" style="height: 100%">';

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
            $('#showPoster').html(_html);

        });
        window.addEventListener('load', (event) => {
            {
                // Initail data for images
                var _links = $('input#images').val();
                alert(_links)
                let _html = '';
                if (/^[\],:{}\s]*$/.test(_links.replace(/\\["\\\/bfnrtu]/g, '@').replace(
                        /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(
                        /(?:^|:|,)(?:\s*\[)+/g, ''))) {

                    var imgArr = $.parseJSON(_links);
                    console.log(imgArr);

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

        // edit for poster
        $('#modelId2').on('hide.bs.modal', event => {
            var _links = $('input#poster').val();
            let _html = '';
            if (/^[\],:{}\s]*$/.test(_links.replace(/\\["\\\/bfnrtu]/g, '@').replace(
                    /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(
                    /(?:^|:|,)(?:\s*\[)+/g, ''))) {

                var imgArr = $.parseJSON(_links);
                console.log(imgArr);

                for (var i = 0; i < imgArr.length; i++) {
                    // let url = "{{ url('uploads') }}" + "/" + imgArr[i];
                    // console.log(url);
                    //   _html += '<div class="col-md-2 mt-2 shadow p-3 mb-5 bg-white rounded m-1"';
                    //   _html += '<img src="'+ url +'" alt="" style="width: 100%">';
                    //   _html +='</div>';
                    let url = "{{ url('uploads') }}" + "/" + imgArr[i];
                    console.log(url);
                    _html += '<div class="col-md-3 shadow p-3 mb-5 bg-white rounded m-1" style="height: 100%">';

                    _html += '<img src="' + url + '" alt="" style="width: 100%">';
                    _html += '</div>';

                }

            } else {
                let url = "{{ url('uploads') }}" + "/" + _links;
                console.log(url);
                _html += '<div class="col-md-3 mt-3 shadow p-3 mb-5 bg-white rounded m-1" style="height: 100%">';

                _html += '<img src="' + url + '" alt="" style="width: 100%">';
                _html += '</div>';

            }


            $('#showPoster').html(_html);
            // Use above variables to manipulate the DOM

        });

        // edit for images
        $('#modelId').on('hide.bs.modal', event => {
            var _links = $('input#images').val();
            let _html = '';
            if (/^[\],:{}\s]*$/.test(_links.replace(/\\["\\\/bfnrtu]/g, '@').replace(
                    /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(
                    /(?:^|:|,)(?:\s*\[)+/g, ''))) {

                var imgArr = $.parseJSON(_links);
                console.log(imgArr);

                for (var i = 0; i < imgArr.length; i++) {
                    // let url = "{{ url('uploads') }}" + "/" + imgArr[i];
                    // console.log(url);
                    //   _html += '<div class="col-md-2 mt-2 shadow p-3 mb-5 bg-white rounded m-1"';
                    //   _html += '<img src="'+ url +'" alt="" style="width: 100%">';
                    //   _html +='</div>';
                    let url = "{{ url('uploads') }}" + "/" + imgArr[i];
                    _html += '<div class="col-md-3 shadow p-3 mb-5 bg-white rounded m-1" style="height: 100%">';

                    _html += '<img src="' + url + '" alt="" style="width: 100%">';
                    _html += '</div>';

                }

            } else {
                let url = "{{ url('uploads') }}" + "/" + _links;
                console.log(url);
                _html += '<div class="col-md-3 mt-3 shadow p-3 mb-5 bg-white rounded m-1" style="height: 100%">';

                _html += '<img src="' + url + '" alt="" style="width: 100%">';
                _html += '</div>';

            }
            $('#showImages').html(_html);
            // Use above variables to manipulate the DOM

        });
</script>

@endsection