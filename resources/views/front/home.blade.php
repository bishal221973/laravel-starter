@extends('front.app')
@section('content')
    <section class="home-section">
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

        <div class="content-section">
            <div class="px-5 col-12 d-flex ">
                <div class="card col-xl-4">
                    <div class="card-body text-dark">
                        <form action="{{ route('front.list') }}" method="GET">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="way" checked id="inlineRadio1"
                                    value="rounde trip">
                                <label class="form-check-label mt-1 text-secondary text-uppercase" for="inlineRadio1">Round
                                    trip</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="way" required id="inlineRadio2"
                                    value="One Way">
                                <label class="form-check-label mt-1 text-secondary text-uppercase" for="inlineRadio2">One
                                    way</label>
                            </div>
                            <div class="row px-3 mt-1">
                                <div class="col-6 mb-4">

                                    <div class="wrapper">
                                        <label class="text-secondary text-uppercase">Origin :</label>

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
                                <div class="col-6 mb-4">

                                    <div class="wrapper ">
                                        <label class="text-secondary text-uppercase">Destination :</label>
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


                                <div class="row px-3">
                                    <div class="col-6 mb-4" id="departureDate">
                                        <div class="wrapper">
                                            <label class="text-secondary text-uppercase">Depart time :</label>
                                            <div class="search-input">
                                                <a href="" target="_blank" hidden></a>
                                                <input type="date" required name="departTime"
                                                    placeholder="Type to search..">
                                                <div class="icon"><i class="fa-solid fa-calendar-days"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-4" id="returnDate">
                                        <div class="wrapper">
                                            <label class="text-secondary text-uppercase">Return time :</label>
                                            <div class="search-input">
                                                <a href="" target="_blank" hidden></a>
                                                <input type="date" name="returnTime" placeholder="Type to search..">
                                                <div class="icon"><i class="fa-solid fa-calendar-days"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="adult" id="txtAdultNum" value="1">
                                    <input type="hidden" name="child" id="txtChildNum" value="0">
                                    <input type="hidden" name="infants" id="txtInfantNum" value="0">
                                    <div class="col-6 mb-4">
                                        <div class="wrapper">
                                            <label class="text-secondary text-uppercase">Passenger(s) :</label>
                                            <div class="search-input">
                                                <a href="" target="_blank" hidden></a>
                                                <input type="text" readonly value="1 passenger(s)"
                                                    placeholder="Type to search.." id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <label>Adults 11+ Years</label>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" class="btn1" id="adultSub">-</button>
                                                                <span id="adultNums" class="px-2">1</span>
                                                                <button type="button" class="btn1"
                                                                    id="adultAdd">+</button>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <label>Children 2 - 11 Years</label>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" class="btn1" id="childSub">-</button>
                                                                <span id="childNums" class="px-2">0</span>
                                                                <button type="button" class="btn1" id="childAdd">+</button>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <label>Infants < 2 Years</label>
                                                                    <div class="d-flex align-items-center">
                                                                        <button type="button" class="btn1" id="infantSub">-</button>
                                                                        <span class="px-2" id="infantNums">0</span>
                                                                        <button type="button" class="btn1" id="infantAdd">+</button>
                                                                    </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="icon"><i class="fa-solid fa-users"></i></div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-6 mb-4">
                                        <div class="wrapper">
                                            <label class="text-secondary text-uppercase">Cabin :</label>
                                            <div class="search-input">
                                                <a href="" target="_blank" hidden></a>
                                                <select name="cabin" id="" class="form-control">
                                                    <option value="Economy">Economy</option>
                                                    <option value="Permium Economy">Permium Economy</option>
                                                    <option value="Business">Business</option>
                                                    <option value="First">First</option>
                                                </select>
                                                <div class="icon"><i class="fa-solid fa-chair"></i></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <input type="submit" value="SEARCH FLIGHTS"
                                            class="btn btn-info col-12 py-4 fw-bold">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="ml-5" style="margin-left: 17%">
                    <span class="d-flex fw-bold" style="    font-family: 'Ubuntu', sans-serif;">
                        <h1 class="text-uppercase fw-bold">Welcome in <span class="text-danger">FlightsMojo</span>
                        </h1>
                    </span>
                    <span style="position: relative;top:-10px;letter-spacing: 1px;" class="signika"><i>Your Dream
                            Destinations, One Click Away!</i></span> <br>

                    <label style="letter-spacing: 1.5px;" class="col-xl-8 signika">"Seamless flight bookings, endless
                        destinations. Your journey begins here. Discover, compare, and reserve flights effortlessly with
                        our user-friendly platform. Elevate your travel experience today!"</label>

                    <div class="d-flex mt-5 pt-5 justify-content-center col-xl-6">
                        <a href="#" class="neon-button text-decoration-none" style="margin-left: 15%">Popular
                            Routes</a>
                    </div>
                </div>

            </div>


        </div>


    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();

            // Disable auto-close behavior
            $('.dropdown-menu').on('click', function(e) {
                e.stopPropagation();
            });


        });
    </script>

    <script>
        var adultNumber = 1;
        var childNumber = 0;
        var infantNumber = 0;
        $('#adultAdd').on('click', function() {
            // alert(adultNumber);
            if (adultNumber <= '11') {
                adultNumber = adultNumber+1;
                $("#adultNums").text(adultNumber);
                $('#txtAdultNum').val(adultNumber);
            }
        });
        $('#adultSub').on('click', function() {
            // alert(adultNumber);
            if (adultNumber >= '2') {
                adultNumber = adultNumber-1;
                $("#adultNums").text(adultNumber);
                $('#txtAdultNum').val(adultNumber);
            }
        });
        $('#childAdd').on('click', function() {
            // alert(adultNumber);
            if (childNumber <= '11') {
                childNumber = childNumber+1;
                $("#childNums").text(childNumber);
                $('#txtChildNum').val(childNumber);
            }
        });
        $('#childSub').on('click', function() {
            // alert(adultNumber);
            if (childNumber >= '1') {
                childNumber = childNumber-1;
                $("#childNums").text(childNumber);
                $('#txtChildNum').val(childNumber);
            }
        });
        $('#infantAdd').on('click', function() {
            // alert(adultNumber);
            if (infantNumber <= '11') {
                infantNumber = infantNumber+1;
                $("#infantNums").text(infantNumber);
                $('#txtInfantNum').val(infantNumber);
            }
        });
        $('#infantSub').on('click', function() {
            // alert(adultNumber);
            if (infantNumber >= '1') {
                infantNumber = infantNumber-1;
                $("#infantNums").text(infantNumber);
                $('#txtInfantNum').val(infantNumber);
            }
        });
    </script>
@endpush
