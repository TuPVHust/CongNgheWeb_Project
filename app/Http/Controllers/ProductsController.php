<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\proModel;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = Product::where('name', 'like', '%'.$key.'%')->orderby('name','asc')->paginate(100);
        }
        else {
            // $data = proModel::with('brand')->paginate(5);
            $data = Product::orderby('name','asc')->paginate(100);
        }

        return view('admin.product.index',[
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
        $models = proModel::all();
        return view ('admin.product.create',[
            'models' => $models
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
        if($request->validate([
            'name'=>'required|unique:products,name',
            'model'=>'required',
            'description'=>'required',
            'price' => 'required|numeric|min:0',
            'sale' => 'required|numeric|min:0'
        ],
        [
            'name.required' => 'Cần nhập tên sản phẩm',
            'name.unique' => 'Tên sản phẩm cần duy nhất',
            'description.required' => "Cần nhập mô tả",
            'price.required' => "Cần nhập giá sản phẩm",
            'sale.required' => "Cần nhập giá sau sale sản phẩm",
            'price.float' => "giá sản phẩm cần là số",
            'sale.float' => "giá sau sale sản phẩm cần là số",
            'sale.min' => "giá sau sale sản phẩm cần lớn hơn không",
            'price.min' => "giá sản phẩm cần lớn hơn không"
        ]
        )){
            $product = Product::create([
                'name' => $request->input('name'),
                'model' => $request->input('brand_id'), 
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'sale' => $request->input('sale'),
                'model_id' => $request->input('model')
            ]); 
            return redirect()->route('admin.product.index')->with('success','Thêm mới thành công.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $models = proModel::all();
        $product = Product::find($id);
        return view('admin.product.edit',[
            'product' => $product,
            'models' => $models
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
        $product = Product::find($id);
        if($request->validate([
            'name'=>'required|unique:products,name,'.$product->id,
            'model'=>'required',
            'description'=>'required',
            'price' => 'required|numeric|min:0',
            'sale' => 'required|numeric|min:0'
        ],
        [
            'name.required' => 'Cần nhập tên sản phẩm',
            'name.unique' => 'Tên sản phẩm cần duy nhất',
            'description.required' => "Cần nhập mô tả",
            'price.required' => "Cần nhập giá sản phẩm",
            'sale.required' => "Cần nhập giá sau sale sản phẩm",
            'price.float' => "giá sản phẩm cần là số",
            'sale.float' => "giá sau sale sản phẩm cần là số",
            'sale.min' => "giá sau sale sản phẩm cần lớn hơn không",
            'price.min' => "giá sản phẩm cần lớn hơn không"

        ]
        )){
            $product->update([
                'name' => $request->input('name'),
                'model' => $request->input('brand_id'), 
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'sale' => $request->input('sale'),
                'model_id' => $request->input('model')
            ]); 
            return redirect()->route('admin.product.index')->with('success','Cập nhật thành công.');
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
        $product = Product::find($id);   
        if ($product->productDetails()->count()>0){
            return redirect()->route('admin.product.index')->with('danger','Xóa bản ghi không thành công do có chứa thông tin sản phẩm chi tiết.');
        }
        else{
            $product->delete();
            return redirect()->route('admin.product.index')->with('success','Xóa bản ghi thành công.');
        }
    }
}
