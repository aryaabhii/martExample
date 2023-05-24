<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UploadBill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{

    /**
    * Display the service page view.
    */
    public function index(){
        return view('user.bill.index');
    }

    // upload bill
    public function uploadBill(){
        return view('user.bill.upload_bill');
    }
    
    public function store(Request $request){
    $user = Auth::User();
    $billUpload = new UploadBill();
        if($request->hasFile('image')) {
            $file= $request->file('image');
            $allowedfileExtension=['JPEG','jpg','png','pdf'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension,$allowedfileExtension);
            if($check){
                $file_path = public_path('/uploads/user/bill/'.$billUpload->image);
                if(file_exists($file_path) && $billUpload->image != '')
                {
                    unlink($file_path);
                }
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $filename = substr(str_shuffle(str_repeat($pool, 5)), 0, 12) .'.'.$extension;
                $path = $file->move(public_path('/uploads/user/bill/'), $filename);
                $billUpload->image = $filename;
            }
        }
        $billUpload->user_id = $user->id;
        $billUpload->save();
        return redirect()->back()->with('message','Bill Uploaded successfully!');
    } 

    /**
    * show Bill view.     
    */
    public function show(Request $request, $id){
        return view('user.bill.view')->with('image',UploadBill::find($id));
    }

    /**
    * Destroy the data.
    */
    public function destroy($id){
        UploadBill::where('id', $id)->delete();     
        return redirect()->back()->with('message','Bill Deleted Successfully!');
    }
}