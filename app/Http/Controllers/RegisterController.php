<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request){
        $data=$request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
        ]);

        $user=User::create($data);
        $user->assignRole("user");

        return redirect('/login')->with('success',"Register success");

    }

    public function profile(){
        return view('front.profile');
    }

    public function myBookings(){
        return view('front.myBookings');
    }
}
