<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Agency $agency)
    {
        $agencies=Agency::latest()->get();
        return view('agency.index',compact('agencies','agency'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'airline_name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip_code'=>'required',
            'country'=>'required',
            'website'=>'nullable',
        ]);

        Agency::create($data);

        return redirect()->back()->with('success',"New Airline saved.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agency=Agency::find($id);
        $agencies=Agency::latest()->get();
        return view('agency.index',compact('agencies','agency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->validate([
            'airline_name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip_code'=>'required',
            'country'=>'required',
            'website'=>'nullable',
        ]);

        Agency::find($id)->update($data);

        return redirect()->route('agency.index')->with('success',"Selected Airline update.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Agency::find($id)->delete();

        return redirect()->route('agency.index')->with('success',"Selected Airline removed.");
    }
}
