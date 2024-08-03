<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $categories = Category::where('status','0')->get();
        $user = User::where('id',auth()->user()->id)->first();
       return view('frontend.user.userprofile',compact('categories','user'));
    }
    public function ChangePassword($user_id){
        $categories = Category::where('status','0')->get();
         return view('frontend.user.changepassword',compact('categories'));
    }
    public function UpdateData($user_id){
        
        $categories = Category::where('status','0')->get();
        return view('frontend.user.updatedata',compact('categories'));
    }
}
