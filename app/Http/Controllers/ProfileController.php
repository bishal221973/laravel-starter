<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function index()
    {
        return view('layouts.profile');
    }

    public function changeProfile(Request $request)
    {

        if ($request->hasfile('image')) {
            $user = User::find(Auth()->user()->id);

            if ($user->image != null) {
                Storage::delete($user->image);
            }

            $data['image'] = $request->file('image')->store();
            $user->update($data);
        }

        return redirect()->back()->with('success', "Profile changed successfully.");
    }

    public function changeCover(Request $request)
    {

        if ($request->hasfile('cover')) {
            $user = User::find(Auth()->user()->id);

            if ($user->cover != null) {
                Storage::delete($user->cover);
            }

            $data['cover'] = $request->file('cover')->store();
            $user->update($data);
        }

        return redirect()->back()->with('success', "Profile changed successfully.");
    }


    public function changePassword(Request $request)
    {
        $customMessages = [
            'password.regex' => 'Password must contain uppercase, lowercase, special character and number.',
            // Other custom messages
        ];
        $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ], $customMessages);
        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'Password updated successfully');
        } else {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }
    }

    public function forgetPassword()
    {
        return view('layouts.forgetPassword');
    }

    public function getCode()
    {
        $email = Auth()->user()->email;


        $otp = rand(000000, 999999);
        $oldOtp = OTP::where('email', $email)->first();

        if (!$oldOtp) {
            OTP::create([
                'email' => $email,
                'otp' => $otp
            ]);
            $data['email'] = $email;
            $data['otp'] = $otp;

            $code = ['otp' => $otp];
            $sent = Mail::send('layouts.securityCode', $code, function ($message) use ($data) {
                $message->to($data['email']);
                $message->subject("Verify email");
            });

            if ($sent) {
                $status = "success";
                return view('layouts.getCode', compact('status', 'email'));
            }
        }
        $status = "fail";
        return view('layouts.getCode', compact('status', 'email'));
    }

    public function updatePassword(Request $request)
    {
        $otp = OTP::where('email', Auth()->user()->email)->first();

        if (!$otp) {
            return redirect()->back()->with('error', "Your OTP is expired. We send new email please check your email.");
        }

        if ($otp->otp == $request->code) {
            return view("layouts.changePassword");
        }
        return redirect()->back()->with('error', "Your OTP is not matched.");
    }

    public function updateMyPassword(Request $request)
    {
        $customMessages = [
            'password.regex' => 'Password must contain uppercase, lowercase, special character and number.',
            // Other custom messages
        ];
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ], $customMessages);
        $user = Auth::user();

        if ($request->email) {
            User::where('email',$request->email)->first()->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('login')->with('success', 'Password updated successfully');

        }
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('home')->with('success', 'Password updated successfully');
    }
}
