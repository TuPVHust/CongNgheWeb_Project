<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = Category::where('name', 'like', '%'.$key.'%')->orderby('piority','DESC')->paginate(100);
        }
        else {
            $data = Category::orderby('piority','DESC')->paginate(100);
        }

        return view('admin.category.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name'=>'required|unique:categories,name',
            'piority'=>'required',
        ],
        [
            'name.required' => 'Cần nhập tên nhóm sản phẩm',
            'name.unique' => 'Tên nhóm sản phẩm cần duy nhất',
            'piority.required' => "Cần nhập mức độ ưu tiên",

        ]
        );

        if (Category::create($request->all())){
            return redirect()->route('admin.category.index')->with('success','Thêm mới thành công.');
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
        $category = Category::find($id);
        return view('admin.category.edit',["category"=>$category]);
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
        $category = Category::find($id);
        $request->validate([
            'name'=>'required|unique:categories,name,'.$category->id,
            'piority'=>'required',
        ],
        [
            'name.required' => 'Cần nhập tên nhóm sản phẩm',
            'name.unique' => 'Tên nhóm sản phẩm cần duy nhất',
            'piority.required' => "Cần nhập mức độ ưu tiên",

        ]
        );
        
        if ($category->update($request->all())){
            return redirect()->route('admin.category.index')->with('success','Thêm mới thành công.');
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
        $category = Category::find($id);   
        if ($category->models()->count()>0){
            return redirect()->route('admin.category.index')->with('danger','Xóa bản ghi không thành công do có chứa model.');
        }
        else{
            $category->delete();
            return redirect()->route('admin.category.index')->with('success','Xóa bản ghi thành công.');
        }
    }
}
