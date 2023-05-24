<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandingPage\Enquiry;

class EnquriesController extends Controller
{
    /**
    * Code for enquiry on dashboard
    */
    public function enqueires(){
        $data = enquiry::all();
        return view('admin.enqueries.index',compact("data"));
    }

    /**
    * Destroy the data.
    */
    public function destroy($id){
        enquiry::where('id', $id)->delete();     
        return redirect()->back()->with('message','Message Deleted Successfully!');
    }
}