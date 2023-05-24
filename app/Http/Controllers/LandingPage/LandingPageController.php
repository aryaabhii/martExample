<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\LandingPage\Enquiry;

class LandingPageController extends Controller
{
    public function index(){
        $services = Service::orderBy('title','ASC')->get();
        return view('landingpage.index',compact('services'));
    }

    public function about(){
        $admin = Admin::all();
        return view('landingpage.about',compact('admin'));
    }

    public function contact(){
        return view('landingpage.contact');
    }

    // Store Enqueries.
    public function message(Request $request){
        $data = new Enquiry;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->subject=$request->subject;
        $data->description=$request->description;
        $data->save();
        return redirect()->back()->with('message','Thank You! for Contacting us. Our team will get back to you soon.');
    }

    public function overview(){
        return view('landingpage.overview');
    }
    
    public function privacyPolicy(){
        return view('landingpage.privacy_policy');
    }

    public function termOfService(){
        return view('landingpage.term_of_service');
    }
}