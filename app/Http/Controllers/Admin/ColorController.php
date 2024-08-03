<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;

class ColorController extends Controller
{
    public function create(){
        return view('admin.colors.create');
    }
    public function store(ColorFormRequest $request){
        $validateData = $request->validated();
        $validateData['status'] = $request->status == true ? '1':'0';
        Color::create($validateData);
        return redirect()->back()->with('message','Added Color Successfully'); 
    }
    public function index(){
      $colors =  Color::all();
        return view('admin.colors.index',compact('colors'));
    }
    public function edit($color_id){
       $color = Color::findOrFail($color_id);
       if (!$color) {
        return redirect()->back();
       }
       return view('admin.colors.edit',compact('color'));
    }
    public function update(ColorFormRequest $request,$color_id){
        $color = Color::findOrFail($color_id);
        if (!$color) {
            return redirect()->back();
        }
        $color->update(
            [
                'name'=>$request->name,
                'code'=>$request->code,
                'status'=> $request->status == true?'1':'0'
            ]
        );
        return redirect('admin/color')->with('message','Color Updated Successfully'); 
    }
    public function destory(int $color_id){
        $color = Color::findOrFail($color_id);
        if (!$color) {
            return redirect()->back();
        }
        $color->delete();
        return redirect()->back()->with('message','Color Deleted Successfully'); 
    }
}
