@php
    $firstDate = '';
    $lastDate = '';
@endphp
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
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body text-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Round Trip
                                    </label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label " for="flexRadioDefault2">
                                        One way
                                    </label>
                                </div>
                            </div>
                            <select name="#" id="" class="form-control col-2">
                                <option value="#" selected>Economy</option>
                                <option value="#">Permium Economy</option>
                                <option value="#">Business</option>
                                <option value="#">First</option>
                            </select>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-xl-3">
                                <div class="wrapper">
                                    <div class="search-input">
                                        <a href="" target="_blank" hidden></a>
                                        <input type="text" class="depart" placeholder="Type to search..">
                                        <div class="autocom-box">
                                        </div>
                                        <div class="icon"><i class="fa-solid fa-plane-departure"></i></div>
                                    </div>
                                    <input type="hidden" name="depart" id="depart">
                                </div>
                            </div>
                            <div class="col-xl-3">

                                <div class="wrapper ">
                                    <div class="search-input search-inputs">
                                        <a href="" target="_blank" hidden></a>
                                        <input type="text" class="destination" placeholder="Type to search..">
                                        <div class="autocom-box1">
                                        </div>
                                        <div class="icon"><i class="fa-solid fa-plane-departure"></i></div>
                                    </div>
                                    <input type="hidden" name="destination" id="destination">
                                </div>

                            </div>

                            <div class="col-xl-4">

                                <div class="wrapper ">
                                    <div class="search-input search-inputs">
                                        <a href="" target="_blank" hidden></a>
                                        <input type="text" placeholder="Type to search..">
                                        <div class="icon"><i class="fa-solid fa-calendar-days"></i></div>
                                    </div>
                                    <input type="hidden" name="destination" id="destination">
                                </div>

                            </div>
                            <div class="col-xl-2">

                                <div class="wrapper ">
                                    <div class="search-input search-inputs">
                                        <a href="" target="_blank" hidden></a>
                                        <input type="text" placeholder="Passenger">
                                        <div class="icon"><i class="fa-solid fa-calendar-days"></i></div>
                                    </div>
                                    <input type="hidden" name="destination" id="destination">
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-info">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2"></div>
        </div>
    </section>

    {{-- ============List========= --}}
    <div class="row mt-5">
        <div class="col-xl-2"></div>
        <div class="col-xl-8">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-3">Flights Stop</h5>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Non Stop
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    1 Stop
                                </label>
                            </div>
                            <hr>
                            <h5 class="text-uppercase mb-3">Price Range</h5>

                            <input type="number" class="form-control mb-2" placeholder="Min Price">
                            <input type="number" class="form-control" placeholder="Max Price">

                            <hr>

                            <h5 class="text-uppercase mb-3">Depature time</h5>
                            <div class="row">
                                <div class="col-xl-6 card card1 py-2 mb-2">
                                    <div class="m-0 p-0 col-12">
                                        <div class=" d-flex mb-2 justify-content-center">

                                            <i class="fa-solid fa-sun"></i>
                                        </div>
                                        <label class="col-12 text-center m-0 p-0">Early Morning</label>
                                        <small class="text-center m-0 p-0" style="font-size: 12px">12::00am-4:59am</small>
                                    </div>
                                </div>
                                <div class="col-xl-6 card card1 py-2 mb-2">
                                    <div class="m-0 p-0 col-12">
                                        <div class=" d-flex mb-2 justify-content-center">

                                            <i class="fa-solid fa-sun"></i>
                                        </div>
                                        <label class="col-12 text-center m-0 p-0">Morning</label>
                                        <small class="text-center m-0 p-0" style="font-size: 12px">5::00am-11:59am</small>
                                    </div>
                                </div>

                                <div class="col-xl-6 card card1 py-2 mb-2">
                                    <div class="m-0 p-0 col-12">
                                        <div class=" d-flex mb-2 justify-content-center">

                                            <i class="fa-solid fa-sun"></i>
                                        </div>
                                        <label class="col-12 text-center m-0 p-0">Afternoon</label>
                                        <small class="text-center m-0 p-0" style="font-size: 12px">12::00pm-5:59pm</small>
                                    </div>
                                </div>
                                <div class="col-xl-6 card card1 py-2 mb-2">
                                    <div class="m-0 p-0 col-12">
                                        <div class=" d-flex mb-2 justify-content-center">

                                            <i class="fa-solid fa-sun"></i>
                                        </div>
                                        <label class="col-12 text-center m-0 p-0">Evening</label>
                                        <small class="text-center m-0 p-0" style="font-size: 12px">6::00pm-11:59pm</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ==== --}}
                <div class="col-xl-9">
                    <div class="card bg-info m-0 p-0 mb-5">
                        <div class="card-body text-white m-0 p-0 py-2">
                            <div class="d-flex justify-content-between">
                                <div class="row col-6 d-flex align-items-center">
                                    <div class="col-2">
                                        <i class="fa-solid fa-plane-departure fa-2x"></i>
                                    </div>
                                    <div class="col">
                                        {{-- @php $paramValue = request('depart'); @endphp --}}
                                        <h4 class="text-white">{{ request('depart') }}</h4>
                                        <label class="m-0 p-0">{{ getCity(request('depart')) }},
                                            {{ getCountry(request('depart')) }}</label>
                                    </div>
                                </div>

                                <div class="row col-6 d-flex align-items-center">
                                    <div class="col  d-flex justify-content-end ">
                                        <div>
                                            <h4 class="text-white">{{ request('destination') }}</h4>
                                            <label class="m-0 p-0">{{ getCity(request('destination')) }},
                                                {{ getCountry(request('destination')) }}</label>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end ">
                                        <i class="fa-solid fa-plane-arrival fa-2x"
                                            style="transform: rotate(180deg);transform: scaleX(-1);"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div style="height: 30px"></div>
                    @foreach ($flightLists as $flightList)
                        <div class="card mb-2">
                            <div class="card-body py-0">
                                <div class="row border-bottom ">
                                    <div class="col-xl-9 border-right m-0 p-0">

                                        @foreach ($flightList->itineraries as $itinerary)
                                            @foreach ($itinerary->segments as $segment)
                                                @if ($loop->first)
                                                    @php
                                                        $firstDate = $segment->departure->at;
                                                    @endphp
                                                @endif
                                                @if ($loop->last)
                                                    @php
                                                        $lastDate = $segment->arrival->at;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            {{-- @foreach ($itinerary->segments as $segment) --}}
                                            <div class="col-12 pt-2">
                                                <div class="row d-flex align-items-center">
                                                    <div class="col-xl-3">
                                                        <img src="{{ asset('flight4.png') }}" class="rounded"
                                                            alt="" style="height: 45px;width: 45px"> <br>
                                                        <label class="mt-3">Buddha Air</label>
                                                    </div>
                                                    <div class="p-2 border">
                                                        {{ $segment->departure->iataCode }}
                                                    </div>
                                                    <div class="col-xl-2">
                                                        <label><b>{{ getTime($firstDate) }}</b></label>
                                                        <label
                                                            class="m-0 p-0 font-weight-normal">{{ getDates($firstDate) }}</label>
                                                    </div>
                                                    <div class="col-xl-3">
                                                        <label
                                                            class="col-12 text-center">{{ computeTime($firstDate, $lastDate) }}</label>
                                                        <hr class="m-0 p-0">
                                                        <label
                                                            class="col-12 text-center">{{ countArray($itinerary->segments) == 0 ? 'Non Stop' : countArray($itinerary->segments) . ' Stop' }}</label>
                                                    </div>
                                                    <div class="col-xl-2">
                                                        <label><b>{{ getTime($lastDate) }}</b></label>
                                                        <label
                                                            class="m-0 p-0 font-weight-normal">{{ getDates($lastDate) }}</label>
                                                    </div>

                                                    <div class="p-2 border">
                                                        {{ $segment->arrival->iataCode }}

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- @endforeach --}}
                                            <hr class="m-0 p-0">
                                        @endforeach
                                    </div>
                                    <div class="col-xl-3">
                                        <h5 class="text-info text-center mt-5">200 EUR</h5>
                                        <label class="col-12 text-center m-0 p-0">Price per persion</label>
                                        <label class="col-12 text-center m-0 p-0 text-secondary">(incl. taxes &
                                            fees)</label>

                                        <div class="col-12 mt-4 d-flex justify-content-center">
                                            <button class="btn-select">Select</button>
                                        </div>
                                    </div>

                                </div>
                                <button class="border-0 bg-transparent py-2">Flight details</button>


                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xl-2"></div>
    </div>
@endsection
