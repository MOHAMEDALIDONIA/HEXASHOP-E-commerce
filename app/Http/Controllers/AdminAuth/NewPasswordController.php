<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuccessResetPass;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create($token,$email): View
    {
        return view('admin.auth.reset-password',['token'=>$token,'email' => $email]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' =>['required'],
            'email' => ['required', 'email','exists:admins'],
            'password' => ['required', 'confirmed','min:8'],
            'password_confirmation' => ['required']
        ]);

       $password_reset_request = DB::table('password_reset_tokens')
                                ->where('email',$request->input('email'))
                                ->where('token',$request->token)
                                ->first();

        if(!$password_reset_request){
            return back()->with('error' , '! Invalid Token');
        }  
        Admin::where('email',$request->input('email')) 
               ->update(['password' => Hash ::make($request->input('password'))])  ;    
        DB::table('password_reset_tokens')
               ->where('email',$request->input('email'))  
               ->delete();
        Mail::to($request->input('email'))->send(new SuccessResetPass());       
        return redirect('admin/login')->with('success','Reset Password Successfully');                           
    }
}
