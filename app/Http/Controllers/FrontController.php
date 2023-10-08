<?php

namespace App\Http\Controllers;

use Amadeus\Amadeus;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Traveller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

use Amadeus\Client\Provider;
use App\Models\Agency;
use App\Models\Review;
use App\Models\Search;
use App\Models\Service;

class FrontController extends Controller
{
    private $amadeus;

    public function __construct()
    {
        $this->amadeus = Amadeus::builder("IyIEHFKtolObKGs3QtjtCA393VpKS2cN", "G8Q4JKsjSjxSvYSX")->build();
    }
    public function index()
    {
        $services=Service::latest()->limit(3)->get();
        $agencies=Agency::latest()->limit(4)->get();
        return view('front.home',compact('services','agencies'));
    }

    public function list(Request $request)
    {
        $search = Search::where('from', $request->depart)->where('to', $request->destination)->first();

        $count = $search;
        if ($count == null) {
            Search::create([
                'from' => $request->depart,
                'to' => $request->destination,
                'count' => 1
            ]);
        } else {
            $search->update([
                'count' => $count->count + 1,
            ]);
        }
        if ($request->returnTime == "") {
            $apiUrl = '/v2/shopping/flight-offers?originLocationCode=' . $request->depart . '&destinationLocationCode=' . $request->destination . '&departureDate=' . $request->departTime . '&adults=' . $request->adult . '&children=' . $request->child . '&infants=' . $request->infants . '&nonStop=false&max=100'; // Replace with your API URL
        } else {
            $apiUrl = '/v2/shopping/flight-offers?originLocationCode=' . $request->depart . '&destinationLocationCode=' . $request->destination . '&departureDate=' . $request->departTime . '&returnDate=' . $request->returnTime . '&adults=' . $request->adult . '&children=' . $request->child . '&infants=' . $request->infants . '&nonStop=false&max=100'; // Replace with your API URL
        }

        try {
            $response = $this->amadeus->getClient()->getWithOnlyPath($apiUrl);
            $flightList = $response->getBody();
            return "sdds";

            session()->put('lists', $flightList);

            $flightList = session()->get('lists');
            $flightList = json_decode($flightList);
            $flightLists = $flightList->data;
            $dictionaries = $flightList->dictionaries;
            return view('front.flightList', compact('flightLists', 'dictionaries'));
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

    private function api_call($url, $params, $oauth = true)
    {

        $getdata = http_build_query(
            $params
        );

        $ch = curl_init();


        if ($oauth !== true) {
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);

            // curl_setopt($ch, CURLOPT_HEADER, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $getdata);
        } else {

            curl_setopt($ch, CURLOPT_URL, $url . '?' . $getdata);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //curl_setopt($ch, CURLOPT_VERBOSE, true);

        $headers = [
            'content-type: application/x-www-form-urlencoded',
        ];

        if ($oauth) {
            if (!$this->api_token) {
                return false;
            }

            $headers[] = "Authorization: Bearer " . $this->api_token;
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $data = curl_exec($ch);
        // Get http code
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //print_r(curl_getinfo($ch));

        curl_close($ch);

        $response = [
            'http_code' => $http_code,
            'body'    => $data
        ];

        // session()->put('token',$response);
        return $response;
    }
    public function book(Request $request)
    {

        $response_text = $this->api_call("https://test.api.amadeus.com/v1/security/oauth2/token", [
            'client_id'     => 'IyIEHFKtolObKGs3QtjtCA393VpKS2cN',
            'client_secret' => "G8Q4JKsjSjxSvYSX",
            'grant_type'    => 'client_credentials',
        ], false)['body'];



        if ($response_text) {

            $response = json_decode($response_text);

            if (isset($response->state) && $response->state === 'approved') {
                $token = $response->access_token;
            }
        }
        $travelers = [];



        foreach ($request->first_name as $key => $item) {

            if ($request->travelerType == "Adult") {
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
            } else {
                $traveler = [
                    "id" => $key + 1,
                    "dateOfBirth" => $request->dob[$key],
                    "name" => [
                        "firstName" => $request->first_name[$key],
                        "middleName" => $request->first_name[$key],
                        "lastName" => $request->last_name[$key],
                    ],
                    "gender" => $request->gender[$key],
                ];
            }


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

            // $response = $this->amadeus->getClient()->postWithStringBody("/v1/booking/flight-orders?include=status", $jsonData);

            // $flightDetail = $response->getBody();
            // $flightDetail = json_decode($flightDetail);
            // session()->put('detail', $flightDetail);
            $flightDetail = session()->get('detail');



            // $booking = Booking::create([
            //     'user_id' => Auth()->user()->id,
            //     'price' => $flightData->price->total,
            //     'fromTime' => $flightData->itineraries[0]->segments[0]->departure->at,
            //     'fromIataCode' => $flightData->itineraries[0]->segments[0]->departure->iataCode,
            //     'toTime' => $request->departureTime,
            //     'toIataCode' => $request->departure,
            //     'booking_refrence' => $flightDetail->data->associatedRecords[0]->reference,
            //     'booking_id' => $flightDetail->data->id,
            //     'booking_date' => $flightDetail->data->associatedRecords[0]->creationDate,
            //     'airline' => $flightDetail->data->flightOffers[0]->validatingAirlineCodes[0],
            //     'status' => 'Pending',
            // ]);

            if ($request->payment_method == "Cash Payment") {
                $paymentStatus = "Paid";
            } else {
                $paymentStatus = "Unpaid";
            }
            // $payment=Payment::create([
            //     'user_id'=>Auth()->user()->id,
            //     'booking_id'=>$booking->id,
            //     'payment_method'=>$request->payment_method,
            //     'total_amount'=>$flightData->price->grandTotal,
            //     'paid_amount'=>$flightData->price->grandTotal,
            //     'refundable_amount'=>$flightDetail->data->flightOffers[0]->travelerPricings[0]->price->refundableTaxes,
            //     'payment_status'=>$paymentStatus,
            //     'currency'=>$flightData->price->currency,
            // ]);


            // foreach ($request->first_name as $key => $item) {

            //     if ($request->travelerType[$key] == "Adult") {

            //         $data = [
            //             'user_id' => Auth()->user()->id,
            //             'booking_id' => $booking->id,
            //             'first_name' => $request->first_name[$key],
            //             'last_name' => $request->last_name[$key],
            //             "gender" => $request->gender[$key],
            //             'dob' => $request->dob[$key],
            //             'password_number' => $request->password_number[$key],
            //             'expiry_date' => $request->expiry_date[$key],
            //             'issue_country' => $request->issueCountry[$key],
            //             'nationality' => $request->nationality[$key],
            //         ];
            //     } else {

            //         $data = [
            //             'user_id' => Auth()->user()->id,
            //             'booking_id' => $booking->id,
            //             'first_name' => $request->first_name[$key],
            //             'last_name' => $request->last_name[$key],
            //             "gender" => $request->gender[$key],
            //             'dob' => $request->dob[$key],
            //         ];
            //     }

            //     Traveller::create($data);

            // }
            return view('front.invoice', compact('flightDetail', 'token'));
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

    public function cancelation($id)
    {
        $url = "https://api.amadeus.com/v1/booking/flight-orders?flightOrderId=" . $id; // Replace with the actual URL

        $ch = curl_init();

        // Set the URL for the DELETE request
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Set your Amadeus API key in the headers
        $headers = [
            "Authorization:Bearer wEKc3ktq0anSBaCgb27BBa159SeR" // Replace with your actual API key
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        // $result contains the response from the DELETE request
        echo $result;

        return;
    }

    public function review()
    {
        $num = Review::latest()->get()->count();
        $reviews = Review::latest()->get();
        $totalRating = 0;
        foreach ($reviews as $key => $review) {
            $totalRating = $totalRating + $review->rating;
        }

        if ($num == 0) {
            $num = 1;
        }

        $rating = $totalRating / $num;

        if ($rating >= 4) {
            $ststus = "Excellent";
        } else if ($rating < 4 && $rating >= 3) {
            $ststus = "Good";
        } else {
            $ststus = "Ok";
        }
        return view('front.review', compact('rating', 'num', 'reviews', 'ststus'));
    }

    public function contactUs(Request $request){
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['subject'] = $request->subject;

        // Create an OTP code array
        $code = ['otp' => '900'];

        // Create an array with more data (not used in your provided code)
        $myData = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ];

        // Send an email using Laravel's Mail functionality
        $sent = Mail::send('layouts.mail', ['myData' => $myData], function ($message) use ($data) {
            $message->to('bishalcodeslaravel@gmail.com'); // Recipient's email address
            $message->subject($data['subject']); // Email subject
        });


        return redirect()->back()->with('success',"Mail Send");


    }
}
