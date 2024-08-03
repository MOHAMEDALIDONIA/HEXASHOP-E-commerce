<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChangePassword extends Component
{   
    #[Validate]
   public $current_password,$password,$password_confirmation;
    protected $rules = [
        'current_password' => ['required','string','min:8'],
        'password' => ['required', 'string', 'min:8', 'confirmed']
    
         
    ];
    public function update(){
        $this->validate();
        $currentPasswordStatus = Hash::check($this->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($this->password),
            ]);
            session()->flash('message','Password Updated Successfully');
            
            $this->reset();
            return false;

        }else{

        
            session()->flash('message','Current Password does not match with Old Password');
            return false;
        }
    }
    public function render()
    {
        return view('livewire.change-password');
    }
}
