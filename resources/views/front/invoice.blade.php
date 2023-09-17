
@extends('front.app')
@section('content')
    <section class="home-section" style="height: 300px">
        <div id="myCarousel" class="carousel slide h-100" data-ride="carousel">


            <!-- Wrapper for slides -->
            <div class="carousel-inner h-100">
                <div class="item active">
                    <img src="{{ asset('flight1.jpg') }}" alt="Los Angeles" style="width:100%;">
                </div>

                <div class="item">
                    <img src="{{ asset('flight2.jpg') }}" alt="Chicago" style="width:100%;">
                </div>

                <div class="item">
                    <img src="{{ asset('flight3.jpg') }}" alt="New york" style="width:100%;">
                </div>
            </div>


        </div>

        <div class="content-section" style="height: 300px">

        </div>
    </section>
    @php
    $adultsNum = 0;
    $TravelerType = '';

    $totalAdults = 0;

    $adultNum = 0;
    $childNum = 0;
    $infantNum = 0;

    $adultTotalPrice = 0;
    $adultBasePrice = 0;
    $adultTotalotalTax = 0;

    $childTotalPrice = 0;
    $childBasePrice = 0;
    $childTotalotalTax = 0;

    $infantTotalPrice = 0;
    $infantBasePrice = 0;
    $infantTotalotalTax = 0;

    $travelerPriceLoop = $flightDetail->data->flightOffers[0]->travelerPricings;
    $loopData = $flightDetail->data->flightOffers[0]->itineraries;
@endphp



@foreach ($travelerPriceLoop as $item)
    {{-- <li class=" m-0 p-0 px-4"> --}}
    @php
        $totalAdults = $totalAdults + 1;
    @endphp
    @if ($item->travelerType == 'ADULT')
        @php
            $adultNum = $adultNum + 1;
            $adultTotalPrice = $adultTotalPrice + $item->price->total;
            $adultBasePrice = $adultBasePrice + $item->price->base;
            $loop1 = $item->price->taxes;
        @endphp

        @foreach ($loop1 as $tax)
            @php
                $adultTotalotalTax = $adultTotalotalTax + $tax->amount;
            @endphp
        @endforeach
    @endif

    @if ($item->travelerType == 'CHILD')
        @php
            $childNum = $childNum + 1;
            $childTotalPrice = $childTotalPrice + $item->price->total;
            $childBasePrice = $childBasePrice + $item->price->base;
            $loop1 = $item->price->taxes;
        @endphp


        @foreach ($loop1 as $tax)
            @php
                $childTotalotalTax = $childTotalotalTax + $tax->amount;
            @endphp
        @endforeach
    @endif

    @if ($item->travelerType == 'HELD_INFANT')
        @php
            $infantNum = $infantNum + 1;
            $infantTotalPrice = $infantTotalPrice + $item->price->total;
            $infantBasePrice = $infantBasePrice + $item->price->base;
            $loop1 = $item->price->taxes;
        @endphp


        @foreach ($loop1 as $tax)
            @php
                $infantTotalotalTax = $infantTotalotalTax + $tax->amount;
            @endphp
        @endforeach
    @endif

    {{-- </li> --}}
@endforeach

<section>
    <div class="row mt-5">
        <div class="col-xl-3"></div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="card mb-4 px-4">
                        <div class="card-body">
                            <div class="row d-flex align-items-center">
                                <div class="col-xl-6">
                                    <img src="{{ asset('logo.png') }}" alt="" style="height: 80px">
                                </div>

                                <div class="col-xl-6 d-flex justify-content-end">
                                    <div class="d-block">
                                        <span><label class="fw-bold text-uppercase">Payment Status : </label>
                                            Unpaid</span> <br>
                                        <span><label class="fw-bold text-uppercase">Booking Status : </label>
                                            Pending</span> <br>
                                        <span><label class="fw-bold text-uppercase">Phone : </label> 981468499</span>
                                        <br>
                                        <span><label class="fw-bold text-uppercase">Email : </label>
                                            {{ $flightDetail->data->contacts[0]->emailAddress }}
                                        </span> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card px-4 mb-4" style="background-color: #F5F5F7">
                        <div class="card-body">
                            <div class="row d-flex align-items-center">
                                <div class="col-xl-6">
                                    <div class="d-flex align-items-center">
                                        <h4 class="fw-bold">Pay with</h4> &nbsp;&nbsp;&nbsp;
                                        <div class="card px-5 py-3">
                                            <div class="card-body">
                                                Pay Later
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 d-flex justify-content-end">
                                    <h4><span class="fw-bold">
                                            {{ $flightDetail->data->flightOffers[0]->price->grandTotal }}
                                            {{ $flightDetail->data->flightOffers[0]->price->billingCurrency }}
                                        </span></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="col-12 border mb-4">
                        <tr class="border" style="background-color: #F5F5F7">
                            <th class="border px-5 py-3">Booking Refrence</th>
                            <th class="border px-5 py-3">Booking Refrence</th>
                            <th class="border px-5 py-3">Booking Date</th>
                        </tr>
                        <tr class="border">
                            <td class="border px-5 py-3">{{ $flightDetail->data->associatedRecords[0]->reference }}</td>
                            <td class="border px-5 py-3">{{ $flightDetail->data->id }}</td>
                            <td class="border px-5 py-3">{{ $flightDetail->data->associatedRecords[0]->creationDate }}
                            </td>
                        </tr>
                    </table>
                    <div class="card px-5 py-3" style="border-bottom-left-radius: 0px;border-bottom-right-radius: 0px">
                        <h4 class="fw-bold text-uppercase">Travellers</h4>
                    </div>
                    <table class="col-12 border mb-4">
                        <tr class="border" style="background-color: #F5F5F7">
                            <th class="border px-5 py-3">No</th>
                            <th class="border px-5 py-3">Name</th>
                            <th class="border px-5 py-3">Date of Birth</th>
                            <th class="border px-5 py-3">Gender</th>
                        </tr>
                        @foreach ($flightDetail->data->travelers as $traveler)
                            <tr class="border">
                                <td class="border px-5 py-3">{{ $loop->iteration }}</td>
                                <td class="border px-5 py-3">{{ $traveler->name->firstName }}
                                    {{ $traveler->name->lastName }}</td>
                                <td class="border px-5 py-3">{{ $traveler->dateOfBirth }}</td>
                                <td class="border px-5 py-3">{{ $traveler->gender }}</td>
                            </tr>
                        @endforeach

                    </table>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="fw-bold text-uppercase">Flights</h4>
                        </div>
                        <div class="card-body px-3">
                            <div class="row d-flex align-items-center px-4">
                                <div class="col-xl-6 d-flex align-items-center">
                                    <i class="fa-solid fa-plane fa-3x text-secondary"
                                        style="transform: rotate(270deg);"></i>
                                    <div class="card" style="margin-left: 30px;margin-right: 30px">
                                        <div class="card-body fw-bold">
                                            @if (count($flightDetail->data->flightOffers[0]->itineraries) > 1)
                                                Roundup
                                            @else
                                                Oneway
                                            @endif
                                        </div>
                                    </div>
                                    Buddha Airlines
                                </div>
                                <div class="col-xl-6 d-flex align-items-center justify-content-end">
                                    <div class="d-block pt-2" style="margin-right: 60px">
                                        <div class="d-flex align-items-center">
                                            <label class="fw-bold m-0">Including Chacked bags only :</label>
                                            {{ $flightDetail->data->flightOffers[0]->pricingOptions->includedCheckedBagsOnly ? 'True' : 'False' }}
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <label class="fw-bold">Bag :</label>
                                            {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->fareDetailsBySegment[0]->includedCheckedBags->weight }}
                                            {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->fareDetailsBySegment[0]->includedCheckedBags->weightUnit }}
                                        </div>
                                    </div>
                                    <i class="fa-solid fa-suitcase-rolling fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div style="background-color: #F5F5F7" class="py-4">
                            <div class="d-flex align-items-center px-5 mb-4">
                                <i class="fa-solid fa-calendar-days text-secondary"
                                    style="font-size: 25px;margin-right:20px"></i>
                                <h5 class="fw-bold" style="margin-right:40px">
                                    {{-- @foreach ($flightDetail->data->flightOffers[0]->itineraries[0]->segments[0]->departure->iataCode as $item)

                                @endforeach --}}
                                    {{ substr($flightDetail->data->flightOffers[0]->itineraries[0]->segments[0]->departure->at, 0, -9) }}
                                </h5>
                                <i class="fa-solid fa-clock text-secondary"
                                    style="font-size: 25px;margin-right:20px"></i>
                                <h5> {{ getTime($flightDetail->data->flightOffers[0]->itineraries[0]->segments[0]->departure->at) }}
                                </h5>
                                <span style="margin-left:50px" class="d-flex"><h5>Depart from : &nbsp;</h5>
                                    {{getCity($flightDetail->data->flightOffers[0]->itineraries[0]->segments[0]->departure->iataCode) }}
                                </span>
                            </div>
                            @foreach ($flightDetail->data->flightOffers[0]->itineraries[0]->segments as $segment)
                                @if ($loop->last)
                                    <div class="d-flex align-items-center px-5">
                                        <i class="fa-solid fa-calendar-days text-secondary"
                                            style="font-size: 25px;margin-right:20px"></i>
                                        <h5 class="fw-bold" style="margin-right:40px">{{ substr($segment->arrival->at, 0, -9) }}
                                        </h5>
                                        <i class="fa-solid fa-clock text-secondary"
                                            style="font-size: 25px;margin-right:20px"></i>
                                        <h5>{{ getTime($segment->arrival->at) }}</h5>
                                        <span style="margin-left:50px" class="d-flex align-items-end"><h5>Depart from : &nbsp;</h5> {{getCity($segment->arrival->iataCode)}}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>


                    <div class="card px-5 py-3"
                        style="border-bottom-left-radius: 0px;border-bottom-right-radius: 0px">
                        <h4 class="fw-bold text-uppercase">Fare details</h4>
                    </div>
                    <table class="col-12 border mb-4">
                        <tr class="border" style="background-color: #F5F5F7">
                            <th class="border px-5 py-3">Particular</th>
                            <th class="border px-5 py-3">Pice</th>
                        </tr>
                        <tr class="border">
                            <td class="border px-5 py-3">Base</td>
                            <td class="border px-5 py-3">{{$flightDetail->data->flightOffers[0]->travelerPricings[0]->price->base}} {{$flightDetail->data->flightOffers[0]->travelerPricings[0]->price->currency}}</td>
                        </tr>
                        @php
                            $totalTax=0;
                        @endphp
                        @foreach ($flightDetail->data->flightOffers[0]->travelerPricings[0]->price->taxes as $tax)
                            @php
                                $totalTax=$totalTax+$tax->amount;
                            @endphp
                        @endforeach
                        <tr class="border">
                            <td class="border px-5 py-3">Tax</td>
                            <td class="border px-5 py-3">{{$totalTax}} {{$flightDetail->data->flightOffers[0]->travelerPricings[0]->price->currency}}</td>
                        </tr>
                        <tr class="border" style="background-color: #F5F5F7">
                            <td class="border px-5 py-3 fw-bold">Total</td>
                            <td class="border px-5 py-3 fw-bold">{{$flightDetail->data->flightOffers[0]->travelerPricings[0]->price->total}} {{$flightDetail->data->flightOffers[0]->travelerPricings[0]->price->currency}}</td>
                        </tr>
                        <tr class="border" style="background-color: #F5F5F7">
                            <td class="border px-5 py-3 fw-bold">Refundable Tax</td>
                            <td class="border px-5 py-3 fw-bold">{{$flightDetail->data->flightOffers[0]->travelerPricings[0]->price->refundableTaxes}} {{$flightDetail->data->flightOffers[0]->travelerPricings[0]->price->currency}}</td>
                        </tr>

                    </table>


                    <div class="card px-5 py-3"
                        style="border-bottom-left-radius: 0px;border-bottom-right-radius: 0px">
                        <h4 class="fw-bold text-uppercase">Customer details</h4>
                    </div>
                    <table class="col-12 border mb-4">
                        <tr class="border">
                            <th class="border px-5 py-3">Name</th>
                            <td class="border px-5 py-3">{{$flightDetail->data->contacts[0]->addresseeName->firstName}}</td>
                            <th class="border px-5 py-3">Email</th>
                            <td class="border px-5 py-3">{{$flightDetail->data->contacts[0]->emailAddress}}</td>
                        </tr>
                        <tr class="border">
                            <th class="border px-5 py-3">Contact</th>
                            <td class="border px-5 py-3">9814668499</td>
                            <th class="border px-5 py-3">Address</th>
                            <td class="border px-5 py-3">{{$flightDetail->data->contacts[0]->address->lines[0]}}</td>
                        </tr>



                    </table>

                    <div class="row">
                        <div class="col-xl-4">
                            <button class="btn btn-info col-12 fw-bold text-uppercase py-4">Download as PDF</button>
                        </div>
                        <div class="col-xl-4">
                            <button class="btn btn-info col-12 fw-bold text-uppercase py-4">Send to whatsapp</button>
                        </div>
                        <div class="col-xl-4">
                            <button class="btn btn-info col-12 fw-bold text-uppercase py-4">Cancellation</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2"></div>
    </div>
</section>

@endsection
