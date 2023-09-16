<?php

namespace App\Http\Controllers;

use Amadeus\Amadeus;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        return view('front.home');
    }

    public function list(){
        // $amadeus = Amadeus::builder("IyIEHFKtolObKGs3QtjtCA393VpKS2cN", "G8Q4JKsjSjxSvYSX")->build();
        // $apiUrl = '/v2/shopping/flight-offers?originLocationCode=DEL&destinationLocationCode=BOM&departureDate=2023-09-16&returnDate=2023-09-17&adults=1&nonStop=false&max=100'; // Replace with your API URL
        // $response = $amadeus->getClient()->getWithOnlyPath($apiUrl);
        // $flightList = $response->getBody();

        // session()->put('lists', $flightList);

        $flightList = session()->get('lists');
        $flightList = json_decode($flightList);
// return $flightList->data[10];
        $flightLists=$flightList->data;
        return view('front.flightList',compact('flightLists'));
    }
}
