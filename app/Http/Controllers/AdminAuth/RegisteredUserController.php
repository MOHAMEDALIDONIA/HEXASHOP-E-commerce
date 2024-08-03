<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\traits\savephoto;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    use savephoto;
        /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image'=>['nullable','mimes:jpg,jpeg,png'],
        ]);

        if($request->hasFile('image')){
            $image = $this->savephoto($request,'Admins/faces');
            $user = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'title'=>$request->title,
                'password' => Hash::make($request->password),
                'image'=>$image,

            ]);
       }else{
            $user = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'title'=>$request->title,
                'password' => Hash::make($request->password),
                

            ]);
       }
      

        event(new Registered($user));

        Auth::login($user);

        return redirect('admin')->with('message','register successfully');
    }
}
