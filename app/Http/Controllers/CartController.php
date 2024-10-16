<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use DateTime;
use DateTimeZone;
use App\Models\User;
use App\Models\Food;
use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FoodController;

class CartController extends Controller{
    public function cart(Request $request){
        $cart = DB::table('cart');
        $cartFood = $cart->join('foods', 'foods.id', '=', 'cart.food_id')->where('cart.user_id', '=', $request->user()->id)->where('cart.is_paid', '=', 0)->get();
        return view('cart.cart', compact('cartFood'));
    }

    public function addToCart(Request $request) {
        $food = DB::select('select * from foods where id = ?', [$request->input('food_id')]);
        $cart = Cart::where('food_id', $request->input('food_id'))->where('user_id', $request->input('user_id'))->where('is_paid', '=', '0')->first();

        if($cart) {
            $cart->quantity = $cart->quantity + 1;
            $cart->update();
        } else {
            DB::insert('insert into cart (food_id, user_id, quantity) values (?, ?, 1)', [$request->input('food_id'), $request->input('user_id')]);
        }
        return redirect()->action([FoodController::class, 'foodDetail'], ['name' => $food[0]->name])->with('success', 'Foods are successfully added to the cart.');
    }

    public function plusQuantity($id) {
        $cart = Cart::find($id);
        $cart->quantity = $cart->quantity + 1;
        $cart->update();

        return redirect()->route('cart');
    }

    public function minusQuantity($id){
        $cart = Cart::find($id);
        if($cart->quantity > 1) {
            $cart->quantity = $cart->quantity - 1;
            $cart->update();
        }
        return redirect()->route('cart');
    }

    public function checkout() {
        return view('cart.checkout');
    }

    public function orderCheckout(Request $request){
        $request->validate([
            'full_name' =>  'required|min:5',
            'phone'  =>  'required|digits:12',
            'country'  =>  'required',
            'city'  =>  'required|min:5',
            'card_name'  =>  'required|min:3',
            'card_number'  =>  'required|integer|digits:16',
            'address'  =>  'required|min:5',
            'zip'  =>  'required|integer',
        ]);

        $check = Cart::where('user_id', $request->user()->id)->where('cart.is_paid', '=', 0);
        
        $checkout_date = new DateTime();
        $timezone = new DateTimeZone('Asia/Jakarta');
        $checkout_date->setTimezone($timezone);

        Cart::where('user_id', $request->user()->id)->where('cart.is_paid', '=', 0)->update(['is_paid' => 1, 'updated_at' => $checkout_date]);
        return redirect()->route('home')->with('success', 'Transaction success');
    }

    public function transactionHistory(Request $request) {
        $cart = DB::table('cart');
        $cartTrans = $cart->join('foods', 'foods.id', '=', 'cart.food_id')->where('cart.user_id', '=', $request->user()->id)->where('cart.is_paid', '=', 1)->get();
        return view('transaction.history')->with('cartTrans', $cartTrans);
    }

    public function destroy($id) {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->route('cart');
    }
}
