<div class="row bg-white py-5">
    <div class="col-xl-2"></div>
    <div class="col-xl-8">
        <h3 class="text-center">Popular Routes</h3>
        {{-- <label>Most searched </label> --}}

        <div class="row mt-5">
            @foreach ($routes as $route)
                <div class="col-xl-6 mb-3">
                    <a href="#" class="card text-dark" data-toggle="modal" data-target="#model{{ $route->id }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="m-0 p-0">{{ $route->from }}</h5>
                                    <span class="m-0 p-0">
                                        {{ getCity($route->from) }} , {{ getCountry($route->from) }}
                                    </span>
                                </div>
                                <div>
                                    <i class="fa-solid fa-plane-circle-check text-info" style="font-size: 30px"></i>
                                </div>
                                <div>
                                    <h5 class="m-0 p-0">{{ $route->to }}</h5>
                                    <span class="m-0 p-0">
                                        {{ getCity($route->to) }} , {{ getCountry($route->to) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>




                <div class="modal fade" id="model{{ $route->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{$route->from}} - {{$route->to}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('front.list') }}">
                                    <div class="row ml-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="way" checked
                                                id="roundUp1" value="rounde trip">
                                            <label class="form-check-label mt-1 text-secondary  text-uppercase label-12"
                                                for="roundUp1">Round
                                                trip</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="way" required
                                                id="oneWay1" value="One Way">
                                            <label class="form-check-label mt-1 text-secondary text-uppercase label-12"
                                                for="oneWay1">One
                                                way</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase label-13">Origin
                                                    :</label>
                                                <div class="search-input search-input1">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="text" readonly required
                                                        value="{{ getCity($route->from) }} , {{ getCountry($route->from) }}"
                                                        placeholder="First Name">
                                                </div>
                                                <input type="hidden" value="{{ $route->from }}" name="depart"
                                                    id="depart">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase label-13">Destination
                                                    :</label>
                                                <div class="search-input search-input1">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="text" readonly required
                                                        value="{{ getCity($route->to) }} , {{ getCountry($route->to) }}"
                                                        placeholder="First Name">
                                                </div>
                                                <input type="hidden" name="destination" value="{{ $route->to }}"
                                                    id="destination">

                                            </div>
                                        </div>

                                        <div class="col-md-6 col-6 mb-4" id="departureDate">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase label-12">Depart time
                                                    :</label>
                                                <div class="search-input">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="date" required name="departTime"
                                                        placeholder="Type to search.." class="font">
                                                    <div class="icon"><i class="fa-solid fa-calendar-days"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 mb-4" id="returnDate">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase label-12">Return time
                                                    :</label>
                                                <div class="search-input">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="date" id="returnDates1"  required name="returnTime"
                                                        placeholder="Type to search..">
                                                    <div class="icon"><i class="fa-solid fa-calendar-days"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <input type="hidden" name="adult" id="txtAdultNum1" value="1">
                                            <input type="hidden" name="child" id="txtChildNum1" value="0">
                                            <input type="hidden" name="infants" id="txtInfantNum1" value="0">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase label-12">Passenger(s)
                                                    :</label>
                                                <div class="search-input">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="text" readonly value="1 passenger(s)"
                                                        placeholder="Type to search.." id="dropdownMenuButton"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">
                                                            <div class="col-12 d-flex justify-content-between">
                                                                <label>Adults 11+ Years</label>
                                                                <div class="d-flex align-items-center">
                                                                    <button type="button" class="btn1"
                                                                        id="adultSub1">-</button>
                                                                    <span id="adultNums1" class="px-2">1</span>
                                                                    <button type="button" class="btn1"
                                                                        id="adultAdd1">+</button>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            <div class="col-12 d-flex justify-content-between">
                                                                <label>Children 2 - 11 Years</label>
                                                                <div class="d-flex align-items-center">
                                                                    <button type="button" class="btn1"
                                                                        id="childSub">-</button>
                                                                    <span id="childNums1" class="px-2">0</span>
                                                                    <button type="button" class="btn1"
                                                                        id="childAdd1">+</button>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            <div class="col-12 d-flex justify-content-between">
                                                                <label>Infants < 2 Years</label>
                                                                        <div class="d-flex align-items-center">
                                                                            <button type="button" class="btn1"
                                                                                id="infantSub">-</button>
                                                                            <span class="px-2"
                                                                                id="infantNums1">0</span>
                                                                            <button type="button" class="btn1"
                                                                                id="infantAdd1">+</button>
                                                                        </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="icon"><i class="fa-solid fa-users"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase label-12">Cabin :</label>
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
                                    </div>

                                    <input type="submit" value="Search" class="btn btn-info">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-xl-2"></div>
</div>
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
        $('#adultAdd1').on('click', function(e) {
            // alert(adultNumber);
            e.preventDefault();
            if (adultNumber <= '11') {

                adultNumber = adultNumber + 1;
                $("#adultNums1").text(adultNumber);
                $('#txtAdultNum1').val(adultNumber);
            }
        });
        $('#adultSub1').on('click', function(e) {
            e.preventDefault();
            if (adultNumber >= '2') {
                adultNumber = adultNumber - 1;
                $("#adultNums1").text(adultNumber);
                $('#txtAdultNum1').val(adultNumber);
            }
        });
        $('#childAdd1').on('click', function(e) {
            e.preventDefault();
            // alert(adultNumber);
            if (childNumber <= '11') {
                childNumber = childNumber + 1;
                $("#childNums1").text(childNumber);
                $('#txtChildNum1').val(childNumber);
            }
        });
        $('#childSub').on('click', function(e) {
            e.preventDefault();
            // alert(adultNumber);
            if (childNumber >= '1') {
                childNumber = childNumber - 1;
                $("#childNums1").text(childNumber);
                $('#txtChildNum1').val(childNumber);
            }
        });
        $('#infantAdd1').on('click', function(e) {
            e.preventDefault();
            // alert(adultNumber);
            if (infantNumber <= '11') {
                infantNumber = infantNumber + 1;
                $("#infantNums1").text(infantNumber);
                $('#txtInfantNum1').val(infantNumber);
            }
        });
        $('#infantSub').on('click', function(e) {
            e.preventDefault();
            // alert(adultNumber);
            if (infantNumber >= '1') {
                infantNumber = infantNumber - 1;
                $("#infantNums1").text(infantNumber);
                $('#txtInfantNum1').val(infantNumber);
            }
        });
    </script>
    <script>
        var roundUp1 = document.getElementById("roundUp1");
        var oneWay1 = document.getElementById("oneWay1");
        var returnDate1 = document.getElementById("returnDates1" );

        // Add event listeners to each radio button
        roundUp1.addEventListener("change", function(e) {
            e.preventDefault();
            if (roundUp1.checked) {
                returnDate1.disabled = false; // Enable the input
            }
        });

        oneWay1.addEventListener("change", function(e) {
            e.preventDefault();
            if (oneWay1.checked) {
                returnDate1.disabled = true; // Disable the input
            }
        });
    </script>
@endpush
