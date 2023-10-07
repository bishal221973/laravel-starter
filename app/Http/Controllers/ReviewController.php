<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Review $review){
        $reviews=Review::latest()->get();
        return view('layouts.review',compact('reviews','review'));
    }
    public function store(Request $request){
        Review::create($request->validate([
            'name'=>'required',
            'rating'=>'required',
            'comment'=>'required',
        ]));

        return redirect()->back()->with('success',"Review Saved.");
    }

    public function edit($id){
        $review=Review::find($id);
        $reviews=Review::latest()->get();
        return view('layouts.review',compact('reviews','review'));
    }

    public function update(Request $request, $id){
        $review=Review::find($id);
        $review->update($request->validate([
            'name'=>'required',
            'comment'=>'required',
        ]));

        return redirect()->route('reviews.index')->with('success',"Review updated.");
    }

    public function delete($id){
        Review::find($id)->delete();

        return redirect()->back()->with('success',"Selected comment removed.");
    }
}
