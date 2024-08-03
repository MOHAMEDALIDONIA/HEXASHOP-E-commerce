<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File ;
use App\traits\savephoto;

class CategoryController extends Controller
{   use savephoto;
    public function __construct()
    {
        $this->middleware('permission:categories-read,guard:admin')->only('index');
        $this->middleware('permission:categories-create,guard:admin')->only('create');
        $this->middleware('permission:categories-update,guard:admin')->only('edit');
        $this->middleware('permission:categories-delete,guard:admin')->only('destory');
    }
    public function create(){
        return view('admin.category.create');
    }
    public function store(Request $request){
        if($request->hasFile('image')){
            $image = $this->savephoto($request,'Frontend/category');
            Category::create(
                [
                   'name'=>$request->name,
                   'small_description'=>$request->small_description,
                   'description'=>$request->description,
                   'image'=>$image,
                   'status'=> $request->status == true?'1':'0',
                   'banner_status'=> $request->banner_status == true?'1':'0'
                ]
                );
                return redirect()->back()->with('message','Category Added Successfully'); 

        }else{
            return redirect()->back()->with('message','Please,enter image of catgory');
        }
   
    }
    public function index(){
      $categories =  Category::all();
        return view('admin.category.index',compact('categories'));
    }
    public function edit($category_id){
       $category = Category::findOrFail($category_id);
       if (!$category) {
        return redirect()->back();
       }
       return view('admin.category.edit',compact('category'));
    }
    public function update(Request $request,$category_id){
        $category = Category::findOrFail($category_id);
        if (!$category) {
            return redirect()->back();
        }
        if($request->hasFile('image')){
            if(File::exists(public_path('storage/'.$category->image))){
                File::delete(public_path('storage/'.$category->image));
             }
          
             $image = $this->savephoto($request,'Frontend/category');
        }
       
        $category->update(
            [
                'name'=>$request->name,
                'small_description'=>$request->small_description,
                'description'=>$request->description,
                'image'=>$image??$category->image,
                'status'=>$request->status == true ? '1':'0',
                'banner_status'=>$request->banner_status == true ? '1':'0'
            ]
        );
        return redirect()->back()->with('message','Category Updated Successfully');

    }
    public function destory(int $category_id){
        $category = Category::findOrFail($category_id);
        if (!$category) {
            return redirect()->back();
        }
        $category->delete();
        return redirect()->back()->with('message','Category Deleted Successfully'); 
    }
}
