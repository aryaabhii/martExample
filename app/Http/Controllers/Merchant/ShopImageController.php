<?php

namespace App\Http\Controllers\Merchant;

use App\Models\ShopImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShopImageController extends Controller
{
    public function index(){
        $image = ShopImage::all();
        return view('merchant.shopImages.index', compact('image'));
    }

    public function store(Request $request){
    $merchant = Auth::guard('merchant')->user();
    $imageUpload = new ShopImage();
        if($request->hasFile('image')) {
            $file= $request->file('image');
            $allowedfileExtension=['JPEG','jpg','png','pdf'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension,$allowedfileExtension);
            if($check){
                $file_path = public_path('/uploads/merchant/shopImage/'.$imageUpload->image);
                if(file_exists($file_path) && $imageUpload->image != '')
                {
                    unlink($file_path);
                }
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $filename = substr(str_shuffle(str_repeat($pool, 5)), 0, 12) .'.'.$extension;
                $path = $file->move(public_path('/uploads/merchant/shopImage/'), $filename);
                $imageUpload->image = $filename;
            }
        }
        $imageUpload->merchant_id = $merchant->id;
        $imageUpload->save();
        return redirect()->back()->with('message','Image Uploaded successfully!');
    } 

    /**
    * Destroy the data.
    */
    public function destroy($id){
        ShopImage::where('id', $id)->delete();     
        return redirect()->back()->with('message','Shop Image Deleted Successfully!');
    }
}