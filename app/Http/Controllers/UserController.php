<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(User $user){
        $users=User::latest()->get();
        return view('layouts.user',compact('users','user'));
    }

    public function store(Request $request){
        $data=$request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'dob'=>'required',
            'gender'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
            'contact_number'=>'required',
        ]);

        $user=User::create($data);
        $user->assignRole('admin');

        return redirect()->back()->with('success',"New user saved");
    }

    public function edit($id){
        $user=User::find($id);
        $users=User::latest()->get();
        return view('layouts.user',compact('users','user'));
    }


    public function update(Request $request,$id){
        $data=$request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'dob'=>'required',
            'gender'=>'required',
            'email'=>'required',
            'contact_number'=>'required',
        ]);

        User::find($id)->update($data);

        return redirect()->route('user.index')->with('success',"Selected user updated");
    }

    public function destroy($id){
        User::find($id)->delete();

        return redirect()->back()->with('success',"Selected user removed.");
    }
}
