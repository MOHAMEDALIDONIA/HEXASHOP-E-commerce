<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(){
        $todaywithtime = Carbon::now()->format('Y-m-d H:i:s');
        $allusers_discount =DiscountUser::whereHas('user')->where('expiry_date' ,'<',$todaywithtime)->delete();
        
         
        
        $users=User::paginate(1);
        $totalcount = User::count();

        
      
        return view('admin.users.index',compact('users','totalcount'));
    }
    public function  edit(int $user_id) {
        $user =User::findOrFail($user_id); 
        return view('admin.users.adddiscount',compact('user'));
    }
    public function AddDiscountUser(int $user_id,Request $request){
        $user = User::where('id',$user_id)->first();
        $todaywithtime = Carbon::now()->format('Y-m-d H:i:s');
       
        $request->validate([
            'discount_percentage'=>'required|integer',
            'discount_code'=>'required|string',
            'expiry_date'=>'required|date|after:now'
        ]);
        if($request->discount_code == 'no code'){
            return redirect()->back()->with('message','please,enter discount code');
        }
        if ($user->DiscountCode()->exists()) {
            $user->DiscountCode()->update([
               'discount_percentage'=> $request->discount_percentage??$user->DiscountCode->discount_percentage,
                'discount_code'=>$request->discount_code ??$user->DiscountCode->discount_code,
                'expiry_date'=>$request->expiry_date ?? $user->DiscountCode->expiry_date
            ]);
            $userdiscount = $user->DiscountCode->where('expiry_date','>',$todaywithtime)->first();
            $expiry_date =$userdiscount->expiry_date;
            $carbonDate1 = Carbon::createFromFormat('Y-m-d H:i:s', $expiry_date ,null);
            $carbonDate2 = Carbon::createFromFormat('Y-m-d H:i:s', $todaywithtime);
            $daysdifference= $carbonDate1->diffInDays($carbonDate2);
            Mail::send('admin.pages.updatediscountcode',['user'=>$user,'days'=>$daysdifference],function($message)use($user){
                
                $message->to($user->email);
                $message->subject('Update Discount Code');
           });
            return redirect()->back()->with('message','Update Discount Code Successfully and will send mail to User('.$user->email.')');
        } else {
            $user->DiscountCode()->create([
                'discount_percentage'=> $request->discount_percentage,
                 'discount_code'=>$request->discount_code,
                 'expiry_date'=>$request->expiry_date 
             ]);
             $userdiscount = $user->DiscountCode()->where('expiry_date','>',$todaywithtime)->first();
             $expiry_date =$userdiscount->expiry_date;
             $carbonDate1 = Carbon::createFromFormat('Y-m-d H:i:s', $expiry_date);
             $carbonDate2 = Carbon::createFromFormat('Y-m-d H:i:s', $todaywithtime);
             $daysdifference= $carbonDate1->diffInDays($carbonDate2);
             Mail::send('admin.pages.Adddiscountcode',['user'=>$user,'days'=>$daysdifference],function($message)use($user){
                 
                 $message->to($user->email);
                 $message->subject('Discount Code');
            });
             return redirect()->back()->with('message','Add Discount Code Successfully and will send mail to User('.$user->email.')');
        }
        
      
    }
    public function destory(int $user_id){
        $user = User::findOrFail($user_id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with('message','User Deleted Successfully');
        } else {
            return redirect()->back()->with('message','Something Wrong !');
        }
        

    }
    public function DeleteDiscountCode($user_id) {
        $user = User::findOrFail($user_id);
        if ($user->DiscountCode()->exists()) {
            $user->DiscountCode()->where('user_id',$user_id)->delete();
            return redirect()->back()->with('message','Discount Code User Deleted Successfully');
        } else {
            return redirect()->back()->with('message','Please, Enter Discount Code First Than Deleted');
        }
        
    }
}
