<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Merchant;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        return view('merchant.profile.index');
    }

    public function updateMerchantDetails(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string', 'max:255'],
            
        ]);

        $merchant = Merchant::findOrFail(Auth::guard('merchant')->user()->id);
        $merchant->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
                
        $merchant->merchantDetail()->updateOrCreate(
            [
                'merchant_id' => $merchant->id,
            ],
            [
                'about' => $request->about,
                'address' => $request->address,
                'company' => $request->company,
                'twitter' => $request->twitter,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]
        );
        return redirect()->back()->with('message','Profile Updated successfully!');
    }
}