<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandingPage\Enquiry;
use App\Models\Service;
use App\Models\Merchant;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $enquiry = enquiry::all();
        $enquiry_count = enquiry::count();

        $service = service::all();
        $service_count = service::count();

        $merchant = merchant::all();
        $merchant_count = merchant::count();

        $user_count = user::count();
        
        return view('admin.dashboard',compact("enquiry","enquiry_count","service","service_count", "merchant","merchant_count","user_count"));
    }
}