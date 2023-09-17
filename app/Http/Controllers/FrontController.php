<?php

namespace App\Http\Controllers;

use Amadeus\Amadeus;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    private $amadeus;

    public function __construct()
    {
        $this->amadeus = Amadeus::builder("IyIEHFKtolObKGs3QtjtCA393VpKS2cN", "G8Q4JKsjSjxSvYSX")->build();
    }
    public function index()
    {
        return view('front.home');
    }

    public function list()
    {
        $amadeus = Amadeus::builder("IyIEHFKtolObKGs3QtjtCA393VpKS2cN", "G8Q4JKsjSjxSvYSX")->build();
        $apiUrl = '/v2/shopping/flight-offers?originLocationCode=DEL&destinationLocationCode=BOM&departureDate=2023-09-17&returnDate=2023-09-18&adults=2&nonStop=false&max=100'; // Replace with your API URL
        $response = $amadeus->getClient()->getWithOnlyPath($apiUrl);
        $flightList = $response->getBody();

        session()->put('lists', $flightList);

        $flightList = session()->get('lists');
        $flightList = json_decode($flightList);
        // return $flightList->data[10];
        $flightLists = $flightList->data;
        return view('front.flightList', compact('flightLists'));
    }

    public function detail(Request $request, $amadeus)
    {

        session()->put('filghtData',$amadeus);
        $requestData = [
            'data' => [
                'type' => 'flight-offers-pricing',
                'flightOffers' => [
                    json_decode($amadeus)
                ]
            ]
        ];
        $jsonData = json_encode($requestData);

        try {
            $response = $this->amadeus->getClient()->postWithStringBody("/v1/shopping/flight-offers/pricing?include=detailed-fare-rules,bags", $jsonData);

            if ($response->getStatusCode() === 200) {
                $flightDetail = $response->getBody();
            //     session()->put("test", $flightDetail);
                // $flightDetail = session()->get('test');
                $flightDetail = json_decode($flightDetail);
                // return $flightDetail;
                return view('front.detail', compact('flightDetail'));
            } else {
                return "API request failed.";
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function book(Request $request)
    {
        $travelers = [];

        foreach ($request->first_name as $key => $item) {
            $traveler = [
                "id" => $key + 1,
                "dateOfBirth" => $request->dob[$key],
                "name" => [
                    "firstName" => $request->first_name[$key],
                    "lastName" => $request->last_name[$key],
                ],
                "gender" => $request->gender[$key],
                "documents" => [
                    [
                        "documentType" => "PASSPORT",
                        "number" => $request->password_number[$key],
                        "expiryDate" => $request->expiry_date[$key],
                        "issuanceCountry" => $request->issueCountry[$key],
                        "holder" => true,
                        "nationality" => $request->nationality[$key],
                    ]
                ]
            ];

            $travelers[] = $traveler;
        }

        $flightDetail = session()->get('filghtData');

        $requestData = [
            "data" => [
                "type" => "flight-order",
                "flightOffers" => [
                    json_decode($flightDetail)
                ],
                "travelers" => $travelers,

                "contacts" => [
                    [
                        "addresseeName" => [
                            "firstName" => Auth()->user()->first_name,
                            "lastName" => Auth()->user()->last_name,
                        ],
                        "companyName" => Auth()->user()->first_name,
                        "purpose" => "STANDARD",
                        // "phones" => [
                        //     [
                        //         "deviceType" => "MOBILE",
                        //         "countryCallingCode" => "33",
                        //         "number" => "480080072"
                        //     ]
                        // ],
                        "emailAddress" => Auth()->user()->email,
                        "address" => [
                            "lines" => [
                                $request->address
                            ],
                            "postalCode" => $request->postalCode,
                            "cityName" => $request->city,
                            "countryCode" => $request->country,
                        ]
                    ]
                ]
            ]
        ];
        $jsonData = json_encode($requestData);

        try {

            $response = $this->amadeus->getClient()->postWithStringBody("/v1/booking/flight-orders", $jsonData);

            $flightDetail = $response->getBody();
            $flightDetail = json_decode($flightDetail);
            // session()->put('detail', $flightDetail);

            // $flightDetail = session()->get('detail');
            return view('front.invoice', compact('flightDetail'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
