<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
    * Show User view.     
    */
    public function index(){
        $user = User::with('payment')->get();
        return view('admin.users.index',compact("user"));
    }

    /** 
    * show user view.     
    */
    public function show(Request $request, $id){
        return view('admin.users.show')->with('user',user::find($id));
    }

    /**
    * Destroy the data.
    */
    public function destroy($id){
        user::where('id', $id)->delete();     
        return redirect()->back()->with('message','User Deleted Successfully!');
    }
    
}