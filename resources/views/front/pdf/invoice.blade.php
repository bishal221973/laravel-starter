<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

    <style>
        .label-12 {
            font-size: 12px !important;
        }

        .label-13 {
            font-size: 13px !important;
        }

        .fw-bold {
            font-weight: bold !important;
        }

        .label1 {
            position: relative !important;
            top: -10px !important;
        }

        .bg-secondary {
            background-color: #F5F5F7 !important;
        }

        h5 {
            font-size: 18px !important;
        }

        .d-flex {
            display: flex !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .card1 {
            width: 100px !important;
        }

        .container {
            display: block;
            width: 100%;
        }

        .col {
            float: left;
            width: 50%;
            /* Adjust width as needed */
            box-sizing: border-box;
            /* Helps with padding and borders */
        }
    </style>
</head>

<body>
    <div class="card mb-1">
        <div class="card-body m-0 p-0 px-3">
            <table style="width: 100%">
                <tr style="width: 100%">
                    <td style="width: 50%">
                        <img src="logo.png" height="50px" alt="" srcset="">
                    </td>
                    <td>
                        <span class="label-12 "><span class="fw-bold">Payment Status</span> : {{$payment->payment_status}}</span> <br>
                        @if (Auth()->user()->contact_number)
                            <span class="label-12 m-0 p-0"><span class="fw-bold m-0 p-0">Phone</span> :
                                {{ Auth()->user()->contact_number }}</span>
                        @endif
                        <br>
                        <span class="label-12 m-0 p-0"><span class="fw-bold m-0 p-0">Email</span> :
                            {{ Auth()->user()->email }}</span>
                            @php
                            $qrcode = base64_encode(
                                QrCode::format('svg')
                                    ->size(200)
                                    ->errorCorrection('H')
                                    ->generate('string'),
                            );

                        @endphp
                    </td>
                    <img src="data:image/png;base64, {!! $qrcode !!}" height="60px" class="mt-2">
                </tr>
            </table>
        </div>
    </div>
    <div class="card bg-secondary py-2 mb-1">
        <div class="card-body m-0 p-0 px-3">
            <table style="width: 100%">
                <tr style="width: 100%">
                    <td style="width: 60%">
                        <div style="display: inline-block">
                            <h5 class="">Pay With</h5>

                            <div style="display: flex;justify-content:center" class="card">
                                <label class="px-3 py-1"> {{$payment->payment_method}} </label>
                            </div>
                        </div>
                    </td>

                    <td style="display: flex;justify-content:end">
                        <h5 class="pt-4 text-right">
                            {{ $flightDetail->data->flightOffers[0]->price->grandTotal }}
                            {{ $flightDetail->data->flightOffers[0]->price->billingCurrency }}
                        </h5>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <table style="width: 100%" class="mb-1">
        <tr class="bg-secondary">
            <th class="label-12 border p-3">Booking Refrence</th>
            <th class="label-12 border p-3">Booking ID</th>
            <th class="label-12 border p-3">Booking Date</th>
        </tr>
        <tr>
            <td class="border px-5 py-3 label-12">
                {{ $flightDetail->data->associatedRecords[0]->reference }}</td>
            <td class="border px-5 py-3 label-12">{{ $flightDetail->data->id }}</td>
            <td class="border px-5 py-3 label-12">
                {{ $flightDetail->data->associatedRecords[0]->creationDate }}
            </td>
        </tr>

    </table>

    <div class="card p-1" style="border-bottom:none;border-bottom-left-radius:0px;border-bottom-right-radius:0px">
        <h5 class="text-uppercase">Travellers</h5>
    </div>
    <table style="width: 100%" class="mb-1">
        <tr class="bg-secondary">
            <th class="label-12 border p-3">S.N.</th>
            <th class="label-12 border p-3">Name</th>
            <th class="label-12 border p-3">Date of Birth</th>
            <th class="label-12 border p-3">Gender</th>
        </tr>
        @foreach ($flightDetail->data->travelers as $traveler)
            <tr class="border">
                <td class="border px-5 py-2 label-13">{{ $loop->iteration }}</td>
                <td class="border px-5 py-2 label-13">{{ $traveler->name->firstName }}
                    {{ $traveler->name->lastName }}</td>
                <td class="border px-5 py-2 label-13">{{ $traveler->dateOfBirth }}</td>
                <td class="border px-5 py-2 label-13">{{ $traveler->gender }}</td>
            </tr>
        @endforeach

    </table>

    <div class="card mb-1">
        <div class="card-header">
            <h5 class="text-uppercase">Flight</h5>
        </div>
        <div class="card-body m-0 p-0" style="height: 70px">
            <table style="width: 100%" class="m-0 p-0">
                <tr class="m-0 p-0 ">
                    <td style="padding-right: 250px" class="m-0">
                        <div class="row m-0 p-0">
                            <div class="col m-0 p-0">
                                <img src="plane.png" height="40px" alt="" srcset=""
                                    style="transform: rotate(-90deg);position: relative;top:-20px">
                            </div>
                            <div class="col border m-0 p-1" style="position: relative;top:-10.5px">
                                @if (count($flightDetail->data->flightOffers[0]->itineraries) > 1)
                                    Roundup
                                @else
                                    Oneway
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="">
                        <h5 class="text-left label-12 m-0 p-0"
                            style="display:inline-table;text-align:right;position: relative; top:20px">
                            Including Chacked bags only :
                            {{ $flightDetail->data->flightOffers[0]->pricingOptions->includedCheckedBagsOnly ? 'True' : 'False' }}
                        </h5> <br>
                        <span class="label-12 m-0 p-0"
                            style="display:inline-table;text-align:right;position: relative; top:10px;left:27px">
                            Bag :
                            {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->fareDetailsBySegment[0]->includedCheckedBags->weight }}
                            {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->fareDetailsBySegment[0]->includedCheckedBags->weightUnit }}
                        </span>
                        <img src="bag.png" height="20px" alt="" srcset=""
                            style="position: relative;left:40px">

                    </td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="row">
                        <img src="calender.png" height="20px" alt="" srcset=""
                            style="position: relative;top:5px">
                        <span
                            class="ml-1">{{ substr($flightDetail->data->flightOffers[0]->itineraries[0]->segments[0]->departure->at, 0, -9) }}</span>
                        <img src="time.png" height="20px" alt="" srcset=""
                            style="position: relative;top:5px">
                        <span
                            class="ml-1">{{ getTime($flightDetail->data->flightOffers[0]->itineraries[0]->segments[0]->departure->at) }}</span>
                        <b class="ml-1">Depart From :
                            {{ getCity($flightDetail->data->flightOffers[0]->itineraries[0]->segments[0]->departure->iataCode) }}
                        </b>
                    </div>
                </div>
                @foreach ($flightDetail->data->flightOffers[0]->itineraries[0]->segments as $segment)
                    @if ($loop->last)
                        <div class="col-12">
                            <div class="row">
                                <img src="calender.png" height="20px" alt="" srcset=""
                                    style="position: relative;top:5px">
                                <span class="ml-1">{{ substr($segment->arrival->at, 0, -9) }}</span>
                                <img src="time.png" height="20px" alt="" srcset=""
                                    style="position: relative;top:5px">
                                <span class="ml-1">{{ getTime($segment->arrival->at) }}</span>
                                <b class="ml-1">Arrived To : {{ getCity($segment->arrival->iataCode) }}</b>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>


    </div>
    <div class="card p-1" style="border-bottom:none;border-bottom-left-radius:0px;border-bottom-right-radius:0px">
        <h5 class="text-uppercase">Fare Details</h5>
    </div>
    <table style="width: 100%" class="mb-1">
        <tr class="bg-secondary">
            <th class="label-12 border p-3">Particular</th>
            <th class="label-12 border p-3">Price</th>
        </tr>
        <tr>
            <td class="label-12 border px-3 py-2">Base</td>
            <td class="label-12 border px-3 py-2">
                {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->price->base }}
                {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->price->currency }}</td>
        </tr>
        @php
            $totalTax = 0;
        @endphp
        @foreach ($flightDetail->data->flightOffers[0]->travelerPricings[0]->price->taxes as $tax)
            @php
                $totalTax = $totalTax + $tax->amount;
            @endphp
        @endforeach
        <tr>
            <td class="label-12 border px-3 py-2">Tax</td>
            <td class="label-12 border px-3 py-2">
                {{ $totalTax }}
                {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->price->currency }}
            </td>
        </tr>
        <tr class="bg-secondary">
            <td class="label-12 border px-3 py-2">Total</td>
            <td class="label-12 border px-3 py-2">
                {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->price->total }}
                {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->price->currency }}
            </td>
        </tr>
        <tr class="bg-secondary">
            <td class="label-12 border px-3 py-2">Refundable Tax</td>
            <td class="label-12 border px-3 py-2">
                {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->price->refundableTaxes }}
                {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->price->currency }}
            </td>
        </tr>

    </table>
</body>

</html>
