<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandingPage\Enquiry;

class HomeController extends Controller
{
    public function index(){  
        return view('merchant.dashboard');
    }
}