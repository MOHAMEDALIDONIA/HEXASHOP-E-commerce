<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\Admin;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {   
        $request->validate([
            'email' => ['required', 'email','exists:admins'],
        ]);
        $token = Str::random(64);
        $admin =  DB::table('password_reset_tokens')->where('email',$request->email)->first();
        $Time_Add_TwoMin = Carbon::now()->subMinutes(2);

        if ( DB::table('password_reset_tokens')->where('email',$request->email)->first()) {
            if (DB::table('password_reset_tokens')->where('email',$request->email)->where('created_at','<=',$Time_Add_TwoMin)->first()) {
                DB::table('password_reset_tokens')->where('email',$request->email)->update([
                    'token'=>$token,
                    'created_at'=>Carbon::now(),
        
                 ]
        
                );
                Mail::send('admin.auth.reset-mail-password',['token'=>$token,'admin'=>Admin::where('email',$request->email)->first() ],function($message)use ($request){
                     $message->to($request->input('email'));
                     $message->subject('Reset Password Mail');
                });
                return redirect('admin/forgot-password')->with('message','we have emailed your password reset link');
                
            }else{
                return redirect('admin/forgot-password')->with('error','please wait before retrying');
            }
    
            
        }else{
            DB::table('password_reset_tokens')->insert([
                'email' => $request->input('email'),
                'token'=>$token,
                'created_at'=>Carbon::now(),
    
             ]
    
            );
            Mail::send('admin.auth.reset-mail-password',['token'=>$token,'admin'=>Admin::where('email',$request->email)->first()],function($message)use ($request){
                $message->to($request->input('email'));
                $message->subject('Reset Password Mail');
           });
            return redirect('admin/forgot-password')->with('message','we have emailed your password reset link');
        
        }

     
   

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
    }
}
