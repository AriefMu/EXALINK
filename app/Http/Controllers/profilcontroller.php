<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class profilcontroller extends Controller
{
 public function index()
 {
        return view('profile');
 }
 public function update(Request $request)
 {     
       $this->validate($request, [
            
              'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              
          ]);
         
          //check if image is uploaded
          if ($request->hasFile('image')) {

              //upload new image
              $image = $request->file('image');
              $image->storeAs('public', $image->hashName());
              $user = User::find(Auth::user()->id);
              
              //delete old image
              Storage::delete('public'.$user->imgprofil);
  
              //update post with new image
              $user->update([
                  'imgprofil'     => $image->hashName(),
                  
              ]);
  
          } else {
  
              //update post without image
              
          }
  
         
        return back();
 }
 public function gantipassword()
 {
        return view('gantipw');
 }
 public function updatepw(Request $request)
 {
        $this->validate($request, [
            'passcur'=> 'required|current_password',
            'passnew'=> 'required',
            'passulang'=>'required|same:passnew'
        ]);
       
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->passnew);
        $user->save();
        return back()->with('success', 'Password changed!');
       
 }
}
