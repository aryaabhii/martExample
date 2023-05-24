<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(){
        return view('user.profile.index');
    }

    public function update(){
        return view('user.profile.edit');
    }

    public function updateUserDetails(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string', 'max:255'],
            
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
        
        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'address' => $request->address,
            ]
        );

        return redirect()->back()->with('message','Profile Updated successfully!');
    }
}