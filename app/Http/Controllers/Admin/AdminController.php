<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\traits\savephoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    use savephoto;
    public function __construct()
    {  
        $this->middleware('permission:admin-read,guard:admin')->only('index');
        $this->middleware('permission:admin-create,guard:admin')->only('create');
        $this->middleware('permission:admin-update,guard:admin')->only('edit');
        $this->middleware('permission:admin-delete,guard:admin')->only('destory');
    }
    public function index(){
        $admins=Admin::where('id','>',0)->whereHasRole('admin')->get();
        $totalcount =Admin::count();
        return view('admin.admins.index',compact('admins','totalcount'));
    }
    public function create(){
     
        return view('admin.admins.create');
    }
    public function store(Request $request){
     
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'permissions' => ['required','min:1'],
        ]);
        if($request->hasFile('image')){
            $image = $this->savephoto($request,'Admins/faces');
            $admin= Admin::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'title'=>$request->title,
                'password'=>Hash::make($request->password),
                'image'=>$image
             ]);
       }else{
            $admin= Admin::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'title'=>$request->title,
                'password'=>Hash::make($request->password)
            ]);
       }
       $admin->addRole('admin');
       
       $admin->syncPermissions($request->permissions);
       return redirect()->back()->with('message','Admin Added Successfully');
   
    }
    public function edit(int $admin_id){
       $admin=Admin::findOrFail($admin_id);
        return view('admin.admins.edit',compact('admin'));
    }
    public function update(int $admin_id,Request $request){
        $admin = Admin::findOrFail($admin_id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($admin_id)],
            'permissions' => ['required','min:1'],
        ]);
       if($request->hasFile('image')){
            if(File::exists(public_path('storage/'.$request->image))){
                File::delete(public_path('storage/'.$request->image));
            }
            $image = $this->savephoto($request,'Admins/faces');
       } 
       $admin->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'title'=>$request->title,
        'image'=>$image??$admin->image
       ]);
       $admin->syncPermissions($request->permissions);
     
       return redirect()->back()->with('message','Admin Updated Successfully');
    }
    public function destory($admin_id){
        $admin=Admin::findOrFail($admin_id);
        DB::table('permission_user')->where('user_id',$admin_id)->delete();
        $admin->delete();
      
        if($admin->id == Auth::guard('admin')->id){
            Auth::guard('admin')->logout();
            return redirect('/admin/login');
        }
        return redirect()->back()->with('message','Admin Deleted Successfully');
    }
}
