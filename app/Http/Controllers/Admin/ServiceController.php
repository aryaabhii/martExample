<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ServiceController extends Controller
{
    /**
    * Display the service page view.
    */
    public function index(){
        $data =  Service::all();
        return view('admin.services.index', compact("data"));
    }

    public function generateSlug(){
       $this->slug = SlugService::createSlug(Service::class, 'slug', $this->title);
    }

    public $slug;
        
    /**
    * Store Services data in database.    
    */
    public function store(Request $request){
        $data = new service;
        $image = $request->image;
        //below code help to save the images and provide a special name for images.
        $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('uploads/service',$imagename);
        $data->image=$imagename;
        $data->title=$request->title;
        $data->slug=$this->slug;
        $data->description=$request->description;
        $data->save();
        return redirect()->back()->with('message','Service Data Added Successfully!');
    }

    /**
    * Edit View Services.    
    */
    public function modify(Request $request, $id){
        return view('admin.services.edit')->with('service',service::find($id));
    }
    
    /**
    * Update Services data in database.    
    */
    public function update(Request $request, $id){
        $data=service::find($id);
        $image = $request->image;
        if($image)
        {
            //below code help to save the images and provide a special name for our images.
            $imagename=time().'.'.$image->getClientOriginalExtension();
                $request->image->move('uploads/service',$imagename);
                $data->image=$imagename;
        }
        $data->title=$request->title;
        $data->slug=$this->slug;
        $data->description=$request->description;
        $data->update();
        return redirect()->back()->with('message','Service Data Updated Successfully!'); 
    }

    /**
    * show Services view.     
    */
    public function show(Request $request, $id){
        return view('admin.services.show')->with('service',service::find($id));
    }

    /**
    * Destroy the data.
    */
    public function destroy($id){
        service::where('id', $id)->delete();     
        return redirect()->back()->with('message','Service Data Deleted Successfully!');
    }
}