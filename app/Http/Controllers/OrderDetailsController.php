<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\User;
use App\Models\ProductDetail;
class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = OrderDetail::where('order_id', 'like', '%'.$key.'%')->orderby('id','desc')->paginate(10);
        }
        else {
            // $data = proModel::with('brand')->paginate(5);
            $data = OrderDetail::orderby('id','desc')->paginate(100);
        }
        $data = OrderDetail::orderby('id','desc')->paginate(100);
        return view('admin.order_detail.index',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_details = ProductDetail::all();
        $orders = Order::all();
        return view('admin.order_detail.create',[
            'orders' => $orders,
            'product_details' => $product_details
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
        $keys = $request->only('order','product_detail');
        $orders = OrderDetail::where('order_id',$keys['order'])->get();
        $check = true;
        foreach($orders as $order)
            {
                if ($order->productDetail->id == $keys['product_detail'])
                {
                    $Overlapseorder = $order;
                    $check = false;
                }
            }
        if($request->validate([
            'order'=>'required',
            'product_detail'=>'required',
            'quantity' => 'required|numeric',
        ],
        [
            'order.required' => 'Cần nhập id đơn hàng',
            'product_detail.required' => "Cần có sản phẩm yêu cầu",   
            'quantity.numeric' => "số lượng đặt cần là số",
            'quantity.required' => 'Cần nhập số lượng đặt',  
        ]) && $check){
            $order_detail = OrderDeTail::create([
                'order_id' => $request->input('order'),
                'cert_product_id' => $request->input('product_detail'),
                'quantity' => $request->input('quantity'),
            ]); 
            return redirect()->route('admin.order_detail.index')->with('success','Thêm mới thành công.');
        }
        else{
            $alert = 'chi tiết đơn hàng đã tồn tại với id: ' . $Overlapseorder->id . ', bạn muốn cập nhật số lượng ?';
            return redirect()->route('admin.order_detail.index')->with('danger', $alert);
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
        $order_detail = OrderDetail::find($id);
        $product_details = ProductDetail::all();
        $orders = Order::all();
        return view('admin.order_detail.edit',[
            'orders' => $orders,
            'product_details' => $product_details,
            'order_detail' => $order_detail,
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
        $order_detail = OrderDetail::find($id);
        if($request->validate([
            'order'=>'required',
            'product_detail'=>'required',
            'quantity' => 'required|numeric',
        ],
        [
            'order.required' => 'Cần nhập id đơn hàng',
            'product_detail.required' => "Cần có sản phẩm yêu cầu",   
            'quantity.numeric' => "số lượng đặt cần là số",
            'quantity.required' => 'Cần nhập số lượng đặt',  
        ])){
            $order_detail->update([
                'order_id' => $request->input('order'),
                'cert_product_id' => $request->input('product_detail'),
                'quantity' => $request->input('quantity'),
            ]); 
            return redirect()->route('admin.order_detail.index')->with('success','Cập nhật thành công.');
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
        $order_detail = OrderDetail::find($id);   
        // if ($nhomsanpham->sanphams()->count()>0){
        //     return redirect()->route('admin.nhomsanpham.index')->with('error','Xóa bản ghi không thành công do có chứa sản phẩm.');
        // }
        // else{
        $order_detail->delete();
        return redirect()->route('admin.order_detail.index')->with('success','Xóa bản ghi thành công.');
    }
}
