<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();

        $booking=Booking::create();
        $booking->user_id="1";
        $booking->price=$faker->numberBetween(100,200);
        $booking->price=$faker->price;
        $booking->fromTime=$faker->dateTime();
        $booking->fromIataCode="DEL";
        $booking->toTime=$faker->dateTime();
        $booking->toIataCode="BOM";
        $booking->booking_refrence=$faker->number;
        $booking->booking_id=$faker->number;
        $booking->booking_date=$faker->dateTime();
        $booking->airline=$faker->name;
        $booking->status=$faker->status;

        $booking->save();
    }
}
