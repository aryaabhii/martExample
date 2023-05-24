<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyCardController extends Controller
{
    public function index(){
        $user = User::with('payment')->get();
        return view('user.card.index', compact('user'));
    }
}