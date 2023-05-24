<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchant;

class MerchantController extends Controller
{
    /**
    * Display index page.
    */
    public function index(){
        $data = merchant::all();
        return view('admin.merchant.index',compact("data"));
    }

    /**
    * show Merchant view.     
    */
    public function show(Request $request, $id){
        return view('admin.merchant.show')->with('merchant',merchant::find($id));
    }


    /**
    * Destroy the data.
    */
    public function destroy($id){
        merchant::where('id', $id)->delete();     
        return redirect()->back()->with('message','Merchat Deleted Successfully!');
    }
}