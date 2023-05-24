<?php

namespace App\Http\Controllers\User\Payment;

use App\Models\User;
use App\Models\Order;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RazorPayController extends Controller
{

    public function index(){
        return view('user.payment.index');
    }

    public function Check(Request $request){
        $amount =  $request->input('amount');
        $fullName = $request->input('fullName');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');
        return response()->json([
            'amount' => $amount,
            'fullName' => $fullName,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
        ]);
    }   

    public function store(Request $request){
        $order = new order();
        $order -> user_id = Auth::id();
        $order -> amount =  $request->input('amount');
        $order -> fullName = $request->input('fullName');
        $order -> phone = $request->input('phone');
        $order -> email = $request->input('email');
        $order -> address = $request->input('address');
        $order -> tracking_no = rand(1111111,9999999);
        $order -> payment_mode = $request->input('payment_mode');
        $order -> payment_id = $request->input('payment_id');
        $order -> card_number = rand(111111111111,999999999999);
        $order->save();   
        if($request->input('payment_mode') == "Paid by Razorpay"){
            return response()->json(['status' => "Card payment success!"]);
        }
    }
}