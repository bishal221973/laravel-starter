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
                        <form action="" method="GET">

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
                                        {{-- <div class="search-input">
                                            <a href="" target="_blank" hidden></a>
                                            <input required type="text" list="destinationDataList" name="destination"
                                                placeholder="CITY CODE">
                                            <div class="icon"><i class="fa-solid fa-plane-arrival"></i></div>
                                            <datalist id="destinationDataList">
                                            </datalist>
                                        </div> --}}

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

                                    <div class="col-6 mb-4">
                                        <div class="wrapper">
                                            <label class="text-secondary text-uppercase">Passenger(s) :</label>
                                            <div class="search-input">
                                                <a href="" target="_blank" hidden></a>
                                                <input type="text" readonly value="1 passenger(s)"
                                                    placeholder="Type to search..">
                                                <div class="icon"><i class="fa-solid fa-users"></i></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
                                        data-keyboard="false" data-backdrop="static">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">

                                                <div class="modal-body">
                                                    <h4 class="text-uppercase fw-bold mb-5">Passanger</h4>

                                                    <div class="d-flex justify-content-between mb-3 border-bottom py-3">
                                                        <label>Adults 11+ Years</label>
                                                        <div class="d-flex">
                                                            <span class="btn-minus mx-3"><i
                                                                    class="fa-solid fa-minus"></i></span>
                                                            <span class="fw-bold">1</span>
                                                            <span class="btn-plus mx-3"><i
                                                                    class="fa-solid fa-plus"></i></span>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between mb-3 border-bottom py-3">
                                                        <label>Children 2-11 Years</label>
                                                        <div class="d-flex">
                                                            <span class="btn-minus mx-3"><i
                                                                    class="fa-solid fa-minus"></i></span>
                                                            <span class="fw-bold">0</span>
                                                            <span class="btn-plus mx-3"><i
                                                                    class="fa-solid fa-plus"></i></span>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between mb-3 border-bottom py-3">
                                                        <label>Infants Less then 2 Years</label>
                                                        <div class="d-flex">
                                                            <span class="btn-minus mx-3"><i
                                                                    class="fa-solid fa-minus"></i></span>
                                                            <span class="fw-bold">0</span>
                                                            <span class="btn-plus mx-3"><i
                                                                    class="fa-solid fa-plus"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-center">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

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
