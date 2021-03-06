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
        $keys = $request->only('name','model');
        $products = Product::where('name',$keys['name'])->get();
        $check = true;
        foreach($products as $product)
            {
                if ($product->model->id == $keys['model'])
                {
                    $OverlapseProduct = $product;
                    $check = false;
                }
            }
        if($request->validate([
            // 'name'=>'required|unique:products,name',
            // 'model'=>'required',
            // 'description'=>'required',
            // 'price' => 'required|numeric|min:0',
            // 'sale' => 'required|numeric|min:0'
            'model'=>'required',
            'description'=>'required',
            'price' => 'required|numeric|min:0',
            'sale' => 'required|numeric|min:0'
        ],
        [
            'name.required' => 'C???n nh???p t??n s???n ph???m',
            'name.unique' => 'T??n s???n ph???m c???n duy nh???t',
            'description.required' => "C???n nh???p m?? t???",
            'price.required' => "C???n nh???p gi?? s???n ph???m",
            'sale.required' => "C???n nh???p gi?? sau sale s???n ph???m",
            'price.float' => "gi?? s???n ph???m c???n l?? s???",
            'sale.float' => "gi?? sau sale s???n ph???m c???n l?? s???",
            'sale.min' => "gi?? sau sale s???n ph???m c???n l???n h??n kh??ng",
            'price.min' => "gi?? s???n ph???m c???n l???n h??n kh??ng"
        ]
        ) && $check){
            $product = Product::create([
                'name' => $request->input('name'),
                'model' => $request->input('brand_id'), 
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'sale' => $request->input('sale'),
                'model_id' => $request->input('model')
            ]); 
            return redirect()->route('admin.product.index')->with('success','Th??m m???i th??nh c??ng.');
        }
        else{
            $alert = 'Th??m m???i kh??ng th??nh c??ng do c???u h??nh s???n ph???m ???? t???n v???i id: ' . $OverlapseProduct->id . ' !';
            return redirect()->route('admin.product.index')->with('danger', $alert);
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
        $keys = $request->only('name','model');
        $products = Product::where('name',$keys['name'])->get();
        $check = true;
        foreach($products as $_product)
            {
                if ($_product->model->id == $keys['model'] && $_product->id != $product->id)
                {
                    $OverlapseProduct = $_product;
                    $check = false;
                }
            }
        
        if($request->validate([
            // 'name'=>'required|unique:products,name,'.$product->id,
            'model'=>'required',
            'description'=>'required',
            'price' => 'required|numeric|min:0',
            'sale' => 'required|numeric|min:0'
        ],
        [
            'name.required' => 'C???n nh???p t??n s???n ph???m',
            'name.unique' => 'T??n s???n ph???m c???n duy nh???t',
            'description.required' => "C???n nh???p m?? t???",
            'price.required' => "C???n nh???p gi?? s???n ph???m",
            'sale.required' => "C???n nh???p gi?? sau sale s???n ph???m",
            'price.float' => "gi?? s???n ph???m c???n l?? s???",
            'sale.float' => "gi?? sau sale s???n ph???m c???n l?? s???",
            'sale.min' => "gi?? sau sale s???n ph???m c???n l???n h??n kh??ng",
            'price.min' => "gi?? s???n ph???m c???n l???n h??n kh??ng"

        ]
        ) && $check){
            $product->update([
                'name' => $request->input('name'),
                'model' => $request->input('brand_id'), 
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'sale' => $request->input('sale'),
                'model_id' => $request->input('model')
            ]); 
            return redirect()->route('admin.product.index')->with('success','C???p nh???t th??nh c??ng.');
        }
        else{
            $alert = 'C???p nh???t kh??ng th??nh c??ng do c???u h??nh s???n ph???m ???? t???n v???i id: ' . $OverlapseProduct->id . ' !';
            return redirect()->route('admin.product.index')->with('danger', $alert);
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
            return redirect()->route('admin.product.index')->with('danger','X??a b???n ghi kh??ng th??nh c??ng do c?? ch???a th??ng tin s???n ph???m chi ti???t.');
        }
        else{
            $product->delete();
            return redirect()->route('admin.product.index')->with('success','X??a b???n ghi th??nh c??ng.');
        }
    }
}
