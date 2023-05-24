<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Admin\Auth;

class ProfileController extends Controller
{
    /**
    * Show profile view.     
    */
    public function index(){
        $data = admin::all();
        return view('admin.profile.index', compact('data'));
    }


    /**
    * Update Admin data in database.    
    */
    public function update(Request $request, $id){
        $data=admin::find($id);
        $profile_image = $request->profile_image;
        if($profile_image)
        {
            //below code help to save the images and provide a special name for our images.
            $profile_imagename=time().'.'.$profile_image->getClientOriginalExtension();
                $request->profile_image->move('uploads/admin/profile_image',$profile_imagename);
                $data->profile_image=$profile_imagename;
        }
        $data->about=$request->about;
        $data->name=$request->name;
        $data->designation=$request->designation;
        $data->email=$request->email;
        $data->company=$request->company;
        $data->country=$request->country;
        $data->address=$request->address;
        $data->phone=$request->phone;
        $data->wp_number=$request->wp_number;
        $data->twitter=$request->twitter;
        $data->facebook=$request->facebook;
        $data->linkedin=$request->linkedin;
        $data->instagram=$request->instagram;
        $data->update();
        return redirect()->back()->with('message','Admin Data Updated Successfully!');
    }
}