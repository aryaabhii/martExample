<?php

namespace App\Http\Controllers\Merchant\Auth;

use App\Models\Service;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $serviceName = Service::all();
        return view('merchant.auth.register', compact('serviceName'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:merchants'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Merchant::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'category' => $request->category,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('merchant')->login($user);

        return redirect(RouteServiceProvider::MERCHANT_HOME);
    }
}