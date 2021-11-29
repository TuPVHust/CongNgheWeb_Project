<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = Order::where('id', 'like', '%'.$key.'%')->orderby('id','desc')->paginate(100);
        }
        else {
            // $data = proModel::with('brand')->paginate(5);
            $data = Order::orderby('name','desc')->paginate(100);
        }
        $data = Order::orderby('id','desc')->paginate(100);
        return view('admin.order.index',[
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
        $users = User::all();
        return view('admin.order.create',[
            'users' => $users
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
            'user'=>'required',
            'name'=>'required',
            'email'=>'required|email',
            'address' => 'required',
            'status' => 'required|numeric',
            'phone' => 'required'
        ],
        [
            'user.required' => 'Cần nhập nguời đặt hàng',
            'name.required' => "Cần có tên người nhận",
            'email.required' => "Cần nhập địa chỉ email",
            'email.email' => "địa chỉ mail không hợp lệ",
            'address.required' => "Cần nhập địa chỉ",
            'status.numeric' => "trạng thái không hợp lệ",
            'status.required' => 'Cần nhập trạng thái sản phẩm',
            'phone.required' => "Cần có số điện thoại liên lạc",
        ])){
            $order = Order::create([
                'user_id' => $request->input('user'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'status' => $request->input('status'),
                'phone' => $request->input('phone'),
                'note' => $request->input('note'),
            ]); 
            return redirect()->route('admin.order.index')->with('success','Thêm mới thành công.');
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
        $users = User::all();
        $order = Order::find($id);
        return view('admin.order.edit',[
            'order' => $order,
            'users' => $users
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
        $order = Order::find($id);
        if($request->validate([
            'user'=>'required',
            'name'=>'required',
            'email'=>'required|email',
            'address' => 'required',
            'status' => 'required|numeric',
            'phone' => 'required'
        ],
        [
            'user.required' => 'Cần nhập nguời đặt hàng',
            'name.required' => "Cần có tên người nhận",
            'email.required' => "Cần nhập địa chỉ email",
            'email.email' => "địa chỉ mail không hợp lệ",
            'address.required' => "Cần nhập địa chỉ",
            'status.numeric' => "trạng thái không hợp lệ",
            'status.required' => 'Cần nhập trạng thái sản phẩm',
            'phone.required' => "Cần có số điện thoại liên lạc",
        ])){
            $order->update([
                'user_id' => $request->input('user'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'status' => $request->input('status'),
                'phone' => $request->input('phone'),
                'note' => $request->input('note'),
            ]); 
            return redirect()->route('admin.order.index')->with('success','Cập nhật thành công.');
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
        $order = Order::find($id);   
        if ($order->orderdetails()->count()>0){
            return redirect()->route('admin.order.index')->with('error','Xóa bản ghi không thành công do có chứa chi tiết đơn hàng.');
        }
        else{
            $order->delete();
            return redirect()->route('admin.order.index')->with('success','Xóa bản ghi thành công.');
        }
    }
}
