<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(){
        $reports=Booking::latest()->get();
        return view('layouts.report',compact('reports'));
    }
}
