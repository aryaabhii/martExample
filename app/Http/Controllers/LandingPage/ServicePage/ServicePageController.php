<?php

namespace App\Http\Controllers\LandingPage\ServicePage;

use App\Models\Service;
use App\Models\Merchant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicePageController extends Controller
{
    public function services(){
        $services = Service::all();
        return view('landingpage.services.index', compact('services'));
    }

    public function serviceProviders($slug){
        $service = Service::where('slug',$slug)->first();
        $service_slug = $service->slug;
        $serviceProviders = Merchant::where('category', $service_slug)->with('merchantDetail','shopImages')->get();
        // return($serviceProviders);
        return view('landingpage.services.serviceProviders', compact('serviceProviders', 'service'));
    }
}