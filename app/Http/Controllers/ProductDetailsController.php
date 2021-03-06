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
            'product.required' => 'C???n nh???p t??n s???n ph???m',
            'images.required' => "C???n c?? ???nh m?? t???",
            'inventary.required' => "C???n nh???p s??? l?????ng th??m s???n ph???m",
            'color.required' => "C???n nh???p m??u cho s???n ph???m",
            'inventary.numeric' => "s??? l?????ng s???n ph???m c???n l?? s???",
            'inventary.min' => "s?? l?????ng s???n ph???m c???n l???n h??n kh??ng",
            'status.required' => 'C???n nh???p tr???ng th??i s???n ph???m',
            'poster.required' => "C???n c?? poster",
        ]) && $check){
            $product = ProductDetail::create([
                'product_id' => $request->input('product'),
                'images' => $request->input('images'),
                'color_id' => $request->input('color'),
                'inventary' => $request->input('inventary'),
                'status' => $request->input('status'),
                'poster' => $request->input('poster'),
            ]); 
            return redirect()->route('admin.product_detail.index')->with('success','Th??m m???i th??nh c??ng.');
        }
        else
        {
            $alert = 'chi ti???t s???n ph???m ???? t???n t???i v???i id: ' . $Overlapseproduct->id . ', b???n mu???n c???p nh???t s??? l?????ng ?';
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
            'product.required' => 'C???n nh???p t??n s???n ph???m',
            'inventary.required' => "C???n nh???p s??? l?????ng th??m s???n ph???m",
            'color.required' => "C???n nh???p m??u cho s???n ph???m",
            'inventary.numeric' => "s??? l?????ng s???n ph???m c???n l?? s???",
            'inventary.min' => "s?? l?????ng s???n ph???m c???n l???n h??n kh??ng",
            'status.required' => 'C???n nh???p tr???ng th??i s???n ph???m',
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
            return redirect()->route('admin.product_detail.index')->with('success','C???p nh???t th??nh c??ng.');
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
        //     return redirect()->route('admin.nhomsanpham.index')->with('error','X??a b???n ghi kh??ng th??nh c??ng do c?? ch???a s???n ph???m.');
        // }
        // else{
        $product_detail->delete();
        return redirect()->route('admin.product_detail.index')->with('success','X??a b???n ghi th??nh c??ng.');
    }
}
