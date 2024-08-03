<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{ 

    public function index(){
        $setting = Setting::first();
        return view('admin.setting.index',compact('setting'));
    }
    public function store(Request $request){
        $setting = Setting::first();
        if($setting){
            //update data
            $setting->update([
                'website_name'=>$request->website_name,
                'description'=>$request->description,
                'address'=>$request->address,
                'phone1'=>$request->phone1,
                'phone2'=>$request->phone2,
                'email'=>$request->email,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'instagram'=>$request->instagram,
                'youtube'=>$request->youtube,

            ]);
            return redirect()->back()->with('message','settings updated');

        }else{
            //create data
            Setting::create([
                'website_name'=>$request->website_name,
                'description'=>$request->description,
                'address'=>$request->address,
                'phone1'=>$request->phone1,
                'phone2'=>$request->phone2,
                'email'=>$request->email,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'instagram'=>$request->instagram,
                'youtube'=>$request->youtube,

            ]);
            return redirect()->back()->with('message','settings created');
        }

    }
   
}
