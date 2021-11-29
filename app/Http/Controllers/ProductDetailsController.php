<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\Product;
use App\Models\Color;
use Illuminate\Support\Facades\File;
class ProductDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if ($key=request()->key){
        //     $data = ProductDetail::where('name', 'like', '%'.$key.'%')->orderby('name','asc')->paginate(10);
        // }
        // else {
        //     // $data = proModel::with('brand')->paginate(5);
        //     $data = ProductDetail::orderby('name','asc')->paginate(10);
        // }

        $data = ProductDetail::orderby('id','asc')->paginate(100);
        return view('admin.product_detail.index',[
            'data'=>$data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::all();
        $products = Product::all();
        return view('admin.product_detail.create',[
            'colors' => $colors,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keys = $request->only('product','color');
        $products = ProductDetail::where('product_id',$keys['product'])->get();
        $check = true;
        foreach($products as $product)
            {
                if ($product->color->id == $keys['color'])
                {
                    $Overlapseproduct = $product;
                    $check = false;
                }
            }
        if($request->validate([
            'product'=>'required',
            'images'=>'required',
            'color'=>'required',
            'inventary' => 'required|numeric|min:1',
            'status' => 'required',
            'poster' => 'required'
        ],
        [
            'product.required' => 'Cần nhập tên sản phẩm',
            'images.required' => "Cần có ảnh mô tả",
            'inventary.required' => "Cần nhập số lượng thêm sản phẩm",
            'color.required' => "Cần nhập màu cho sản phẩm",
            'inventary.numeric' => "số lượng sản phẩm cần là số",
            'inventary.min' => "sô lượng sản phẩm cần lớn hơn không",
            'status.required' => 'Cần nhập trạng thái sản phẩm',
            'poster.required' => "Cần có poster",
        ]) && $check){
            $product = ProductDetail::create([
                'product_id' => $request->input('product'),
                'images' => $request->input('images'),
                'color_id' => $request->input('color'),
                'inventary' => $request->input('inventary'),
                'status' => $request->input('status'),
                'poster' => $request->input('poster'),
            ]); 
            return redirect()->route('admin.product_detail.index')->with('success','Thêm mới thành công.');
        }
        else
        {
            $alert = 'chi tiết sản phẩm đã tồn tại với id: ' . $Overlapseproduct->id . ', bạn muốn cập nhật số lượng ?';
            return redirect()->route('admin.product_detail.index')->with('danger', $alert);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colors = Color::all();
        $products = Product::all();
        $product_detail = ProductDetail::find($id);
        return view('admin.product_detail.edit',[
            'colors' => $colors,
            'products' => $products,
            'product_detail' => $product_detail
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product_detail = ProductDetail::find($id);
        $oldImageName = $product_detail->images;
        $oldPosterName = $product_detail->poster;
        if($request->validate([
            'product'=>'required',
            'color'=>'required',
            'inventary' => 'required|numeric|min:1',
            'status' => 'required'
        ],
        [
            'product.required' => 'Cần nhập tên sản phẩm',
            'inventary.required' => "Cần nhập số lượng thêm sản phẩm",
            'color.required' => "Cần nhập màu cho sản phẩm",
            'inventary.numeric' => "số lượng sản phẩm cần là số",
            'inventary.min' => "sô lượng sản phẩm cần lớn hơn không",
            'status.required' => 'Cần nhập trạng thái sản phẩm',
        ])){
            if ($request->has('images')){
                $file_name= $request->input('images');   
            }
            else{
                $file_name = $oldImageName;
            }
            if ($request->has('poster')){
                $file_name2= $request->input('poster');   
            }
            else{
                $file_name2 = $oldPosterName;
            }
            $product = $product_detail->update([
                'product_id' => $request->input('product'),
                'images' => $file_name, 
                'color_id' => $request->input('color'),
                'inventary' => $request->input('inventary'),
                'status' => $request->input('status'),
                'poster' => $request->input('poster'),
            ]); 
            return redirect()->route('admin.product_detail.index')->with('success','Cập nhật thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_detail = ProductDetail::find($id);   
        // if ($nhomsanpham->sanphams()->count()>0){
        //     return redirect()->route('admin.nhomsanpham.index')->with('error','Xóa bản ghi không thành công do có chứa sản phẩm.');
        // }
        // else{
        $product_detail->delete();
        return redirect()->route('admin.product_detail.index')->with('success','Xóa bản ghi thành công.');
    }
}
