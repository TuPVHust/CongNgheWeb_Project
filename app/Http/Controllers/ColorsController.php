<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ColorsController;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = Color::where('name', 'like', '%'.$key.'%')->orderby('name','asc')->paginate(100);
        }
        else {
            // $data = proModel::with('brand')->paginate(5);
            $data = Color::orderby('name','asc')->paginate(100);
        }
        return view('admin.color.index',[
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
        return view('admin.color.create');
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
            'name'=>'required|unique:colors,name',
            'code'=>'required|unique:colors,code'
            // 'name'=>'unique:colors,name',
            // 'code'=>'unique:colors,code'
        ],
        [
            'name.required' => 'Cần nhập tên màu',
            'name.unique' => 'Tên màu cần duy nhất',
            'code.required' => 'Cần nhập code màu',
            'code.unique' => 'code màu cần duy nhất',
        ]
        )){
            $color = Color::create([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]); 
            return redirect()->route('admin.color.index')->with('success','Thêm mới thành công.');
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
        $color = Color::find($id);
        return view('admin.color.edit',[
            'color' => $color
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
        $color = Color::find($id);
        if($request->validate([
            'name'=>'required|unique:models,name,'.$color->id,
            'code'=>'required|unique:colors,code,'.$color->id,
        ],
        [
            'name.required' => 'Cần nhập tên màu',
            'name.unique' => 'Tên màu cần duy nhất',
            'code.required' => 'Cần nhập code',
            'code.unique' => 'code cần duy nhất'
        ]
        )){
            $color->update([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]); 
            return redirect()->route('admin.color.index')->with('success','Cập nhật thành công.');
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
       
    }
}
