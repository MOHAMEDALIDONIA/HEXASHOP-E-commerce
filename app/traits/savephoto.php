<?php
namespace App\traits;

use Illuminate\Http\Request;

Trait savephoto {
    public function savephoto(Request $request,$flodername){
        
        $file = $request->file('image');
        $ext=time().$file->getClientOriginalName();
        $path = $file->storeAs($flodername,$ext,'public');
        return $path;

    }

}
?>