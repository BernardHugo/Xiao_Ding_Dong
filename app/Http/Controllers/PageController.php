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

class PageController extends Controller{

    public function logIn(){
        return view('login');
    }

    public function registration(){
        return view('registration');
    }

    public function validateRegistration(Request $request){
        $request->validate([
            'name'         =>   'required|min:5|max:50',
            'email'        =>   'required|email|ends_with:@gmail.com|unique:users',
            'password'     =>   'required|min:5|max:255',
            'confirm_password'  =>  'required|min:5|max:255|same:password',
        ]);

        $data = $request->all();

        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password']),
            'confirm_password' => Hash::make($data['confirm_password']),
            'role' => 'member'
        ]);

        return redirect('login')->with('success', 'Registration complete, you can login');
    }

    public function validateLogin(Request $request){
        $request->validate([
            'email' =>  'required|ends_with:@gmail.com',
            'password'  =>  'required|min:5|max:255'
        ]);

        $credentials = $request->only('email', 'password');

        // if(Auth::attempt($credentials)){
        //     return redirect('home');
        // }

        if(Auth::attempt($credentials)){
            if(Auth::user() -> role == 'member'){
                return redirect()->route('home');
            } else if (Auth::user() -> role == 'admin'){
                return redirect()->route('admin_page');
            }

        } else {
            return redirect()->route('login');
        }
    }

    public function admin(Request $request){
        $foods = DB::select('select * from foods where type = ?', [$request->type]);
        return view('admin', ['foods' => $foods, 'type' => $request->type]);
    }

    public function home(Request $request){
        $foods = DB::select('select * from foods where type = ?', [$request->type]);
        if(Auth::check()) {
            return view('home', ['foods' => $foods, 'type' => $request->type]);
        } else {
            return view('guestHome', ['foods' => $foods, 'type' => $request->type]);
        }
        return redirect('login')->with('success', 'you are not allowed to access home page');
    }

    public function cart(Request $request){
        $cart = DB::table('cart');
        $cartFood = $cart->join('foods', 'foods.id', '=', 'cart.food_id')->where('cart.user_id', '=', $request->user()->id)->get();
        return view('cart', compact('cartFood'));
    }

    public function addToCart(Request $request) {
        DB::insert('insert into cart (food_id, user_id, quantity) values (?, ?, 1)', [$request->input('food_id'), $request->input('user_id')]);
        $foods = DB::select('select * from foods where id = ?', [$request->input('food_id')]);
        return redirect()->action([FoodController::class, 'foodDetail'], ['name' => $foods[0]->name])->with('success', 'Your food has been added to the cart.');
    }

    public function checkout(){
        return view('checkout');
    }

    public function orderCheckout(){
        $validate = $request->validate([
            'full_name' =>  'required|min:5',
            'phone'  =>  'required|digits:12',
            'country'  =>  'required',
            'city'  =>  'required|min:5',
            'card_name'  =>  'required|min:3',
            'card_number'  =>  'required|integer|digits:16',
            'address'  =>  'required|min:5',
            'zip'  =>  'required|integer',
        ]);

        $check = new Checkout;

        $check->full_name = $request->input('full_name');
        $check->phone = $request->input('phone');
        $check->country = $request->input('country');
        $check->city = $request->input('city');
        $check->card_name = $request->input('card_name');
        $check->card_number = $request->input('card_number');
        $check->address = $request->input('address');
        $check->zip = $request->input('zip');

        return redirect('home')->with('success', 'Checkout success');
    }

    public function transactionHistory(){
        return view('transaction');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function destroy($cart_id){
        $cart = Cart::find($cart_id);
        $cart->delete();
        return redirect()->route('cart');
    }

}
