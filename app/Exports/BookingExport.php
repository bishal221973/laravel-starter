<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
class BookingExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function collection()
    {
        $bookings = [];
        // return $request;
        $bookings = DB::table('bookings')
            ->select('*')
            ->join('users', 'users.id', '=', 'bookings.user_id');

        // $bookings=Booking::with('user');

        if ($this->request->customer) {

            $bookings = $bookings->where('users.first_name', 'like', '%' . $this->request->customer . '%')->orwhere('users.last_name', 'like', '%' . $this->request->customer . '%')->orwhere('users.email', 'like', '%' . $this->request->customer . '%');
        }
        if ($this->request->origin) {
            $bookings = $bookings->where('fromIataCode', 'like', '%' . $this->request->origin . '%');
        }
        if ($this->request->destination) {

            $bookings = $bookings->where('toIataCode', 'like', '%' . $this->request->destination . '%');
        }
        if ($this->request->departureTime && !$this->request->arrivalTime) {
            $bookings = $bookings->where('fromTime', '>=', $this->request->departureTime);
        }
        if (!$this->request->departureTime && $this->request->arrivalTime) {
            $bookings = $bookings->where('toTime', '<=', $this->request->arrivalTime);
        }
        if ($this->request->departureTime && $this->request->arrivalTime) {
            $bookings = $bookings->where('fromTime', '>=', $this->request->departureTime)->where('toTime', '<=', $this->request->arrivalTime);
        }
        if ($this->request->bookingId) {

            $bookings = $bookings->where('booking_id', 'like', '%' . $this->request->bookingId . '%');
        }
        if ($this->request->status) {

            $bookings = $bookings->where('status', 'like', '%' . $this->request->status . '%');
        }
        $bookings = $bookings->get();

       return $bookings;
    }

    function headings(): array
    {
        return [
            'SN',
            'Departure Time',
            'Departure',
            'Arrival Time',
            'Arrival',
            'Booking Refrence',
            'Booking ID',
            'Booking Date',
            'Airline',
            'Status',
            'Price',
        ];
    }
}
