<?php

namespace App\Http\Controllers;

use Amadeus\Amadeus;
use App\Models\Booking;
use App\Models\Traveller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Http;

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

    public function list(Request $request)
    {
        if ($request->returnTime == "") {
            $apiUrl = '/v2/shopping/flight-offers?originLocationCode=' . $request->depart . '&destinationLocationCode=' . $request->destination . '&departureDate=' . $request->departTime . '&adults=' . $request->adult . '&nonStop=false&max=100'; // Replace with your API URL
        } else {
            $apiUrl = '/v2/shopping/flight-offers?originLocationCode=' . $request->depart . '&destinationLocationCode=' . $request->destination . '&departureDate=' . $request->departTime . '&returnDate=' . $request->returnTime . '&adults=' . $request->adult . '&children=' . $request->child . '&infants=' . $request->infants . '&nonStop=false&max=100'; // Replace with your API URL
        }

        try {
            $response = $this->amadeus->getClient()->getWithOnlyPath($apiUrl);
            $flightList = $response->getBody();

            // session()->put('lists', $flightList);

            // $flightList = session()->get('lists');
            $flightList = json_decode($flightList);
            $flightLists = $flightList->data;
            return view('front.flightList', compact('flightLists'));
        } catch (Exception $e) {
            $fullResponse = $e->getMessage();
            $jsonStart = strpos($fullResponse, '{');
            $jsonEnd = strrpos($fullResponse, '}');

            if ($jsonStart !== false && $jsonEnd !== false) {
                $jsonString = substr($fullResponse, $jsonStart, $jsonEnd - $jsonStart + 1);
                $errorResponse = json_decode($jsonString, true);

                if (isset($errorResponse['errors'])) {
                    $errors = $errorResponse['errors'];
                    return redirect()->back()->with('error', $errors);
                }
            }
        }
    }

    public function detail(Request $request, $amadeus)
    {

        session()->put('filghtData', $amadeus);
        return redirect()->route('front.showDetails');
    }

    public function showDetails()
    {
        $amadeus = session()->get('filghtData');
        if (!$amadeus) {
            return redirect()->back()->with('sessionExpire', "Your session is expired.");
        }
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
                // $flightDetail=session()->get('json');
                $flightDetail = json_decode($flightDetail);
                return view('front.detail', compact('flightDetail'));
            } else {
                return "API request failed.";
            }
        } catch (Exception $e) {
            $fullResponse = $e->getMessage();
            $jsonStart = strpos($fullResponse, '{');
            $jsonEnd = strrpos($fullResponse, '}');

            if ($jsonStart !== false && $jsonEnd !== false) {
                $jsonString = substr($fullResponse, $jsonStart, $jsonEnd - $jsonStart + 1);
                $errorResponse = json_decode($jsonString, true);

                if (isset($errorResponse['errors'])) {
                    $errors = $errorResponse['errors'];
                    return redirect()->back()->with('error', $errors);
                }
            }
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
                    "middleName" => $request->first_name[$key],
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

        $flightData = json_decode($flightDetail);

        $departure = "";
        $destination = "";
        $firstIteration = true; // Initialize a variable to track the first iteration

        foreach ($flightData->itineraries[0]->segments as $segment) {
            if ($firstIteration) {
                $departure = $segment->departure;
                $firstIteration = false; // Mark the first iteration as completed
            } else {
                // Assuming you want the destination of the last segment
                $destination = $segment->arrival;
            }
        }




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

            // $response = $this->amadeus->getClient()->postWithStringBody("/v1/booking/flight-orders", $jsonData);

            // $flightDetail = $response->getBody();
            // $flightDetail = json_decode($flightDetail);
            // session()->put('detail', $flightDetail);

            // return $flightData->itineraries[0]->segments;
            $flightDetail = session()->get('detail');
            $booking = Booking::create([
                'user_id' => Auth()->user()->id,
                'price' => $flightData->price->total,
                'fromTime' => $departure->at,
                'fromIataCode' => $departure->iataCode,
                'toTime' => $destination->at,
                'toIataCode' => $destination->iataCode,
                'booking_refrence' => $flightDetail->data->associatedRecords[0]->reference,
                'booking_id' => $flightDetail->data->id,
                'booking_date' => $flightDetail->data->associatedRecords[0]->creationDate,
                'airline' => $flightDetail->data->flightOffers[0]->validatingAirlineCodes[0],
                'status'=>'Pending',
            ]);

            foreach ($request->first_name as $key => $item){
                Traveller::create([
                    'user_id'=>Auth()->user()->id,
                    'booking_id'=>$booking->id,
                    'first_name'=>$request->first_name[$key],
                    'last_name'=>$request->last_name[$key],
                    "gender" => $request->gender[$key],
                    'dob'=>$request->dob[$key],
                    'password_number'=>$request->password_number[$key],
                    'expiry_date'=> $request->expiry_date[$key],
                    'issue_country'=>$request->issueCountry[$key],
                    'nationality'=>$request->nationality[$key],
                ]);
            }
            return view('front.invoice', compact('flightDetail'));
        } catch (Exception $e) {
            $fullResponse = $e->getMessage();
            $jsonStart = strpos($fullResponse, '{');
            $jsonEnd = strrpos($fullResponse, '}');

            if ($jsonStart !== false && $jsonEnd !== false) {
                $jsonString = substr($fullResponse, $jsonStart, $jsonEnd - $jsonStart + 1);
                $errorResponse = json_decode($jsonString, true);

                if (isset($errorResponse['errors'])) {
                    $errors = $errorResponse['errors'];
                    return redirect()->back()->with('error', $errors);
                }
            }
        }
    }
}
