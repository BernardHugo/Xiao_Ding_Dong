<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller {
    public function viewProfile() {
        return view('profile.view_profile');
    }

    public function viewProfileAdmin() {
        return view('profile.admin_view_profile');
    }

    public function editProfile() {
        return view('profile.edit_profile');
    }

    public function editProfileAdmin() {
        return view('profile.admin_edit_profile');
    }

    public function saveProfile(Request $request, $id){
        $request->validate([
            'name' =>  'required|min:5',
            'email' => 'nullable|ends_with:@gmail.com',
            'phone' => 'min:12|max:12',
            'address' => 'nullable|min:5',
            'current_password' => 'required',
            'new_password' => 'min:5|max:255',
            'confirm_new_password' => 'min:5|max:255|same:new_password',
            'profile_picture' => 'mimes:jpg,png,jpeg'
        ]);

        $user = User::find($id);

        $profile_picture = $request->file('profile_picture');
        $pictureName = time().'.'.$profile_picture->getClientOriginalExtension();
        $profile_picture->storeAs('public/images', $pictureName);
        $user->profile_picture = $pictureName;

        if(!Hash::check($request->input('current_password'), Auth::user()->password)){
            return redirect()->route('edit_profile', ['id' => $user->id])->with('error_message', 'Must be same as previous password');
        } 

        if($request->input('new_password') != $request->input('confirm_new_password')){
            return redirect()->route('edit_profile', ['id' => $user->id])->with('error_message', 'Must be same as new password');
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        $user->password = Hash::make($request->input('new_password'));

        $user->save();
        return redirect()->route('edit_profile', ['id' => $user->id])->with('success','Your profile has been updated successfully');
    }

    public function saveProfileAdmin(Request $request, $id){
        $request->validate([
            'name' =>  'required|min:5',
            'email' => 'nullable|ends_with:@gmail.com',
            'phone' => 'min:12|max:12',
            'address' => 'nullable|min:5',
            'current_password' => 'required',
            'new_password' => 'min:5|max:255',
            'confirm_new_password' => 'min:5|max:255|same:new_password',
            'profile_picture' => 'mimes:jpg,png,jpeg'
        ]);

        $user = User::find($id);

        $profile_picture = $request->file('profile_picture');
        $pictureName = time().'.'.$profile_picture->getClientOriginalExtension();
        $profile_picture->storeAs('public/images', $pictureName);
        $user->profile_picture = $pictureName;

        if(!Hash::check($request->current_password, Auth::user()->password)){
            return redirect()->route('admin.edit_profile', ['id' => $user->id])->with('error_message', 'Must be same as previous password');
        }

        if($request->new_password != $request->confirm_new_password){
            return redirect()->route('admin.edit_profile', ['id' => $user->id])->with('error_message', 'Must be same as new password');
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        $user->password = Hash::make($request->input('new_password'));

        $user->save();

        return redirect()->route('admin.edit_profile' , ['id' => $user->id])->with('success', 'Your profile has been updated successfully');
    }
}
