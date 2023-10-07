<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(Service $service){
        $services=Service::latest()->get();
        return view('service.index',compact('service','services'));
    }

    public function store(Request $request){
        $data=$request->validate([
            'name'=>'required',
            'image'=>'required',
            'description'=>'required',
        ]);

        if($request->hasFile('image')){
            $data['image']=$request->file('image')->store();
        }

        Service::create($data);

        return redirect()->back()->with('success',"New Service saved.");
    }

    public function edit(string $id){
        $service=Service::find($id);
        $services=Service::latest()->get();
        return view('service.index',compact('service','services'));
    }

    public function update(Request $request,$id){
        $service=Service::find($id);
        $data=$request->validate([
            'name'=>'required',
            'image'=>'nullable',
            'description'=>'required',
        ]);

        if($request->hasFile('image')){
            if($service->image){
                Storage::delete($service->image);
            }
            $data['image']=$request->file('image')->store();
        }

        $service->update($data);

        return redirect()->route('servece.index')->with('success',"Selected Service updated.");
    }

    public function deletes($id){
        // return $id;
        Service::find($id)->delete();

        return redirect()->back()->with('success',"Selected service removed.");
    }
}
