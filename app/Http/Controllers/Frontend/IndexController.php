<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    public function index() {
        return view('frontend.index');
    }

    public function UserLogout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile() {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));

    }

    public function UserProfileStore(Request $request) {
        $storeData = User::find(Auth::user()->id);
        $storeData->name = $request->name;
        $storeData->email = $request->email;
        $storeData->phone = $request->phone;

        if($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            
            
            if ($storeData->profile_photo_path && file_exists(public_path('upload/user_images/'.$storeData->profile_photo_path))) {  
                unlink(public_path('upload/user_images/'.$storeData->profile_photo_path));  
            }
           
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $storeData['profile_photo_path'] = $filename;
        }

        $storeData->save();

        $notification = array (
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    public function UserChangePassword() {

        return view('frontend.profile.change_password');
    }


    public function UserUpdatePassword(Request $request) {

        $validateData = $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            
            Auth::logout();
            return redirect()->route('user.logout');
        
        } else {
            return redirect()->back();
        }

    
    }
}
