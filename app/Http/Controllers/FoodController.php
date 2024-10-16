<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller {
    public function adminFoodDetail(Request $request){
        $food = DB::select('select * from foods where name = ?', [$request->name]);
        return view('foods.admin_food_detail', ['food' => $food, 'name' => $request->name]);
    }

    public function foodDetail(Request $request){
        $food = DB::select('select * from foods where name = ?', [$request->name]);
        if(Auth::check()) {
            return view('foods.food_detail', ['food' => $food, 'name' => $request->name, 'user' => $request->user()->id]);
        } else {
            return view('foods.food_detail', ['food' => $food, 'name' => $request->name]);
        }
    }

    public function addFood() {
        return view('foods.add_food');
    }

    public function editFood(Request $request) {
        $food = DB::select('select * from foods where id = ?', [$request->id]);
        return view('foods.update_food', ['food' => $food, 'id' => $request->id]);
    }

    public function storeFood(Request $request) {
        $request->validate([
            'name' => 'required|min:5',
            'brief_description' => 'required|max:100',
            'about'   => 'required|min:5|max:255',
            'type'     =>   'required|in:Main Course,Dessert,Beverage',
            'price' => 'required|integer|min:1',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);

        $food = new Food;

        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('public/images', $imageName);
        $food->image = $imageName;

        $food->name = $request->input('name');
        $food->type = $request->input('type');
        $food->price = $request->input('price');
        $food->brief_description = $request->input('brief_description');
        $food->about = $request->input('about');

        $food->save();
        return redirect()->back()->with('success','Food has been added successfully');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|min:5',
            'brief_description' => 'required|max:100',
            'about'   => 'required|min:5|max:255',
            'type'     =>   'required|in:Main Course,Dessert,Beverage',
            'price' => 'required|integer|min:1',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);

        $food = Food::find($id);

        $image = $request->file('image');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('public/images', $imagename);
        $food->image = $imagename;

        $food->name = $request->input('name');
        $food->type = $request->input('type');
        $food->price = $request->input('price');
        $food->brief_description = $request->input('brief_description');
        $food->about = $request->input('about');

        $food->update();
        return redirect()->back()->with('success', 'Food has been updated successfully');
    }

    public function searchFood(Request $request){
        $search = $request->input('search');

        $main_course = $request->input('main_course');
        $beverage = $request->input('beverage');
        $dessert = $request->input('dessert');

        if(!$main_course && !$beverage && !$dessert) {
            $main_course = True;
            $beverage = True;
            $dessert = True;
        } 

        $in_type = [];

        if($main_course) {
            array_push($in_type, "Main Course");
        } 
        
        if($beverage) {
            array_push($in_type, "Beverage");
        }

        if($dessert) {
            array_push($in_type, "Dessert");
        }

        $food = Food::where('name', 'LIKE', '%' . $search . '%')->whereIn('type', $in_type)->get();

        return view('foods.search_food')->with('food', $food)->with('main_course', $main_course)->with('beverage', $beverage)->with('dessert', $dessert);
    }

    public function manageFood(Request $request){
        $search = $request->input('search');

        $main_course = $request->input('main_course');
        $beverage = $request->input('beverage');
        $dessert = $request->input('dessert');

        if(!$main_course && !$beverage && !$dessert) {
            $main_course = True;
            $beverage = True;
            $dessert = True;
        } 

        $in_type = [];

        if($main_course) {
            array_push($in_type, "Main Course");
        } 
        
        if($beverage) {
            array_push($in_type, "Beverage");
        }

        if($dessert) {
            array_push($in_type, "Dessert");
        }

        $food = Food::where('name', 'LIKE', '%' . $search . '%')->whereIn('type', $in_type)->get();

        return view('foods.manage_food')->with('food', $food)->with('main_course', $main_course)->with('beverage', $beverage)->with('dessert', $dessert);
    }

    public function destroy($id) {
        $food = Food::find($id);
        $food->delete();
        return redirect()->route('manage_food')->with('success', 'Food has been deleted successfully');
    }
}