<?php

namespace App\Http\Controllers;

use App\Exports\BookingExport;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function report()
    {
       $reports = Booking::latest()->with('user')->get();
        // $bookings = DB::table('bookings')
        //     ->select('*')
        //     ->join('users', 'users.id', '=', 'bookings.user_id');

        // $bookings = $bookings->latest()->get()->toArray();

        // $reports = $bookings;
        return view('layouts.report', compact('reports'));
    }
    public function reportFilter(Request $request)
    {
        $bookings = [];
        // return $request;
        $bookings = DB::table('bookings')
            ->select('*')
            ->join('users', 'users.id', '=', 'bookings.user_id');

        // $bookings=Booking::with('user');

        if ($request->customer) {

            $bookings = $bookings->where('users.first_name', 'like', '%' . $request->customer . '%')->orwhere('users.last_name', 'like', '%' . $request->customer . '%')->orwhere('users.email', 'like', '%' . $request->customer . '%');
        }
        if ($request->origin) {
            $bookings = $bookings->where('fromIataCode', 'like', '%' . $request->origin . '%');
        }
        if ($request->destination) {

            $bookings = $bookings->where('toIataCode', 'like', '%' . $request->destination . '%');
        }
        if ($request->departureTime && !$request->arrivalTime) {
            $bookings = $bookings->where('fromTime', '>=', $request->departureTime);
        }
        if (!$request->departureTime && $request->arrivalTime) {
            $bookings = $bookings->where('toTime', '<=', $request->arrivalTime);
        }
        if ($request->departureTime && $request->arrivalTime) {
            $bookings = $bookings->where('fromTime', '>=', $request->departureTime)->where('toTime', '<=', $request->arrivalTime);
        }
        if ($request->bookingId) {

            $bookings = $bookings->where('booking_id', 'like', '%' . $request->bookingId . '%');
        }
        if ($request->status) {

            $bookings = $bookings->where('status', 'like', '%' . $request->status . '%');
        }
        $bookings = $bookings->get()->toArray();

        $reports = $bookings;
        return view('layouts.report', compact('reports'));
    }

    public function exportExcel(Request $request){
        return Excel::download(new BookingExport($request), 'booking.xlsx');
    }
}
