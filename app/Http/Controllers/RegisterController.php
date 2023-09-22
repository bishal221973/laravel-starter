<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Amadeus\Amadeus;
use Barryvdh\DomPDF\Facade\Pdf;
class RegisterController extends Controller
{
    private $amadeus;

    public function __construct()
    {
        $this->amadeus = Amadeus::builder("IyIEHFKtolObKGs3QtjtCA393VpKS2cN", "G8Q4JKsjSjxSvYSX")->build();
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create($data);
        $user->assignRole("user");

        return redirect('/login')->with('success', "Register success");
    }

    public function dashboard()
    {
        return view('front.profile.dashboard');
    }

    public function myBookings()
    {
        return view('front.myBookings');
    }
    public function myBooking()
    {
        return view('front.profile.bookings');
    }
    public function myProfile()
    {
        return view('front.profile.profile');
    }

    public function pdf($id)
    {
        // $apiUrl = "/v1/booking/flight-orders/" . $id;
        // $response = $this->amadeus->getClient()->getWithOnlyPath($apiUrl);
        // $flightList = $response->getBody();

        // session()->put('lists', $flightList);

        $flightDetail = session()->get('lists');
        // $flightDetail = json_decode($flightDetail);

        $pdf = Pdf::loadView('front.pdf.invoice', ['flightDetail' => $flightDetail]);
        // return $pdf->download('invoice.pdf');
        return $pdf->stream();
    }
}
