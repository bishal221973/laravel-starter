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


        <div class="content-section " style="height: 300px">
            <div class="col-xl-2 col-lg-1 col-md-12"></div>
            <div class="col-xl-8 col-lg-10 col-md-12 search-content-section">
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
                            <div class="col-xl-3 col-lg-3 col-md-3">
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
                            <div class="col-xl-3 col-lg-3 col-md-3">

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

                            <div class="col-xl-4 col-lg-4 col-md-4">

                                <div class="wrapper ">
                                    <div class="search-input search-inputs">
                                        <a href="" target="_blank" hidden></a>
                                        <input type="text" placeholder="Type to search..">
                                        <div class="icon"><i class="fa-solid fa-calendar-days"></i></div>
                                    </div>
                                    <input type="hidden" name="destination" id="destination">
                                </div>

                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2">

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
            <div class="col-xl-2 col-lg-1 col-md-12">

            </div>

            <div class="position-absolute col-12 menu-toggle d-none" style="top: 250px">
                <div class="col-12  d-flex justify-content-between">
                    <button class="btn2" id="btnFilter">Filter</button>
                    <button class="btn2">Search</button>
                </div>
            </div>
        </div>
    </section>


    @if (session()->has('error'))
        @php
            $errors = session()->get('error');
        @endphp
        @foreach ($errors as $error)
            @push('script')
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: '{{ $error['detail'] }}'
                    })
                </script>
            @endpush
        @endforeach
    @endif

    {{-- ============List========= --}}
    <div class="col-12" style="overflow: hidden">
        <div class="row mt-5">
            <div class="col-xl-2 col-lg-1"></div>
            <div class="col-xl-8 col-lg-10">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 filter-list" id="filterList">
                        <div class="card">
                            <div class="card-body position-relative">
                                <span class="btn-close-filter bg-danger d-none" id="closeFilter">
                                    <i class="fa-solid fa-xmark text-white"></i>
                                </span>
                                <h5 class="text-uppercase mb-3">Flights Stop</h5>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="nonStop"
                                        onclick="nonStopFunction()">
                                    <label class="form-check-label" for="nonStop">
                                        Non Stop
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="stop"
                                        onclick="stopFunction()">
                                    <label class="form-check-label" for="stop">
                                        1 Stop
                                    </label>
                                </div>
                                <hr>
                                <h5 class="text-uppercase mb-3">Price Range</h5>

                                <input type="number" id="minPrice" class="form-control mb-2" placeholder="Min Price">
                                <input type="number" id="maxPrice" class="form-control" placeholder="Max Price">

                                <hr>

                                <h5 class="text-uppercase mb-3">Depature time</h5>
                                <div class="row">
                                    <div class="col-xl-6 col-6 card card1 py-2 mb-2" id="">
                                        <input type="checkbox" name="1" id="earlyMorning">
                                        <div class="m-0 p-0 col-12">
                                            <div class=" d-flex mb-2 justify-content-center">

                                                <i class="fa-solid fa-sun"></i>
                                            </div>
                                            <label class="col-12 text-center m-0 p-0" for="earlyMorning">Early
                                                Morning</label>
                                            <small class="text-center m-0 p-0" for="earlyMorning"
                                                style="font-size: 12px">12::00am-4:59am</small>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-6 card card1 py-2 mb-2">
                                        <input type="checkbox" name="1" id="morning">

                                        <div class="m-0 p-0 col-12">
                                            <div class=" d-flex mb-2 justify-content-center">

                                                <i class="fa-solid fa-sun"></i>
                                            </div>
                                            <label class="col-12 text-center m-0 p-0">Morning</label>
                                            <small class="text-center m-0 p-0"
                                                style="font-size: 12px">5::00am-11:59am</small>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-6 card card1 py-2 mb-2">
                                        <input type="checkbox" name="1" id="afternoon">
                                        <div class="m-0 p-0 col-12">
                                            <div class=" d-flex mb-2 justify-content-center">

                                                <i class="fa-solid fa-sun"></i>
                                            </div>
                                            <label class="col-12 text-center m-0 p-0">Afternoon</label>
                                            <small class="text-center m-0 p-0"
                                                style="font-size: 12px">12::00pm-5:59pm</small>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-6 card card1 py-2 mb-2">
                                        <input type="checkbox" name="1" id="evening">
                                        <div class="m-0 p-0 col-12">
                                            <div class=" d-flex mb-2 justify-content-center">

                                                <i class="fa-solid fa-sun"></i>
                                            </div>
                                            <label class="col-12 text-center m-0 p-0">Evening</label>
                                            <small class="text-center m-0 p-0"
                                                style="font-size: 12px">6::00pm-11:59pm</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ==== --}}
                    <div class="col-xl-9 col-lg-9">
                        <div class="card bg-info m-0 p-0 mb-5">
                            <div class="card-body text-white m-0 p-0 py-2">
                                <div class="d-flex justify-content-between">
                                    <div class="row col-6 d-flex align-items-center">
                                        <div class="col-2 header-flight-icon">
                                            <i class="fa-solid fa-plane-departure fa-2x"></i>
                                        </div>
                                        <div class="col">
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
                                        <div class="col-2 mr-3 justify-content-end header-flight-icon">
                                            <i class="fa-solid fa-plane-arrival fa-2x"
                                                style="transform: rotate(180deg);transform: scaleX(-1);"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div style="height: 30px"></div>
                        <table id="list">
                            <tr>
                                @foreach ($flightLists as $index => $flightList)
                                    @php
                                        $amadeus = urlencode(json_encode($flightList));
                                    @endphp
                                    <div class="card mb-2 listCard">
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
                                                        <div class="col-12 pt-2 ">
                                                            <div class="top-price d-none">
                                                                <div class="d-flex  justify-content-between">
                                                                    <div class="col-9">
                                                                        {{ $flightList->price->total }}
                                                                        {{ $flightList->price->currency }} <br>
                                                                        <label class="col-12 m-0 p-0 text-secondary">(incl.
                                                                            taxes &
                                                                            fees)</label>
                                                                    </div>
                                                                    <div>
                                                                        <form action="{{ route('front.detail', $amadeus) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <button class="btn-select">Select</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <div class="hr m-0 p-0"></div>
                                                            </div>
                                                            <div class="row d-flex align-items-center">

                                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-2">
                                                                    <img src="{{ asset('flight4.png') }}" class="rounded"
                                                                        alt="" style="height: 45px;width: 45px">
                                                                    <br>
                                                                    <label class="mt-3 airline-name">Buddha Air</label>
                                                                </div>
                                                                <div class="p-2">
                                                                    <div class="border iataCode d-flex justify-content-center py-2">

                                                                        {{ $itinerary->segments[0]->departure->iataCode }}
                                                                    </div>
                                                                    <label
                                                                        class="time m-0 p-0"><b>{{ getTime($firstDate) }}</b></label>
                                                                    <br>
                                                                    <label
                                                                        class="m-0 getDate p-0 font-weight-normal">{{ getDates($firstDate) }}</label>
                                                                </div>
                                                                {{-- <div class="col-xl-2">
                                                                <label
                                                                    class="time"><b>{{ getTime($firstDate) }}</b></label>
                                                                <label
                                                                    class="m-0 p-0 font-weight-normal">{{ getDates($firstDate) }}</label>
                                                            </div> --}}
                                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-4 center-div">
                                                                    <label
                                                                        class="col-12 text-center ">{{ computeTime($firstDate, $lastDate) }}</label>
                                                                    <hr class="m-0 p-0">
                                                                    <span> <label
                                                                            class="col-12 text-center stopNum">{{ countArray($itinerary->segments) == 0 ? 'Non Stop' : countArray($itinerary->segments) . ' Stop' }}</label></span>
                                                                </div>
                                                                {{-- <div class="col-xl-2">
                                                                <label><b>{{ getTime($lastDate) }}</b></label>
                                                                <label
                                                                    class="m-0 p-0 font-weight-normal">{{ getDates($lastDate) }}</label>
                                                            </div> --}}

                                                                <div class="p-2">
                                                                    <div class="border iataCode d-flex justify-content-center py-2">

                                                                        {{ $segment->arrival->iataCode }}
                                                                    </div>
                                                                    <label class="time"><b>{{ getTime($lastDate) }}</b></label> <br>
                                                                    <label
                                                                        class="m-0 p-0 getDate font-weight-normal">{{ getDates($lastDate) }}</label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- @endforeach --}}
                                                        <hr class="m-0 p-0">
                                                    @endforeach
                                                </div>
                                                <div class="col-xl-3 right-price">
                                                    <h5 class="text-info text-center mt-5 priceNum">
                                                        {{ $flightList->price->total }} {{ $flightList->price->currency }}
                                                    </h5>
                                                    <label class="col-12 text-center m-0 p-0">Price per persion</label>
                                                    <label class="col-12 text-center m-0 p-0 text-secondary">(incl. taxes &
                                                        fees)</label>



                                                    <div class="col-12 mt-4 d-flex justify-content-center">
                                                        <form action="{{ route('front.detail', $amadeus) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button class="btn-select">Select</button>
                                                        </form>
                                                        {{-- <a href="{{ route('front.detail', ['amadeus' => $amadeus]) }}"
                                                        class="btn-select">Select</a> --}}
                                                    </div>
                                                </div>

                                            </div>
                                            <button class="border-0 bg-transparent py-2 btn-detail"
                                                data-index="{{ $index }}">Flight details</button>
                                        </div>

                                        <div class="d-none" id="hidable{{ $index }}">
                                            @foreach ($flightList->itineraries as $key => $itinerary)
                                                <div class="card-body m-0 ">
                                                    <div class="header-dr">
                                                        <div class="row d-flex align-items-center">
                                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 d-flex align-items-center">
                                                                <i
                                                                    class="fa-solid fa-plane fa-2x text-info {{ $key == 1 ? 'left' : '' }}"></i>
                                                                <h5 class="ml-2 text-upercase text-info">
                                                                    {{ $key == 1 ? 'return' : 'Depart' }}</h5>
                                                            </div>
                                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 d-flex justify-content-end">
                                                                <span class="departHead">{{ $key == 0 ? getCity(request('depart')) : getCity(request('destination')) }}</span>
                                                                ({{ $key == 0 ? request('depart') : request('destination') }})
                                                                - <span class="arrivedHead">{{ $key == 0 ? getCity(request('destination')) : getCity(request('depart')) }}</span>
                                                                ({{ $key == 0 ? request('destination') : request('depart') }})
                                                                |
                                                                <i class="fa-solid fa-chair px-2 mt-1"></i>
                                                                {{ $flightList->numberOfBookableSeats }} |
                                                                {{-- @if ($flightList->travelerPricings[0]->fareDetailsBySegment[0]->includedCheckedBags->weight == null)
                                                                <i class="fa-solid fa-suitcase-rolling px-2 mt-1"></i>
                                                                @php
                                                                    print_r($flightList->travelerPricings[0]->fareDetailsBySegment[0]->includedCheckedBags);
                                                                @endphp
                                                                {{ $flightList->travelerPricings[0]->fareDetailsBySegment[0]->includedCheckedBags->weightUnit }}
                                                            @endif --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @foreach ($itinerary->segments as $segment)
                                                        <div class="col-12 pt-2">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-2">
                                                                    <label class="mt-3 detail-airline">Buddha Air</label> <br>
                                                                    <span class="carrireCode">{{ $segment->carrierCode }}-{{ $segment->number }}</span>
                                                                </div>
                                                                <div class="p-2 border border-iata">
                                                                    {{ $segment->departure->iataCode }}
                                                                </div>
                                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                                                    <label
                                                                        class="time m-0 p-0"><b>{{ getTime($segment->departure->at) }}</b></label>
                                                                    <label
                                                                        class="m-0 p-0 getDatesDetail font-weight-normal">{{ getDates($segment->departure->at) }}</label>
                                                                    <br>
                                                                    <span class="getCityDetail">{{ getCity($segment->departure->iataCode) }}</span>
                                                                </div>
                                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                                                    <span class="d-flex justify-content-end hidable-getDate"><label
                                                                            class="time m-0 p-0"><b>{{ getTime($segment->arrival->at) }}</b></label>
                                                                        <label
                                                                            class="m-0 p-0 getDatesDetail font-weight-normal ">{{ getDates($segment->arrival->at) }}</label></span>
                                                                    <span
                                                                        class="d-flex justify-content-end getCityDetail">{{ getCity($segment->arrival->iataCode) }}</span>
                                                                </div>



                                                                <div class="p-2 border border-iata">
                                                                    {{ $segment->arrival->iataCode }}

                                                                </div>
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-1 p-0 m-0 ml-2">
                                                                    <label class="computeTime">{{ computeTime($segment->departure->at, $segment->arrival->at) }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if (!$loop->last)
                                                            <div class="hr1"></div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @php
                                        break;
                                    @endphp
                                @endforeach
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-1"></div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // DOM elements
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const flightCards = document.querySelectorAll(".listCard");
        const noStopCheckbox = document.getElementById("nonStop");
        const stopCheckbox = document.getElementById("stop");
        const minPriceInput = document.getElementById("minPrice");
        const maxPriceInput = document.getElementById("maxPrice");
        const earlyMorningCheckbox = document.getElementById("earlyMorning");
        const morningCheckbox = document.getElementById("morning");
        const afternoonCheckbox = document.getElementById("afternoon");
        const eveningCheckbox = document.getElementById("evening");

        // Event listeners
        noStopCheckbox.addEventListener("change", filterFlightCards);
        stopCheckbox.addEventListener("change", filterFlightCards);
        minPriceInput.addEventListener("input", filterFlightCards);
        maxPriceInput.addEventListener("input", filterFlightCards);
        earlyMorningCheckbox.addEventListener("change", departure);
        morningCheckbox.addEventListener("change", departure);
        afternoonCheckbox.addEventListener("change", departure);
        eveningCheckbox.addEventListener("change", departure);


        // Function to convert 12-hour time to 24-hour format
        function convertTo24HourFormat(time12Hour) {
            const [time, period] = time12Hour.split(' ');
            let [hours, minutes] = time.split(':');

            if (period === 'PM' && hours !== '12') {
                hours = String(Number(hours) + 12);
            } else if (period === 'AM' && hours === '12') {
                hours = '00';
            }

            // Pad with zeros if necessary
            hours = hours.padStart(2, '0');
            minutes = minutes.padStart(2, '0');

            return `${hours}:${minutes}:00`;
        }

        function departure() {
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        checkboxes.forEach(otherCheckbox => {
                            if (otherCheckbox !== this) {
                                otherCheckbox.checked = false;
                            }
                        });
                    }
                });
            });
            filterFlightCards();
        }
        // Function to filter flight cards
        function filterFlightCards() {
            // Get the current checkbox states
            const noStopChecked = noStopCheckbox.checked;
            const stopChecked = stopCheckbox.checked;
            const earlyMorningChecked = earlyMorningCheckbox.checked;
            const morningChecked = morningCheckbox.checked;
            const afternoonChecked = afternoonCheckbox.checked;
            const eveningChecked = eveningCheckbox.checked;

            flightCards.forEach((flightCard) => {
                // Extract relevant data from the flight card
                const price1 = parseInt(flightCard.querySelector(".priceNum").textContent);
                const time = flightCard.querySelector(".time").textContent;
                const price = flightCard.querySelector(".stopNum").textContent;
                const isNonStop = price === "Non Stop";
                const is1Stop = price === "1 Stop";
                const minPrice = parseInt(minPriceInput.value) || 0;
                const maxPrice = parseInt(maxPriceInput.value) || Infinity;
                const earlyFrom = convertTo24HourFormat(time);

                // Determine whether the card should be displayed
                let displayCard = true;

                if (earlyMorningChecked) {
                    const earlyFromTime = new Date(`2023-09-15T${earlyFrom}`);
                    const earlyMorningStart = new Date(`2023-09-15T00:00:00`);
                    const earlyMorningEnd = new Date(`2023-09-15T04:59:00`);
                    if (earlyFromTime >= earlyMorningStart && earlyFromTime <= earlyMorningEnd) {
                        displayCard = true; // Early Morning checkbox is checked
                    } else {
                        displayCard = false;
                    }
                }

                if (morningChecked) {
                    const earlyFromTime = new Date(`2023-09-15T${earlyFrom}`);
                    const earlyMorningStart = new Date(`2023-09-15T05:00:00`);
                    const earlyMorningEnd = new Date(`2023-09-15T11:59:00`);
                    if (earlyFromTime >= earlyMorningStart && earlyFromTime <= earlyMorningEnd) {
                        displayCard = true; // Early Morning checkbox is checked
                    } else {
                        displayCard = false;
                    }
                }
                if (afternoonChecked) {
                    const earlyFromTime = new Date(`2023-09-15T${earlyFrom}`);
                    const earlyMorningStart = new Date(`2023-09-15T12:00:00`);
                    const earlyMorningEnd = new Date(`2023-09-15T17:59:00`);
                    if (earlyFromTime >= earlyMorningStart && earlyFromTime <= earlyMorningEnd) {
                        displayCard = true; // Early Morning checkbox is checked
                    } else {
                        displayCard = false;
                    }
                }
                if (eveningChecked) {
                    const earlyFromTime = new Date(`2023-09-15T${earlyFrom}`);
                    const earlyMorningStart = new Date(`2023-09-15T18:00:00`);
                    const earlyMorningEnd = new Date(`2023-09-15T23:59:00`);
                    if (earlyFromTime >= earlyMorningStart && earlyFromTime <= earlyMorningEnd) {
                        displayCard = true; // Early Morning checkbox is checked
                    } else {
                        displayCard = false;
                    }
                }

                if (noStopChecked && isNonStop && displayCard) {
                    displayCard = true; // Non Stop checkbox is checked, and it's a Non Stop flight
                } else if (stopChecked && is1Stop && displayCard) {
                    displayCard = true; // 1 Stop checkbox is checked, and it's a 1 Stop flight
                } else if (!noStopChecked && !stopChecked && displayCard) {
                    displayCard = true; // Both checkboxes unchecked
                } else {
                    displayCard = false; // None of the conditions met
                }

                // Apply the final condition for displaying the card
                if (price1 >= minPrice && price1 <= maxPrice && displayCard) {
                    flightCard.style.display = "block"; // Show the card
                } else {
                    flightCard.style.display = "none"; // Hide the card
                }
            });
        }
    </script>
@endpush

@push('script')
    <script>
        $(".btn-detail").on('click', function() {
            var btnText = $(this).text();

            var indexVal = $(this).data('index');
            var id = "hidable" + indexVal;
            // alert(id);
            $("#" + id).toggleClass("d-none");
        })
        $("#btnFilter").on("click",function(){
            $("#filterList").toggleClass("active");
            $("#closeFilter").toggleClass("active");
        });

        $("#closeFilter").on("click",function(){
            $("#filterList").toggleClass("active");
            $("#closeFilter").toggleClass("active");
        });
    </script>
@endpush
