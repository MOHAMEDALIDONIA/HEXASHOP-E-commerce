<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\File ;
use Livewire\WithFileUploads;

class ChangeData extends Component
{     
    use WithFileUploads;
    #[Validate]
    public $user ,$userupdate;
    public $name,$email,$image;
    protected $rules = [
        'name' => ['required','min:12'],
        'email' => ['required', 'min:18'],
        'image'=>['nullable','mimes:jpg,jpeg,png']
    
         
    ];
    public function update(){
        $this->validate();
        $this->userupdate = User::where('id',auth()->user()->id)->first();
        if($this->image){
            if(File::exists(public_path('storage/'.$this->userupdate->image))){
                File::delete(public_path('storage/'.$this->userupdate->image));
             }
          
             $file = $this->image;
             $ext=$file->getClientOriginalName();
             $path = $file->storeAs('Frontend/usersprofile',$ext,'public');
    
        }
        $this->userupdate->update(
            [
                'name'=>$this->name,
                'email'=>$this->email,
                'image'=>$path??$this->userupdate->image,
               
            ]
        );
        session()->flash('message','Data Updated Successfully');
        
        
        return false;
    }
    public function render()
    {   
        $this->user =User::where('id',auth()->user()->id)->first();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        return view('livewire.change-data',[
            'user'=>$this->user
        ]);
    }
}
