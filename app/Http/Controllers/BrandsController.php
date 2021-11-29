<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = Brand::where('name', 'like', '%'.$key.'%')->orderby('id','ASC')->paginate(100);
        }
        else {
            $data = Brand::orderby('id','ASC')->paginate(100);
        }

        return view('admin.brand.index',['data'=>$data]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:brands,name' 
        ],
        [
            'name.required' => 'Cần nhập tên thương hiệu',
            'name.unique' => 'Tên thương hiệu đã tồn tại',
        ]
        );

        if (Brand::create($request->all())){
            return redirect()->route('admin.brand.index')->with('success','Thêm mới thành công.');
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
        $brand = Brand::find($id); 
        return view('admin.brand.edit',[
            'brand' => $brand
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
        $brand = Brand::find($id);
        $request->validate([
            'name'=>'required|unique:brands,name,'.$brand->id,
        ],
        [
            'name.required' => 'Cần nhập tên thương hiệu',
            'name.unique' => 'Tên tên thương hiệu đã tồn tại',
        ]
        );
        
        if ($brand->update($request->all())){
            return redirect()->route('admin.brand.index')->with('success','Cập nhật thành công.');
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
        $brand = Brand::find($id);   
        if ($brand->Models()->count()>0){
            return redirect()->route('admin.brand.index')->with('danger','Xóa bản ghi không thành công do có chứa model.');
        }
        else{
            $brand->delete();
            return redirect()->route('admin.brand.index')->with('success','Xóa bản ghi thành công.');
        }
           
    }
}
