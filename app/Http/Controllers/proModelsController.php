<?php

namespace App\Http\Controllers;
use App\Models\proModel;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class proModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = proModel::where('name', 'like', '%'.$key.'%')->orderby('name','asc')->paginate(100);
        }
        else {
            // $data = proModel::with('brand')->paginate(5);
            $data = proModel::orderby('name','asc')->paginate(100);
        }

        return view('admin.model.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderby('name','asc')->paginate();
        $brands = Brand::orderby('name','asc')->paginate();
        return view('admin.model.create',[
            'brands' => $brands,
            'categories' => $categories
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
            'name'=>'required|unique:models,name',
            'brand_id'=>'required',
            'category_id'=>'required',
        ],
        [
            'name.required' => 'Cần nhập tên model',
            'name.unique' => 'Tên model cần duy nhất',
            'brand_id.required' => "Cần nhập tên thương hiệu",
            'category_id.required' => "Cần nhập tên nhóm sản phẩm",

        ]
        )){
            $model = proModel::create([
                'name' => $request->input('name'),
                'brand_id' => $request->input('brand_id'), 
                'category_id' => $request->input('category_id') 
            ]); 
            return redirect()->route('admin.model.index')->with('success','Thêm mới thành công.');
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
        $categories = Category::orderby('name','asc')->paginate();
        $brands = Brand::orderby('name','asc')->paginate();
        $model = proModel::find($id);
        return view('admin.model.edit',[
            'model' => $model,
            'brands' => $brands,
            'categories' => $categories
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
        $model = proModel::find($id);
        if($request->validate([
            'name'=>'required|unique:models,name,'.$model->id,
            'brand'=>'required',
            'category'=>'required',
        ],
        [
            'name.required' => 'Cần nhập tên model',
            'name.unique' => 'Tên model cần duy nhất',
            'brand.required' => "Cần nhập tên thương hiệu",
            'category.required' => "Cần nhập tên nhóm sản phẩm",

        ]
        )){
            $model->update([
                'name' => $request->input('name'),
                'brand_id' => $request->input('brand'), 
                'category_id' => $request->input('category') 
            ]); 
            return redirect()->route('admin.model.index')->with('success','Cập nhật thành công.');
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
        $model = proModel::find($id);   
        if ($model->products()->count()>0){
            return redirect()->route('admin.nhomsanpham.index')->with('danger','Xóa bản ghi không thành công do có chứa sản phẩm.');
        }
        else{
            $model->delete();
            return redirect()->route('admin.model.index')->with('success','Xóa bản ghi thành công.');
        }
    }
}
