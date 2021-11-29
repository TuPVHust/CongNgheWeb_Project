@extends('layouts.admin')

@section('title')
    <h1>Product detail create </h1>
@endsection

@section('content')
    <form action="{{ route('admin.product_detail.store') }}" method='post' enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product"> tên Sản phẩm</label>
                    <select class="form-control" name="product" id="product">
                        @foreach ($products as $product)
                            <option value={{ $product->id }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('product')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="color">Màu</label>
                    <select class="form-control" name="color" id="color">
                        @foreach ($colors as $color)
                            <option value={{ $color->id }}>{{ $color->name }}</option>
                        @endforeach
                    </select>
                    @error('color')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" name="status" id="status">
                        <option value=1 @if (old('status') == 1) selected='selected' @endif>Hoạt động</option>
                        <option value=0 @if (old('status') != null and old('status') == 0) selected='selected' @endif>Không hoạt động</option>
                    </select>
                </div>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    <label for="inventary">Số lượng hàng nhập vào</label>
                    <input type="number" value="{{ old('inventary') }}" class="form-control" name="inventary"
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
                                style="width: 100%">
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
                            <input type="text" class="" id="poster" name="poster"
                                placeholder="choose poster image" style="width: 100%">
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
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            </div>
        </div>
    </form>





    <!-- Modal for images -->
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



@endsection

@section('js')
    <script>
        $('#modelId').on('hide.bs.modal', event => {
            if($('input#images').val()){
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
                    console.log(url);
                    _html += '<div class="col-md-3 shadow p-3 mb-5 bg-white rounded m-1" style="height: 100%">';

                    _html += '<img src="' + url + '" alt="" style="width: 100%">';
                    _html += '</div>';

                }

            } else {
                if(_links !=="")
                {
                  let url = "{{ url('uploads') }}" + "/" + _links;
                console.log(url);
                _html += '<div class="col-md-3 mt-3 shadow p-3 mb-5 bg-white rounded m-1" style="height: 100%">';

                _html += '<img src="' + url + '" alt="" style="width: 100%">';
                _html += '</div>';
                }
            }
            $('#showImages').html(_html);
            // Use above variables to manipulate the DOM

            }
        });
    </script>
    <script>
        $('#modelId2').on('hide.bs.modal', event => {
            if($('input#poster').val()){
                var _links = $('input#poster').val();
            let _html2 = '';
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
                    _html2 += '<div class="col-md-3 shadow p-3 mb-5 bg-white rounded m-1" style="height: 100%">';

                    _html2 += '<img src="' + url + '" alt="" style="width: 100%">';
                    _html2 += '</div>';

                }

            } else {
                
                  let url = "{{ url('uploads') }}" + "/" + _links;
                console.log(url);
                _html2 += '<div class="col-md-3 mt-2 shadow p-3 mb-5 bg-white rounded m-1" style="height: 100%">';

                _html2 += '<img src="' + url + '" alt="" style="width: 100%">';
                _html2 += '</div>';
            }


            $('#showPoster').html(_html2);
            // Use above variables to manipulate the DOM

            }
        });
    </script>

@endsection
