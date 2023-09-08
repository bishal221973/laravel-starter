<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use Illuminate\Http\Request;

class OTPController extends Controller
{
    public function delete($email)
    {
        OTP::where('email',$email)->delete();

        return;
    }
}
