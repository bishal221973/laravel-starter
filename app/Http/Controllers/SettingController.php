<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use App\Models\District;
use App\Models\Municipality;
use App\Models\OTP;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $countries = Country::latest()->get();
        $provinces = Province::latest()->get();
        $districts = District::latest()->get();
        $municipalities = Municipality::latest()->get();
        $address = Address::where('user_id', Auth()->user()->id)->with(['country', 'province', 'district', 'municipality'])->first();
        return view('setting.setting', compact('countries', 'provinces', 'districts', 'municipalities', 'address'));
    }

    public function personalDetail(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'dob' => 'nullable',
            'gender' => 'nullable',
        ]);

        $user = Auth()->user();

        $user->update($data);

        return redirect()->back()->with('success', "Personal detail changed.");
    }

    public function changeEmail(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        $data['email_verified_at'] = " ";
        $user = Auth()->user();
        $user->update([
            'email' => $request->email,
            'email_verified_at' => "2000-01-01",
        ]);

        return redirect()->back()->with('success', "Your email changed. Please verify your email.");
    }

    public function changePhone(Request $request)
    {
        $data = $request->validate([
            'contact_number' => 'required|numeric',
        ]);
        $user = Auth()->user();
        $user->update($data);

        return redirect()->back()->with('success', "Your phone number changed.");
    }

    public function selectProvince($id)
    {
        $provinces = Province::where('country_id', $id)->latest()->get();

        return response()->json([
            'data' => $provinces,
        ]);
    }

    public function selectDistrict($id)
    {
        $districts = District::where('province_id', $id)->latest()->get();

        return response()->json([
            'data' => $districts,
        ]);
    }

    public function selectMunicipality($id)
    {
        $municipalities = Municipality::where('district_id', $id)->latest()->get();

        return response()->json([
            'data' => $municipalities,
        ]);
    }

    public function changeAddress(Request $request)
    {
        $user = User::where('id', Auth()->user()->id)->with('address')->first();

        if ($user->address) {
            $data = $request->validate([
                'country_id' => 'nullable',
                'province_id' => 'nullable',
                'district_id' => 'nullable',
                'municipality_id' => 'nullable',
                'ward_no' => 'nullable',
                'tole' => 'nullable',
            ]);
            Address::where('user_id', $user->id)->first()->update([
                'country_id' => $request->country_id,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'municipality_id' => $request->municipality_id,
                'ward_no' => $request->ward_no,
                'tole' => $request->tole,
            ]);
            return redirect()->back()->with('success', "Address changed...");
        } else {
            Address::create([
                'user_id' => $user->id,
                'country_id' => $request->country_id,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'municipality_id' => $request->municipality_id,
                'ward_no' => $request->ward_no,
                'tole' => $request->tole,
            ]);

            return redirect()->back()->with('success', "Address changed");
        }
    }

    public function verifyEmail()
    {
        return view('setting.verifyEmail');
    }

    public function verifyCode()
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
                return view('setting.verifyCode', compact('status', 'email'));
            }
        }
        $status = "fail";
        return view('setting.verifyCode', compact('status', 'email'));
    }

    public function verifyEmailCode(Request $request)
    {
        $otp = OTP::where('email', Auth()->user()->email)->first();

        if (!$otp) {
            return redirect()->back()->with('error', "Your OTP is expired. We send new email please check your email.");
        }

        if ($otp->otp == $request->code) {
            $user = Auth()->user();
            $user->update([
                'email_verified_at' => now(),
            ]);
            return redirect()->route("setting.index")->with("success", "Email Verified");
            // return view("layouts.changePassword");
        }
        return redirect()->back()->with('error', "Your OTP is not matched.");
    }

    public function appSetting(Request $request)
    {
        if ($request->short_name) {
            settings()->set("short_name", $request->short_name);
        }
        if ($request->full_name) {
            settings()->set("full_name", $request->full_name);
        }
        // return $request;
        if ($request->hasfile('logo')) {
            // if ($user->image != null) {
            // }
            if (settings()->get('logo')) {
                Storage::delete(settings()->get('logo'));
            }

            $data['logo'] = $request->file('logo')->store();
            // return $data;
            settings()->set("logo", $data['logo']);
        }

        return redirect()->back()->with('success', "App setting changed.");
    }

    public function mailSetting(Request $request)
    {
        $request->validate([
            'mail_transport' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from' => 'required',
            'mail_from_name' => 'required',
        ]);

        settings()->set([
            'mail_transport' => $request->mail_transport,
            'mail_host' => $request->mail_host,
            'mail_port' => $request->mail_port,
            'mail_username' => $request->mail_username,
            'mail_password' => $request->mail_password,
            'mail_encryption' => $request->mail_encryption,
            'mail_from' => $request->mail_from,
            'mail_from_name' => $request->mail_from_name,
        ]);

        return redirect()->back()->with('success', "Mail setting changed.");
    }

    public function orgSetting(Request $request)
    {
        if ($request->org_name) {
            settings()->set("org_name", $request->org_name);
        }
        if ($request->org_email) {
            settings()->set("org_email", $request->org_email);
        }
        if ($request->org_contact) {
            settings()->set("org_contact", $request->org_contact);
        }
        if ($request->org_address) {
            settings()->set("org_address", $request->org_address);
        }

        return redirect()->back()->with('success', "Mail setting changed.");


    }
}
