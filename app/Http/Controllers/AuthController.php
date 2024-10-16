<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use App\Models\Food;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\PageController;

class AuthController extends Controller {

    public function logIn(){        
        return view('auth.login');
    }

    public function registration(){
        return view('auth.register');
    }

    public function validateRegister(Request $request){
        $request->validate([
            'name'         =>   'required|min:5|max:50',
            'email'        =>   'required|email|ends_with:@gmail.com|unique:users',
            'password'     =>   'required|min:5|max:255',
            'confirm_password'  =>  'required|min:5|max:255|same:password'
        ]);

        User::create([
            'name'  =>  $request->input('name'),
            'email' =>  $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'confirm_password' => Hash::make($request->input('confirm_password')),
            'role' => 'member'
        ]);

        // $user = new User;

        // $user->name = $request->input('name');
        // $user->email = $request->input('email');
        // $user->password = Hash::make($request->input('password'));
        // $user->confirm_password = Hash::make($request->input('confirm_password'));
        // $user->role = "member"; 

        // $user->save();

        return redirect('login')->with('success', 'Registration succesfully completed');
    }

    public function validateLogin(Request $request){
        $request->validate([
            'email' =>  'required|ends_with:@gmail.com',
            'password'  =>  'required|min:5|max:255'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            if(Auth::user() -> role == 'member'){
                return redirect()->route('home');
            } else if (Auth::user() -> role == 'admin'){
                return redirect()->route('admin_home');
            }
        } else {
            return redirect('login')->with('fail_message', 'Wrong email address or password');
        }
    }

    public function admin(Request $request){
        if($request->type){
            $type = $request->type;
        } else {
            $type = 'Main Course';
        }

        $food = DB::select('select * from foods where type = ?', [$type]);
        return view('home.admin_home', ['food' => $food, 'type' => $type]);
    }

    public function home(Request $request){
        if($request->type){
            $type = $request->type;
        } else {
            $type = 'Main Course';
        }
            
        $food = DB::select('select * from foods where type = ?', [$type]);
        if(Auth::check()) {
            return view('home.home', ['food' => $food, 'type' => $type]);
        } else {
            return view('home.guest_home', ['food' => $food, 'type' => $type]);
        }
    }

    public function signOut(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}