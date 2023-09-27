@php
    $firstDate = '';
    $lastDate = '';
    $from = '';
    $to = '';
@endphp
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
@extends('front.app')
@section('content')
    <section class="home-section home-section1">
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

        <div class="content-section content-section1" >

        </div>
    </section>
    {{-- @if (session()->has('error'))
        @php
            $errors = session()->get('error');
        @endphp
        @foreach ($errors as $error)
            @php
                print_r($error);

            @endphp
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
    @endif --}}
    @if (session()->has('error'))
        @php
            $errors = session()->get('error');
            $errorMessages = [];

            foreach ($errors as $error) {
                $errorMessages[] = $error['detail'];
            }
        @endphp

        @if (!empty($errorMessages))
            @push('script')
                @foreach ($errorMessages as $errorMessage)
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
                        });

                        // Display each error message in a Toast notification
                        Toast.fire({
                            icon: 'error',
                            title: '{{ $errorMessage }}'
                        });
                    </script>
                @endforeach
            @endpush
        @endif
    @endif


    <div class="row mt-5">
        <div class="col-xl-1 col-lg-12"></div>
        <div class="col-xl-10 col-lg-12">
            <div class="row">
                <div class="col-xl-9 col-lg-9">
                    <form action="{{ route('front.book') }}" method="POST">
                        @csrf
                        {{-- ====================Flight details=======================  --}}
                        <div class="card mb-2 listCard">
                            <div class="card-header bg-info text-white">
                                <h5 class="text-uppercase text-muted py-2 label-15">Flight Itinerary</h5>
                            </div>
                            @foreach ($flightDetail->data->flightOffers[0]->itineraries as $key => $itinerary)
                                <input type="hidden" value="{{ $itinerary->segments[0]->departure->iataCode }}" name="departure">
                                <input type="hidden" value="{{ $itinerary->segments[0]->departure->at }}" name="departureTime">
                                @foreach ($itinerary->segments as $segment)
                                    @if ($loop->first)
                                        @php
                                            $from = $segment->departure->iataCode;
                                        @endphp
                                    @endif
                                    @if ($loop->last)
                                        @php
                                            $to = $segment->arrival->iataCode;
                                        @endphp
                                    @endif
                                @endforeach

                                <div class="card-body m-0 ">
                                    <div class="header-dr">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 d-flex align-items-center">
                                                <i
                                                    class="fa-solid fa-plane fa-2x text-info  icon2 {{ $key == 1 ? 'left' : '' }}"></i>
                                                <h5 class="ml-2 text-upercase text-info label-15">
                                                    {{ $key == 1 ? 'return' : 'Depart' }}</h5>
                                            </div>
                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 d-flex justify-content-end">
                                                <span
                                                    class="departHead label-13">{{ $key == 0 ? getCity($from) : getCity($to) }}</span>
                                                <span class="label-13">({{ $key == 0 ? $from : $to }})</span>
                                                - <span
                                                    class="arrivedHead label-13">{{ $key == 0 ? getCity($to) : getCity($from) }}</span>
                                                <span class="label-13">({{ $key == 0 ? $to : $from }})</span>
                                                <span class="label-13">|</span>
                                                <i class="fa-solid label-13 fa-suitcase-rolling px-2 mt-1"></i>
                                                <span class="label-13">{{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->fareDetailsBySegment[0]->includedCheckedBags->weight }}
                                                    {{ $flightDetail->data->flightOffers[0]->travelerPricings[0]->fareDetailsBySegment[0]->includedCheckedBags->weightUnit }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($itinerary->segments as $segment)
                                        <div class="col-12 pt-2">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-2">
                                                    <label class="mt-3 arrivedHead label-13">{{getAirport($segment->departure->iataCode)}}</label> <br>
                                                    <span class="label-13">{{ $segment->carrierCode }}-{{ $segment->number }}</span>
                                                </div>
                                                <div class="p-2 label-13 border flightIatacode arrivedHead">
                                                    {{ $segment->departure->iataCode }}
                                                </div>
                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <label
                                                        class="time label-12 m-0 p-0 font-15"><b>{{ getTime($segment->departure->at) }}</b></label>
                                                    <label
                                                        class="m-0 label-12 p-0 font-weight-normal font-14">{{ getDates($segment->departure->at) }}</label>
                                                    <br>
                                                    <span
                                                        class="font-15 label-13">{{ getCity($segment->departure->iataCode) }}</span>
                                                </div>
                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 arrivedHead"></div>
                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <span class="d-flex justify-content-end"><label
                                                            class="time label-12 m-0 p-0 font-15"><b>{{ getTime($segment->arrival->at) }}</b></label>
                                                        &nbsp;
                                                        <label
                                                            class="m-0 label-12 p-0 font-weight-normal font-14">{{ getDates($segment->arrival->at) }}</label></span>
                                                    <span
                                                        class="d-flex label-13 justify-content-end font-15">{{ getCity($segment->arrival->iataCode) }}</span>
                                                </div>



                                                <div class="p-2 label-13 border flightIatacode arrivedHead">
                                                    {{ $segment->arrival->iataCode }}

                                                </div>
                                                <div class="col-xl-2 col-lg-1 col-md-1 col-sm-1 col-1 p-0 m-0">
                                                    <label
                                                        class="col-12 label-13 d-flex p-0 m-0 justify-content-end">{{ computeTime($segment->departure->at, $segment->arrival->at) }}</label>
                                                </div>

                                            </div>
                                        </div>
                                        @if (!$loop->last)
                                            <div class="hr1">
                                                <input type="hidden" value="{{ $segment->arrival->iataCode }}"
                                                    name="departure">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        {{-- ==========================Passenger detail================================ --}}
                        <div class="card mb-2 listCard">
                            <div class="card-header bg-info text-white">
                                <h5 class="text-uppercase text-muted py-2 label-15">Passenger Details</h5>
                            </div>

                            @foreach ($flightDetail->data->flightOffers[0]->travelerPricings as $key => $traveler)
                                @php
                                    $totalAdults = $totalAdults + 1;
                                @endphp
                                @if ($traveler->travelerType == 'ADULT')
                                    @php
                                        $adultNum = $adultNum + 1;
                                        $adultTotalPrice = $adultTotalPrice + $traveler->price->total;
                                        $adultBasePrice = $adultBasePrice + $traveler->price->base;
                                        $loop1 = $traveler->price->taxes;
                                    @endphp

                                    @foreach ($loop1 as $tax)
                                        @php
                                            $adultTotalotalTax = $adultTotalotalTax + $tax->amount;
                                        @endphp
                                    @endforeach
                                @endif

                                @if ($traveler->travelerType == 'CHILD')
                                    @php
                                        $childNum = $childNum + 1;
                                        $childTotalPrice = $childTotalPrice + $traveler->price->total;
                                        $childBasePrice = $childBasePrice + $traveler->price->base;
                                        $loop1 = $traveler->price->taxes;
                                    @endphp


                                    @foreach ($loop1 as $tax)
                                        @php
                                            $childTotalotalTax = $childTotalotalTax + $tax->amount;
                                        @endphp
                                    @endforeach
                                @endif

                                @if ($traveler->travelerType == 'HELD_INFANT')
                                    @php
                                        $infantNum = $infantNum + 1;
                                        $infantTotalPrice = $infantTotalPrice + $traveler->price->total;
                                        $infantBasePrice = $infantBasePrice + $traveler->price->base;
                                        $loop1 = $traveler->price->taxes;
                                    @endphp


                                    @foreach ($loop1 as $tax)
                                        @php
                                            $infantTotalotalTax = $infantTotalotalTax + $tax->amount;
                                        @endphp
                                    @endforeach
                                @endif
                            @endforeach
                            {{-- @foreach ($flightDetail->data->flightOffers[0]->travelerPricings as $key => $traveler) --}}
                            <div class="card-body m-0 card-body-1 zero">
                                {{-- =============================Adult===================== --}}
                                @if ($adultNum > 0)
                                    {{-- Adult passenger --}} <br>
                                    <label class="text-uppercase text-info pb-2 zero label-13">Adult Passengers
                                        ({{ $adultNum }})
                                    </label>
                                    @for ($i = 0; $i < $adultNum; $i++)
                                        <input type="hidden" name="travelerType[]" value="Adult">
                                        <div class="row mb-3">
                                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">First Name
                                                    </label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <input type="text" name="first_name[]" value=""
                                                            placeholder="First Name" required>
                                                    </div>

                                                    {{-- <div class="col-xl-4 mb-4">
                                                        <div class="wrapper">
                                                            <label class="text-secondary text-uppercase">Middle Name
                                                                :</label>
                                                            <div class="search-input search-input1">
                                                                <a href="" target="_blank" hidden></a>
                                                                <input type="text" name="middle_name[]" value=""
                                                                    placeholder="Middle Name">
                                                            </div>
                                                        </div>
                                                    </div> --}}

                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">

                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">Last Name
                                                    </label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <input type="text" name="last_name[]" required value=""
                                                            placeholder="Last Name">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">Gender</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <select id="" name="gender[]" required
                                                            class="form-control">
                                                            <option value="MALE">Male</option>
                                                            <option value="FEMALE">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">DOB</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <input type="date" name="dob[]" required value=""
                                                            placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">Password Number
                                                        :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <input type="number" name="password_number[]" value=""
                                                            placeholder="Password Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">Expiry Date :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <input type="date" name="expiry_date[]" value=""
                                                            placeholder="Expiry Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">Issue Country
                                                        :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <select name="issueCountry[]" class="form-control"
                                                            id="">
                                                            <option value="GB" Selected>UK (GB)</option>
                                                            <option value="US">USA (US)</option>
                                                            <optgroup label="Other countries">
                                                                <option value="DZ">Algeria (DZ)</option>
                                                                <option value="AD">Andorra (AD)</option>
                                                                <option value="AO">Angola (AO)</option>
                                                                <option value="AI">Anguilla (AI)</option>
                                                                <option value="AG">Antigua &amp; Barbuda (AG)
                                                                </option>
                                                                <option value="AR">Argentina (AR)</option>
                                                                <option value="AM">Armenia (AM)</option>
                                                                <option value="AW">Aruba (AW)</option>
                                                                <option value="AU">Australia (AU)</option>
                                                                <option value="AT">Austria (AT)</option>
                                                                <option value="AZ">Azerbaijan (AZ)</option>
                                                                <option value="BS">Bahamas (BS)</option>
                                                                <option value="BH">Bahrain (BH)</option>
                                                                <option value="BD">Bangladesh (BD)</option>
                                                                <option value="BB">Barbados (BB)</option>
                                                                <option value="BY">Belarus (BY)</option>
                                                                <option value="BE">Belgium (BE)</option>
                                                                <option value="BZ">Belize (BZ)</option>
                                                                <option value="BJ">Benin (BJ)</option>
                                                                <option value="BM">Bermuda (BM)</option>
                                                                <option value="BT">Bhutan (BT)</option>
                                                                <option value="BO">Bolivia (BO)</option>
                                                                <option value="BA">Bosnia Herzegovina (BA)</option>
                                                                <option value="BW">Botswana (BW)</option>
                                                                <option value="BR">Brazil (BR)</option>
                                                                <option value="BN">Brunei (BN)</option>
                                                                <option value="BG">Bulgaria (BG)</option>
                                                                <option value="BF">Burkina Faso (BF)</option>
                                                                <option value="BI">Burundi (BI)</option>
                                                                <option value="KH">Cambodia (KH)</option>
                                                                <option value="CM">Cameroon (CM)</option>
                                                                <option value="CA">Canada (CA)</option>
                                                                <option value="CV">Cape Verde Islands (CV)</option>
                                                                <option value="KY">Cayman Islands (KY)</option>
                                                                <option value="CF">Central African Republic (CF)
                                                                </option>
                                                                <option value="CL">Chile (CL)</option>
                                                                <option value="CN">China (CN)</option>
                                                                <option value="CO">Colombia (CO)</option>
                                                                <option value="KM">Comoros (KM)</option>
                                                                <option value="CG">Congo (CG)</option>
                                                                <option value="CK">Cook Islands (CK)</option>
                                                                <option value="CR">Costa Rica (CR)</option>
                                                                <option value="HR">Croatia (HR)</option>
                                                                <option value="CU">Cuba (CU)</option>
                                                                <option value="CY">Cyprus North (CY)</option>
                                                                <option value="CY">Cyprus South (CY)</option>
                                                                <option value="CZ">Czech Republic (CZ)</option>
                                                                <option value="DK">Denmark (DK)</option>
                                                                <option value="DJ">Djibouti (DJ)</option>
                                                                <option value="DM">Dominica (DM)</option>
                                                                <option value="DO">Dominican Republic (DO)</option>
                                                                <option value="EC">Ecuador (EC)</option>
                                                                <option value="EG">Egypt (EG)</option>
                                                                <option value="SV">El Salvador (SV)</option>
                                                                <option value="GQ">Equatorial Guinea (GQ)</option>
                                                                <option value="ER">Eritrea (ER)</option>
                                                                <option value="EE">Estonia (EE)</option>
                                                                <option value="ET">Ethiopia (ET)</option>
                                                                <option value="FK">Falkland Islands (FK)</option>
                                                                <option value="FO">Faroe Islands (FO)</option>
                                                                <option value="FJ">Fiji (FJ)</option>
                                                                <option value="FI">Finland (FI)</option>
                                                                <option value="FR">France (FR)</option>
                                                                <option value="GF">French Guiana (GF)</option>
                                                                <option value="PF">French Polynesia (PF)</option>
                                                                <option value="GA">Gabon (GA)</option>
                                                                <option value="GM">Gambia (GM)</option>
                                                                <option value="GE">Georgia (GE)</option>
                                                                <option value="DE">Germany (DE)</option>
                                                                <option value="GH">Ghana (GH)</option>
                                                                <option value="GI">Gibraltar (GI)</option>
                                                                <option value="GR">Greece (GR)</option>
                                                                <option value="GL">Greenland (GL)</option>
                                                                <option value="GD">Grenada (GD)</option>
                                                                <option value="GP">Guadeloupe (GP)</option>
                                                                <option value="GU">Guam (GU)</option>
                                                                <option value="GT">Guatemala (GT)</option>
                                                                <option value="GN">Guinea (GN)</option>
                                                                <option value="GW">Guinea - Bissau (GW)</option>
                                                                <option value="GY">Guyana (GY)</option>
                                                                <option value="HT">Haiti (HT)</option>
                                                                <option value="HN">Honduras (HN)</option>
                                                                <option value="HK">Hong Kong (HK)</option>
                                                                <option value="HU">Hungary (HU)</option>
                                                                <option value="IS">Iceland (IS)</option>
                                                                <option value="IN">India (IN)</option>
                                                                <option value="ID">Indonesia (ID)</option>
                                                                <option value="IR">Iran (IR)</option>
                                                                <option value="IQ">Iraq (IQ)</option>
                                                                <option value="IE">Ireland (IE)</option>
                                                                <option value="IL">Israel (IL)</option>
                                                                <option value="IT">Italy (IT)</option>
                                                                <option value="JM">Jamaica (JM)</option>
                                                                <option value="JP">Japan (JP)</option>
                                                                <option value="JO">Jordan (JO)</option>
                                                                <option value="KZ">Kazakhstan (KZ)</option>
                                                                <option value="KE">Kenya (KE)</option>
                                                                <option value="KI">Kiribati (KI)</option>
                                                                <option value="KP">Korea North (KP)</option>
                                                                <option value="KR">Korea South (KR)</option>
                                                                <option value="KW">Kuwait (KW)</option>
                                                                <option value="KG">Kyrgyzstan (KG)</option>
                                                                <option value="LA">Laos (LA)</option>
                                                                <option value="LV">Latvia (LV)</option>
                                                                <option value="LB">Lebanon (LB)</option>
                                                                <option value="LS">Lesotho (LS)</option>
                                                                <option value="LR">Liberia (LR)</option>
                                                                <option value="LY">Libya (LY)</option>
                                                                <option value="LI">Liechtenstein (LI)</option>
                                                                <option value="LT">Lithuania (LT)</option>
                                                                <option value="LU">Luxembourg (LU)</option>
                                                                <option value="MO">Macao (MO)</option>
                                                                <option value="MK">Macedonia (MK)</option>
                                                                <option value="MG">Madagascar (MG)</option>
                                                                <option value="MW">Malawi (MW)</option>
                                                                <option value="MY">Malaysia (MY)</option>
                                                                <option value="MV">Maldives (MV)</option>
                                                                <option value="ML">Mali (ML)</option>
                                                                <option value="MT">Malta (MT)</option>
                                                                <option value="MH">Marshall Islands (MH)</option>
                                                                <option value="MQ">Martinique (MQ)</option>
                                                                <option value="MR">Mauritania (MR)</option>
                                                                <option value="YT">Mayotte (YT)</option>
                                                                <option value="MX">Mexico (MX)</option>
                                                                <option value="FM">Micronesia (FM)</option>
                                                                <option value="MD">Moldova (MD)</option>
                                                                <option value="MC">Monaco (MC)</option>
                                                                <option value="MN">Mongolia (MN)</option>
                                                                <option value="MS">Montserrat (MS)</option>
                                                                <option value="MA">Morocco (MA)</option>
                                                                <option value="MZ">Mozambique (MZ)</option>
                                                                <option value="MN">Myanmar (MN)</option>
                                                                <option value="NA">Namibia (NA)</option>
                                                                <option value="NR">Nauru (NR)</option>
                                                                <option value="NP">Nepal (NP)</option>
                                                                <option value="NL">Netherlands (NL)</option>
                                                                <option value="NC">New Caledonia (NC)</option>
                                                                <option value="NZ">New Zealand (NZ)</option>
                                                                <option value="NI">Nicaragua (NI)</option>
                                                                <option value="NE">Niger (NE)</option>
                                                                <option value="NG">Nigeria (NG)</option>
                                                                <option value="NU">Niue (NU)</option>
                                                                <option value="NF">Norfolk Islands (NF)</option>
                                                                <option value="NP">Northern Marianas (NP)</option>
                                                                <option value="NO">Norway (NO)</option>
                                                                <option value="OM">Oman (OM)</option>
                                                                <option value="PW">Palau (PW)</option>
                                                                <option value="PA">Panama (PA)</option>
                                                                <option value="PG">Papua New Guinea (PG)</option>
                                                                <option value="PY">Paraguay (PY)</option>
                                                                <option value="PE">Peru (PE)</option>
                                                                <option value="PH">Philippines (PH)</option>
                                                                <option value="PL">Poland (PL)</option>
                                                                <option value="PT">Portugal (PT)</option>
                                                                <option value="PR">Puerto Rico (PR)</option>
                                                                <option value="QA">Qatar (QA)</option>
                                                                <option value="RE">Reunion (RE)</option>
                                                                <option value="RO">Romania (RO)</option>
                                                                <option value="RU">Russia (RU)</option>
                                                                <option value="RW">Rwanda (RW)</option>
                                                                <option value="SM">San Marino (SM)</option>
                                                                <option value="ST">Sao Tome &amp; Principe (ST)
                                                                </option>
                                                                <option value="SA">Saudi Arabia (SA)</option>
                                                                <option value="SN">Senegal (SN)</option>
                                                                <option value="CS">Serbia (CS)</option>
                                                                <option value="SC">Seychelles (SC)</option>
                                                                <option value="SL">Sierra Leone (SL)</option>
                                                                <option value="SG">Singapore (SG)</option>
                                                                <option value="SK">Slovak Republic (SK)</option>
                                                                <option value="SI">Slovenia (SI)</option>
                                                                <option value="SB">Solomon Islands (SB)</option>
                                                                <option value="SO">Somalia (SO)</option>
                                                                <option value="ZA">South Africa (ZA)</option>
                                                                <option value="ES">Spain (ES)</option>
                                                                <option value="LK">Sri Lanka (LK)</option>
                                                                <option value="SH">St. Helena (SH)</option>
                                                                <option value="KN">St. Kitts (KN)</option>
                                                                <option value="SC">St. Lucia (SC)</option>
                                                                <option value="SD">Sudan (SD)</option>
                                                                <option value="SR">Suriname (SR)</option>
                                                                <option value="SZ">Swaziland (SZ)</option>
                                                                <option value="SE">Sweden (SE)</option>
                                                                <option value="CH">Switzerland (CH)</option>
                                                                <option value="SI">Syria (SI)</option>
                                                                <option value="TW">Taiwan (TW)</option>
                                                                <option value="TJ">Tajikstan (TJ)</option>
                                                                <option value="TH">Thailand (TH)</option>
                                                                <option value="TG">Togo (TG)</option>
                                                                <option value="TO">Tonga (TO)</option>
                                                                <option value="TT">Trinidad &amp; Tobago (TT)
                                                                </option>
                                                                <option value="TN">Tunisia (TN)</option>
                                                                <option value="TR">Turkey (TR)</option>
                                                                <option value="TM">Turkmenistan (TM)</option>
                                                                <option value="TM">Turkmenistan (TM)</option>
                                                                <option value="TC">Turks &amp; Caicos Islands (TC)
                                                                </option>
                                                                <option value="TV">Tuvalu (TV)</option>
                                                                <option value="UG">Uganda (UG)</option>
                                                                <!-- <option value="GB">UK (GB)</option> -->
                                                                <option value="UA">Ukraine (UA)</option>
                                                                <option value="AE">United Arab Emirates (AE)
                                                                </option>
                                                                <option value="UY">Uruguay (UY)</option>
                                                                <!-- <option value="US">USA (US)</option> -->
                                                                <option value="UZ">Uzbekistan (UZ)</option>
                                                                <option value="VU">Vanuatu (VU)</option>
                                                                <option value="VA">Vatican City (VA)</option>
                                                                <option value="VE">Venezuela (VE)</option>
                                                                <option value="VN">Vietnam (VN)</option>
                                                                <option value="VG">Virgin Islands - British (VG)
                                                                </option>
                                                                <option value="VI">Virgin Islands - US (VI)
                                                                </option>
                                                                <option value="WF">Wallis &amp; Futuna (WF)
                                                                </option>
                                                                <option value="YE">Yemen (North)(YE)</option>
                                                                <option value="YE">Yemen (South)(YE)</option>
                                                                <option value="ZM">Zambia (ZM)</option>
                                                                <option value="ZW">Zimbabwe (ZW)</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">Nationality :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <select name="nationality[]" required class="form-control"
                                                            id="">
                                                            <option value="GB" Selected>UK (GB)</option>
                                                            <option value="US">USA (US)</option>
                                                            <optgroup label="Other countries">
                                                                <option value="DZ">Algeria (DZ)</option>
                                                                <option value="AD">Andorra (AD)</option>
                                                                <option value="AO">Angola (AO)</option>
                                                                <option value="AI">Anguilla (AI)</option>
                                                                <option value="AG">Antigua &amp; Barbuda (AG)
                                                                </option>
                                                                <option value="AR">Argentina (AR)</option>
                                                                <option value="AM">Armenia (AM)</option>
                                                                <option value="AW">Aruba (AW)</option>
                                                                <option value="AU">Australia (AU)</option>
                                                                <option value="AT">Austria (AT)</option>
                                                                <option value="AZ">Azerbaijan (AZ)</option>
                                                                <option value="BS">Bahamas (BS)</option>
                                                                <option value="BH">Bahrain (BH)</option>
                                                                <option value="BD">Bangladesh (BD)</option>
                                                                <option value="BB">Barbados (BB)</option>
                                                                <option value="BY">Belarus (BY)</option>
                                                                <option value="BE">Belgium (BE)</option>
                                                                <option value="BZ">Belize (BZ)</option>
                                                                <option value="BJ">Benin (BJ)</option>
                                                                <option value="BM">Bermuda (BM)</option>
                                                                <option value="BT">Bhutan (BT)</option>
                                                                <option value="BO">Bolivia (BO)</option>
                                                                <option value="BA">Bosnia Herzegovina (BA)</option>
                                                                <option value="BW">Botswana (BW)</option>
                                                                <option value="BR">Brazil (BR)</option>
                                                                <option value="BN">Brunei (BN)</option>
                                                                <option value="BG">Bulgaria (BG)</option>
                                                                <option value="BF">Burkina Faso (BF)</option>
                                                                <option value="BI">Burundi (BI)</option>
                                                                <option value="KH">Cambodia (KH)</option>
                                                                <option value="CM">Cameroon (CM)</option>
                                                                <option value="CA">Canada (CA)</option>
                                                                <option value="CV">Cape Verde Islands (CV)</option>
                                                                <option value="KY">Cayman Islands (KY)</option>
                                                                <option value="CF">Central African Republic (CF)
                                                                </option>
                                                                <option value="CL">Chile (CL)</option>
                                                                <option value="CN">China (CN)</option>
                                                                <option value="CO">Colombia (CO)</option>
                                                                <option value="KM">Comoros (KM)</option>
                                                                <option value="CG">Congo (CG)</option>
                                                                <option value="CK">Cook Islands (CK)</option>
                                                                <option value="CR">Costa Rica (CR)</option>
                                                                <option value="HR">Croatia (HR)</option>
                                                                <option value="CU">Cuba (CU)</option>
                                                                <option value="CY">Cyprus North (CY)</option>
                                                                <option value="CY">Cyprus South (CY)</option>
                                                                <option value="CZ">Czech Republic (CZ)</option>
                                                                <option value="DK">Denmark (DK)</option>
                                                                <option value="DJ">Djibouti (DJ)</option>
                                                                <option value="DM">Dominica (DM)</option>
                                                                <option value="DO">Dominican Republic (DO)</option>
                                                                <option value="EC">Ecuador (EC)</option>
                                                                <option value="EG">Egypt (EG)</option>
                                                                <option value="SV">El Salvador (SV)</option>
                                                                <option value="GQ">Equatorial Guinea (GQ)</option>
                                                                <option value="ER">Eritrea (ER)</option>
                                                                <option value="EE">Estonia (EE)</option>
                                                                <option value="ET">Ethiopia (ET)</option>
                                                                <option value="FK">Falkland Islands (FK)</option>
                                                                <option value="FO">Faroe Islands (FO)</option>
                                                                <option value="FJ">Fiji (FJ)</option>
                                                                <option value="FI">Finland (FI)</option>
                                                                <option value="FR">France (FR)</option>
                                                                <option value="GF">French Guiana (GF)</option>
                                                                <option value="PF">French Polynesia (PF)</option>
                                                                <option value="GA">Gabon (GA)</option>
                                                                <option value="GM">Gambia (GM)</option>
                                                                <option value="GE">Georgia (GE)</option>
                                                                <option value="DE">Germany (DE)</option>
                                                                <option value="GH">Ghana (GH)</option>
                                                                <option value="GI">Gibraltar (GI)</option>
                                                                <option value="GR">Greece (GR)</option>
                                                                <option value="GL">Greenland (GL)</option>
                                                                <option value="GD">Grenada (GD)</option>
                                                                <option value="GP">Guadeloupe (GP)</option>
                                                                <option value="GU">Guam (GU)</option>
                                                                <option value="GT">Guatemala (GT)</option>
                                                                <option value="GN">Guinea (GN)</option>
                                                                <option value="GW">Guinea - Bissau (GW)</option>
                                                                <option value="GY">Guyana (GY)</option>
                                                                <option value="HT">Haiti (HT)</option>
                                                                <option value="HN">Honduras (HN)</option>
                                                                <option value="HK">Hong Kong (HK)</option>
                                                                <option value="HU">Hungary (HU)</option>
                                                                <option value="IS">Iceland (IS)</option>
                                                                <option value="IN">India (IN)</option>
                                                                <option value="ID">Indonesia (ID)</option>
                                                                <option value="IR">Iran (IR)</option>
                                                                <option value="IQ">Iraq (IQ)</option>
                                                                <option value="IE">Ireland (IE)</option>
                                                                <option value="IL">Israel (IL)</option>
                                                                <option value="IT">Italy (IT)</option>
                                                                <option value="JM">Jamaica (JM)</option>
                                                                <option value="JP">Japan (JP)</option>
                                                                <option value="JO">Jordan (JO)</option>
                                                                <option value="KZ">Kazakhstan (KZ)</option>
                                                                <option value="KE">Kenya (KE)</option>
                                                                <option value="KI">Kiribati (KI)</option>
                                                                <option value="KP">Korea North (KP)</option>
                                                                <option value="KR">Korea South (KR)</option>
                                                                <option value="KW">Kuwait (KW)</option>
                                                                <option value="KG">Kyrgyzstan (KG)</option>
                                                                <option value="LA">Laos (LA)</option>
                                                                <option value="LV">Latvia (LV)</option>
                                                                <option value="LB">Lebanon (LB)</option>
                                                                <option value="LS">Lesotho (LS)</option>
                                                                <option value="LR">Liberia (LR)</option>
                                                                <option value="LY">Libya (LY)</option>
                                                                <option value="LI">Liechtenstein (LI)</option>
                                                                <option value="LT">Lithuania (LT)</option>
                                                                <option value="LU">Luxembourg (LU)</option>
                                                                <option value="MO">Macao (MO)</option>
                                                                <option value="MK">Macedonia (MK)</option>
                                                                <option value="MG">Madagascar (MG)</option>
                                                                <option value="MW">Malawi (MW)</option>
                                                                <option value="MY">Malaysia (MY)</option>
                                                                <option value="MV">Maldives (MV)</option>
                                                                <option value="ML">Mali (ML)</option>
                                                                <option value="MT">Malta (MT)</option>
                                                                <option value="MH">Marshall Islands (MH)</option>
                                                                <option value="MQ">Martinique (MQ)</option>
                                                                <option value="MR">Mauritania (MR)</option>
                                                                <option value="YT">Mayotte (YT)</option>
                                                                <option value="MX">Mexico (MX)</option>
                                                                <option value="FM">Micronesia (FM)</option>
                                                                <option value="MD">Moldova (MD)</option>
                                                                <option value="MC">Monaco (MC)</option>
                                                                <option value="MN">Mongolia (MN)</option>
                                                                <option value="MS">Montserrat (MS)</option>
                                                                <option value="MA">Morocco (MA)</option>
                                                                <option value="MZ">Mozambique (MZ)</option>
                                                                <option value="MN">Myanmar (MN)</option>
                                                                <option value="NA">Namibia (NA)</option>
                                                                <option value="NR">Nauru (NR)</option>
                                                                <option value="NP">Nepal (NP)</option>
                                                                <option value="NL">Netherlands (NL)</option>
                                                                <option value="NC">New Caledonia (NC)</option>
                                                                <option value="NZ">New Zealand (NZ)</option>
                                                                <option value="NI">Nicaragua (NI)</option>
                                                                <option value="NE">Niger (NE)</option>
                                                                <option value="NG">Nigeria (NG)</option>
                                                                <option value="NU">Niue (NU)</option>
                                                                <option value="NF">Norfolk Islands (NF)</option>
                                                                <option value="NP">Northern Marianas (NP)</option>
                                                                <option value="NO">Norway (NO)</option>
                                                                <option value="OM">Oman (OM)</option>
                                                                <option value="PW">Palau (PW)</option>
                                                                <option value="PA">Panama (PA)</option>
                                                                <option value="PG">Papua New Guinea (PG)</option>
                                                                <option value="PY">Paraguay (PY)</option>
                                                                <option value="PE">Peru (PE)</option>
                                                                <option value="PH">Philippines (PH)</option>
                                                                <option value="PL">Poland (PL)</option>
                                                                <option value="PT">Portugal (PT)</option>
                                                                <option value="PR">Puerto Rico (PR)</option>
                                                                <option value="QA">Qatar (QA)</option>
                                                                <option value="RE">Reunion (RE)</option>
                                                                <option value="RO">Romania (RO)</option>
                                                                <option value="RU">Russia (RU)</option>
                                                                <option value="RW">Rwanda (RW)</option>
                                                                <option value="SM">San Marino (SM)</option>
                                                                <option value="ST">Sao Tome &amp; Principe (ST)
                                                                </option>
                                                                <option value="SA">Saudi Arabia (SA)</option>
                                                                <option value="SN">Senegal (SN)</option>
                                                                <option value="CS">Serbia (CS)</option>
                                                                <option value="SC">Seychelles (SC)</option>
                                                                <option value="SL">Sierra Leone (SL)</option>
                                                                <option value="SG">Singapore (SG)</option>
                                                                <option value="SK">Slovak Republic (SK)</option>
                                                                <option value="SI">Slovenia (SI)</option>
                                                                <option value="SB">Solomon Islands (SB)</option>
                                                                <option value="SO">Somalia (SO)</option>
                                                                <option value="ZA">South Africa (ZA)</option>
                                                                <option value="ES">Spain (ES)</option>
                                                                <option value="LK">Sri Lanka (LK)</option>
                                                                <option value="SH">St. Helena (SH)</option>
                                                                <option value="KN">St. Kitts (KN)</option>
                                                                <option value="SC">St. Lucia (SC)</option>
                                                                <option value="SD">Sudan (SD)</option>
                                                                <option value="SR">Suriname (SR)</option>
                                                                <option value="SZ">Swaziland (SZ)</option>
                                                                <option value="SE">Sweden (SE)</option>
                                                                <option value="CH">Switzerland (CH)</option>
                                                                <option value="SI">Syria (SI)</option>
                                                                <option value="TW">Taiwan (TW)</option>
                                                                <option value="TJ">Tajikstan (TJ)</option>
                                                                <option value="TH">Thailand (TH)</option>
                                                                <option value="TG">Togo (TG)</option>
                                                                <option value="TO">Tonga (TO)</option>
                                                                <option value="TT">Trinidad &amp; Tobago (TT)
                                                                </option>
                                                                <option value="TN">Tunisia (TN)</option>
                                                                <option value="TR">Turkey (TR)</option>
                                                                <option value="TM">Turkmenistan (TM)</option>
                                                                <option value="TM">Turkmenistan (TM)</option>
                                                                <option value="TC">Turks &amp; Caicos Islands (TC)
                                                                </option>
                                                                <option value="TV">Tuvalu (TV)</option>
                                                                <option value="UG">Uganda (UG)</option>
                                                                <!-- <option value="GB">UK (GB)</option> -->
                                                                <option value="UA">Ukraine (UA)</option>
                                                                <option value="AE">United Arab Emirates (AE)
                                                                </option>
                                                                <option value="UY">Uruguay (UY)</option>
                                                                <!-- <option value="US">USA (US)</option> -->
                                                                <option value="UZ">Uzbekistan (UZ)</option>
                                                                <option value="VU">Vanuatu (VU)</option>
                                                                <option value="VA">Vatican City (VA)</option>
                                                                <option value="VE">Venezuela (VE)</option>
                                                                <option value="VN">Vietnam (VN)</option>
                                                                <option value="VG">Virgin Islands - British (VG)
                                                                </option>
                                                                <option value="VI">Virgin Islands - US (VI)
                                                                </option>
                                                                <option value="WF">Wallis &amp; Futuna (WF)
                                                                </option>
                                                                <option value="YE">Yemen (North)(YE)</option>
                                                                <option value="YE">Yemen (South)(YE)</option>
                                                                <option value="ZM">Zambia (ZM)</option>
                                                                <option value="ZW">Zimbabwe (ZW)</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        {{-- @if (!$loop->last) --}}
                                        <div class="hr1"></div>
                                        {{-- @endif --}}
                                    @endfor
                                @endif

                                {{-- ===============================Child passenger================ --}}
                                @if ($childNum > 0)
                                    <label class="text-uppercase text-info pb-2 zero label-13">Child Passengers
                                        ({{ $childNum }})</label>
                                    @for ($i = 0; $i < $childNum; $i++)
                                        <input type="hidden" name="travelerType[]" value="Child">

                                        <div class="row mb-3 border-bottom p-0">
                                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">First Name :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <input type="text" name="first_name[]" required value=""
                                                            placeholder="First Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">Last Name :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <input type="text" name="last_name[]" required value=""
                                                            placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">Gender :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <select name="gender[]" id="" required
                                                            class="form-control">
                                                            <option value="MALE">Male</option>
                                                            <option value="FEMALE">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary label-13 text-uppercase">DOB :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <input type="date" required name="dob[]" value=""
                                                            placeholder="DOB">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>

                                        {{-- @if (!$loop->last) --}}
                                        {{-- <div class="hr1"></div> --}}
                                        {{-- @endif --}}
                                    @endfor
                                @endif


                                {{-- ===============================Infant passenger================ --}}
                                @if ($infantNum > 0)
                                    <label class="text-uppercase text-info label-13 zero pb-2">Infant Passengers
                                        ({{ $infantNum }})</label>
                                    @for ($i = 0; $i < $infantNum; $i++)
                                        <input type="hidden" name="travelerType[]" value="Infant">

                                        <div class="row">
                                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary text-uppercase label-13">First Name :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <input type="text" required name="first_name[]" value=""
                                                            placeholder="First Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary text-uppercase label-13">Last Name :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <input type="text" required value="" name="last_name[]"
                                                            placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary text-uppercase label-13">Gender :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <select name="gender[]" required id=""
                                                            class="form-control">
                                                            <option value="MALE">Male</option>
                                                            <option value="FEMALE">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 mb-4">
                                                <div class="wrapper">
                                                    <label class="text-secondary text-uppercase label-13">DOB :</label>
                                                    <div class="search-input search-input1">
                                                        <a href="" target="_blank" hidden></a>
                                                        <input type="date" required name="dob[]" value=""
                                                            placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endfor
                                @endif
                            </div>
                            {{-- @endforeach --}}
                        </div>


                        {{-- ===========================Billing Address============================= --}}
                        <div class="card listCard mb-5">
                            <div class="card-header bg-info text-white">
                                <h5 class="text-uppercase text-muted py-2 label-15">Billing Address</h5>
                            </div>
                            <div class="card-body">
                                <div class="row px-4">
                                    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 mb-4">
                                        <div class="wrapper">
                                            <label class="text-secondary text-uppercase label-13">Country :</label>
                                            <div class="search-input search-input1">
                                                <a href="" target="_blank" hidden></a>
                                                <select name="country" required class="form-control" id="">
                                                    <option value="GB" Selected>UK (GB)</option>
                                                    <option value="US">USA (US)</option>
                                                    <optgroup label="Other countries">
                                                        <option value="DZ">Algeria (DZ)</option>
                                                        <option value="AD">Andorra (AD)</option>
                                                        <option value="AO">Angola (AO)</option>
                                                        <option value="AI">Anguilla (AI)</option>
                                                        <option value="AG">Antigua &amp; Barbuda (AG)</option>
                                                        <option value="AR">Argentina (AR)</option>
                                                        <option value="AM">Armenia (AM)</option>
                                                        <option value="AW">Aruba (AW)</option>
                                                        <option value="AU">Australia (AU)</option>
                                                        <option value="AT">Austria (AT)</option>
                                                        <option value="AZ">Azerbaijan (AZ)</option>
                                                        <option value="BS">Bahamas (BS)</option>
                                                        <option value="BH">Bahrain (BH)</option>
                                                        <option value="BD">Bangladesh (BD)</option>
                                                        <option value="BB">Barbados (BB)</option>
                                                        <option value="BY">Belarus (BY)</option>
                                                        <option value="BE">Belgium (BE)</option>
                                                        <option value="BZ">Belize (BZ)</option>
                                                        <option value="BJ">Benin (BJ)</option>
                                                        <option value="BM">Bermuda (BM)</option>
                                                        <option value="BT">Bhutan (BT)</option>
                                                        <option value="BO">Bolivia (BO)</option>
                                                        <option value="BA">Bosnia Herzegovina (BA)</option>
                                                        <option value="BW">Botswana (BW)</option>
                                                        <option value="BR">Brazil (BR)</option>
                                                        <option value="BN">Brunei (BN)</option>
                                                        <option value="BG">Bulgaria (BG)</option>
                                                        <option value="BF">Burkina Faso (BF)</option>
                                                        <option value="BI">Burundi (BI)</option>
                                                        <option value="KH">Cambodia (KH)</option>
                                                        <option value="CM">Cameroon (CM)</option>
                                                        <option value="CA">Canada (CA)</option>
                                                        <option value="CV">Cape Verde Islands (CV)</option>
                                                        <option value="KY">Cayman Islands (KY)</option>
                                                        <option value="CF">Central African Republic (CF)</option>
                                                        <option value="CL">Chile (CL)</option>
                                                        <option value="CN">China (CN)</option>
                                                        <option value="CO">Colombia (CO)</option>
                                                        <option value="KM">Comoros (KM)</option>
                                                        <option value="CG">Congo (CG)</option>
                                                        <option value="CK">Cook Islands (CK)</option>
                                                        <option value="CR">Costa Rica (CR)</option>
                                                        <option value="HR">Croatia (HR)</option>
                                                        <option value="CU">Cuba (CU)</option>
                                                        <option value="CY">Cyprus North (CY)</option>
                                                        <option value="CY">Cyprus South (CY)</option>
                                                        <option value="CZ">Czech Republic (CZ)</option>
                                                        <option value="DK">Denmark (DK)</option>
                                                        <option value="DJ">Djibouti (DJ)</option>
                                                        <option value="DM">Dominica (DM)</option>
                                                        <option value="DO">Dominican Republic (DO)</option>
                                                        <option value="EC">Ecuador (EC)</option>
                                                        <option value="EG">Egypt (EG)</option>
                                                        <option value="SV">El Salvador (SV)</option>
                                                        <option value="GQ">Equatorial Guinea (GQ)</option>
                                                        <option value="ER">Eritrea (ER)</option>
                                                        <option value="EE">Estonia (EE)</option>
                                                        <option value="ET">Ethiopia (ET)</option>
                                                        <option value="FK">Falkland Islands (FK)</option>
                                                        <option value="FO">Faroe Islands (FO)</option>
                                                        <option value="FJ">Fiji (FJ)</option>
                                                        <option value="FI">Finland (FI)</option>
                                                        <option value="FR">France (FR)</option>
                                                        <option value="GF">French Guiana (GF)</option>
                                                        <option value="PF">French Polynesia (PF)</option>
                                                        <option value="GA">Gabon (GA)</option>
                                                        <option value="GM">Gambia (GM)</option>
                                                        <option value="GE">Georgia (GE)</option>
                                                        <option value="DE">Germany (DE)</option>
                                                        <option value="GH">Ghana (GH)</option>
                                                        <option value="GI">Gibraltar (GI)</option>
                                                        <option value="GR">Greece (GR)</option>
                                                        <option value="GL">Greenland (GL)</option>
                                                        <option value="GD">Grenada (GD)</option>
                                                        <option value="GP">Guadeloupe (GP)</option>
                                                        <option value="GU">Guam (GU)</option>
                                                        <option value="GT">Guatemala (GT)</option>
                                                        <option value="GN">Guinea (GN)</option>
                                                        <option value="GW">Guinea - Bissau (GW)</option>
                                                        <option value="GY">Guyana (GY)</option>
                                                        <option value="HT">Haiti (HT)</option>
                                                        <option value="HN">Honduras (HN)</option>
                                                        <option value="HK">Hong Kong (HK)</option>
                                                        <option value="HU">Hungary (HU)</option>
                                                        <option value="IS">Iceland (IS)</option>
                                                        <option value="IN">India (IN)</option>
                                                        <option value="ID">Indonesia (ID)</option>
                                                        <option value="IR">Iran (IR)</option>
                                                        <option value="IQ">Iraq (IQ)</option>
                                                        <option value="IE">Ireland (IE)</option>
                                                        <option value="IL">Israel (IL)</option>
                                                        <option value="IT">Italy (IT)</option>
                                                        <option value="JM">Jamaica (JM)</option>
                                                        <option value="JP">Japan (JP)</option>
                                                        <option value="JO">Jordan (JO)</option>
                                                        <option value="KZ">Kazakhstan (KZ)</option>
                                                        <option value="KE">Kenya (KE)</option>
                                                        <option value="KI">Kiribati (KI)</option>
                                                        <option value="KP">Korea North (KP)</option>
                                                        <option value="KR">Korea South (KR)</option>
                                                        <option value="KW">Kuwait (KW)</option>
                                                        <option value="KG">Kyrgyzstan (KG)</option>
                                                        <option value="LA">Laos (LA)</option>
                                                        <option value="LV">Latvia (LV)</option>
                                                        <option value="LB">Lebanon (LB)</option>
                                                        <option value="LS">Lesotho (LS)</option>
                                                        <option value="LR">Liberia (LR)</option>
                                                        <option value="LY">Libya (LY)</option>
                                                        <option value="LI">Liechtenstein (LI)</option>
                                                        <option value="LT">Lithuania (LT)</option>
                                                        <option value="LU">Luxembourg (LU)</option>
                                                        <option value="MO">Macao (MO)</option>
                                                        <option value="MK">Macedonia (MK)</option>
                                                        <option value="MG">Madagascar (MG)</option>
                                                        <option value="MW">Malawi (MW)</option>
                                                        <option value="MY">Malaysia (MY)</option>
                                                        <option value="MV">Maldives (MV)</option>
                                                        <option value="ML">Mali (ML)</option>
                                                        <option value="MT">Malta (MT)</option>
                                                        <option value="MH">Marshall Islands (MH)</option>
                                                        <option value="MQ">Martinique (MQ)</option>
                                                        <option value="MR">Mauritania (MR)</option>
                                                        <option value="YT">Mayotte (YT)</option>
                                                        <option value="MX">Mexico (MX)</option>
                                                        <option value="FM">Micronesia (FM)</option>
                                                        <option value="MD">Moldova (MD)</option>
                                                        <option value="MC">Monaco (MC)</option>
                                                        <option value="MN">Mongolia (MN)</option>
                                                        <option value="MS">Montserrat (MS)</option>
                                                        <option value="MA">Morocco (MA)</option>
                                                        <option value="MZ">Mozambique (MZ)</option>
                                                        <option value="MN">Myanmar (MN)</option>
                                                        <option value="NA">Namibia (NA)</option>
                                                        <option value="NR">Nauru (NR)</option>
                                                        <option value="NP">Nepal (NP)</option>
                                                        <option value="NL">Netherlands (NL)</option>
                                                        <option value="NC">New Caledonia (NC)</option>
                                                        <option value="NZ">New Zealand (NZ)</option>
                                                        <option value="NI">Nicaragua (NI)</option>
                                                        <option value="NE">Niger (NE)</option>
                                                        <option value="NG">Nigeria (NG)</option>
                                                        <option value="NU">Niue (NU)</option>
                                                        <option value="NF">Norfolk Islands (NF)</option>
                                                        <option value="NP">Northern Marianas (NP)</option>
                                                        <option value="NO">Norway (NO)</option>
                                                        <option value="OM">Oman (OM)</option>
                                                        <option value="PW">Palau (PW)</option>
                                                        <option value="PA">Panama (PA)</option>
                                                        <option value="PG">Papua New Guinea (PG)</option>
                                                        <option value="PY">Paraguay (PY)</option>
                                                        <option value="PE">Peru (PE)</option>
                                                        <option value="PH">Philippines (PH)</option>
                                                        <option value="PL">Poland (PL)</option>
                                                        <option value="PT">Portugal (PT)</option>
                                                        <option value="PR">Puerto Rico (PR)</option>
                                                        <option value="QA">Qatar (QA)</option>
                                                        <option value="RE">Reunion (RE)</option>
                                                        <option value="RO">Romania (RO)</option>
                                                        <option value="RU">Russia (RU)</option>
                                                        <option value="RW">Rwanda (RW)</option>
                                                        <option value="SM">San Marino (SM)</option>
                                                        <option value="ST">Sao Tome &amp; Principe (ST)</option>
                                                        <option value="SA">Saudi Arabia (SA)</option>
                                                        <option value="SN">Senegal (SN)</option>
                                                        <option value="CS">Serbia (CS)</option>
                                                        <option value="SC">Seychelles (SC)</option>
                                                        <option value="SL">Sierra Leone (SL)</option>
                                                        <option value="SG">Singapore (SG)</option>
                                                        <option value="SK">Slovak Republic (SK)</option>
                                                        <option value="SI">Slovenia (SI)</option>
                                                        <option value="SB">Solomon Islands (SB)</option>
                                                        <option value="SO">Somalia (SO)</option>
                                                        <option value="ZA">South Africa (ZA)</option>
                                                        <option value="ES">Spain (ES)</option>
                                                        <option value="LK">Sri Lanka (LK)</option>
                                                        <option value="SH">St. Helena (SH)</option>
                                                        <option value="KN">St. Kitts (KN)</option>
                                                        <option value="SC">St. Lucia (SC)</option>
                                                        <option value="SD">Sudan (SD)</option>
                                                        <option value="SR">Suriname (SR)</option>
                                                        <option value="SZ">Swaziland (SZ)</option>
                                                        <option value="SE">Sweden (SE)</option>
                                                        <option value="CH">Switzerland (CH)</option>
                                                        <option value="SI">Syria (SI)</option>
                                                        <option value="TW">Taiwan (TW)</option>
                                                        <option value="TJ">Tajikstan (TJ)</option>
                                                        <option value="TH">Thailand (TH)</option>
                                                        <option value="TG">Togo (TG)</option>
                                                        <option value="TO">Tonga (TO)</option>
                                                        <option value="TT">Trinidad &amp; Tobago (TT)</option>
                                                        <option value="TN">Tunisia (TN)</option>
                                                        <option value="TR">Turkey (TR)</option>
                                                        <option value="TM">Turkmenistan (TM)</option>
                                                        <option value="TM">Turkmenistan (TM)</option>
                                                        <option value="TC">Turks &amp; Caicos Islands (TC)</option>
                                                        <option value="TV">Tuvalu (TV)</option>
                                                        <option value="UG">Uganda (UG)</option>
                                                        <!-- <option value="GB">UK (GB)</option> -->
                                                        <option value="UA">Ukraine (UA)</option>
                                                        <option value="AE">United Arab Emirates (AE)</option>
                                                        <option value="UY">Uruguay (UY)</option>
                                                        <!-- <option value="US">USA (US)</option> -->
                                                        <option value="UZ">Uzbekistan (UZ)</option>
                                                        <option value="VU">Vanuatu (VU)</option>
                                                        <option value="VA">Vatican City (VA)</option>
                                                        <option value="VE">Venezuela (VE)</option>
                                                        <option value="VN">Vietnam (VN)</option>
                                                        <option value="VG">Virgin Islands - British (VG)</option>
                                                        <option value="VI">Virgin Islands - US (VI)</option>
                                                        <option value="WF">Wallis &amp; Futuna (WF)</option>
                                                        <option value="YE">Yemen (North)(YE)</option>
                                                        <option value="YE">Yemen (South)(YE)</option>
                                                        <option value="ZM">Zambia (ZM)</option>
                                                        <option value="ZW">Zimbabwe (ZW)</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 mb-4">
                                        <div class="wrapper">
                                            <label class="text-secondary text-uppercase label-13">City :</label>
                                            <div class="search-input search-input1">
                                                <a href="" target="_blank" hidden></a>
                                                <input type="text" required name="city" value=""
                                                    placeholder="City">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 mb-4">
                                        <div class="wrapper">
                                            <label class="text-secondary text-uppercase label-13">Postal Code :</label>
                                            <div class="search-input search-input1">
                                                <a href="" target="_blank" hidden></a>
                                                <input type="number" required name="postalCode" value=""
                                                    placeholder="Postal Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-6 col-md-12 col-sm-6 mb-4">
                                        <div class="wrapper">
                                            <label class="text-secondary text-uppercase label-13">Address :</label>
                                            <div class="search-input search-input1">
                                                <a href="" target="_blank" hidden></a>
                                                <input type="text" required value="" name="address"
                                                    placeholder="Address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===========Payments============ --}}
                        <div class="card listCard mb-5">
                            <div class="card-header bg-info text-white">
                                <h5 class="text-uppercase text-muted py-2 label-15">Payment and billing</h5>
                            </div>
                            <div class="card-body">
                                <div class="main-container m-0 p-0">
                                    <div class="radio-buttons">
                                        <label class="custom-radio ">
                                            <input type="radio" value="Paypal" name="payment_method"  checked>
                                            <span class="radio-btn"><i class="las la-check"></i>
                                                <div class="hobbies-icon">
                                                    <img src="{{ asset('paypal.png') }}">
                                                    <h3 class="">Paypal</h3>
                                                </div>
                                            </span>
                                        </label>
                                        <label class="custom-radio">
                                            <input type="radio" value="Bank Transfer" name="payment_method" >
                                            <span class="radio-btn"><i class="las la-check"></i>
                                                <div class="hobbies-icon">
                                                    <img src="{{ asset('bank_transfer.png') }}">
                                                    <h3 class="">Bank Transfer</h3>
                                                </div>
                                            </span>
                                        </label>
                                        <label class="custom-radio">
                                            <input type="radio" value="Pay Later" name="payment_method" >
                                            <span class="radio-btn"><i class="las la-check"></i>
                                                <div class="hobbies-icon">
                                                    <img src="{{ asset('pay_later.png') }}">
                                                    <h3 class="">Pay Later</h3>
                                                </div>
                                            </span>
                                        </label>
                                        <label class="custom-radio">
                                            <input type="radio" value="Stripe" name="payment_method" >
                                            <span class="radio-btn"><i class="las la-check"></i>
                                                <div class="hobbies-icon">
                                                    <img src="{{ asset('stripe.png') }}">
                                                    <h3 class="">Stripe</h3>
                                                </div>
                                            </span>
                                        </label>

                                        <label class="custom-radio">
                                            <input type="radio" value="Cash Payment" id="cashPayment"  name="payment_method">
                                            <span class="radio-btn"><i class="las la-check"></i>
                                                <div class="hobbies-icon">
                                                    <img src="{{ asset('cash.png') }}">
                                                    <h3 class="">Cash Payment</h3>
                                                </div>
                                            </span>
                                        </label>
                                        <input type="text">

                                    </div>

                                </div>
                            </div>
                        </div>


                        {{-- ===========Policy============ --}}
                        <div class="card listCard mb-5">
                            <div class="card-header bg-info text-white">
                                <h5 class="text-uppercase text-muted py-2 label-15">Policies and review </h5>
                            </div>
                            <div class="card-body zero">
                                <span class="py-3  text-normal label-13"> Passenger names must match passport or government
                                    issued
                                    photo ID exactly. </span>
                                <br>
                                <span class="label-13">
                                    Pasenger 1: N/A
                                </span>

                                <div class="hr zero mt-3"></div>
                                @php
                                    $detailedFareRules = $flightDetail->included->{'detailed-fare-rules'}->{1}->fareNotes->descriptions;
                                    // print_r($detailedFareRules);
                                @endphp
                                <div class="tab mt-3">
                                    <ul class="nav nav-pills" role="tablist">
                                        @foreach ($detailedFareRules as $key => $item)
                                            {{-- <label class="text-danger">  </label><br> --}}
                                            <li class="nav-item">
                                                <a class="nav-link label-13 {{ $key == 0 ? 'active' : '' }} text-blue"
                                                    data-toggle="tab" href="#tab{{ $key }}" role="tab"
                                                    aria-selected="true">{{ $item->descriptionType }}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="tab-content">
                                        @foreach ($detailedFareRules as $key => $item)
                                            <div class="tab-pane fade show policy-height {{ $key == 0 ? 'active' : '' }} mt-3"
                                                id="tab{{ $key }}" role="tabpanel">
                                                <div>
                                                    <span class="label-12">
                                                        {{ $item->text }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>


                                <br><br>
                                <span class="label-13 mb-3">By clicking on Book Now, you agree that you have accepted the
                                    above-mentioned policies and have gone through our <span class="text-danger">Terms
                                        of
                                        Booking</span>, <span class="text-danger">Cancellation &
                                        Change and Privacy Policy</span></span>
                                        <br>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-5 ">
                            <button class="btn btn-info pt-2 pb-2 {{ Auth()->user() ? '' : 'disable' }}"
                                type="submit">
                                <h3 class="px-5 m-0 text-white text-uppercase label-15 fw-bold">Book Now</h3>
                                <span class="text-uppercase label-13"><i class="fa-solid fa-lock"></i>&nbsp;secure
                                    payment</span>
                            </button>
                        </div>

                        <label class="col-12 text-center py-2"><span class="text-warning label-12 text-uppercase">Warning :
                            </span><span class="text-muted label-12"><i>You are not loged in. Please login to
                                    book.</i></span></label>
                    </form>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <div class="card bg-info text-white">
                        @php
                            $totalBase = 0;
                            $totaltax = 0;
                            $total = 0;
                            $currency = $flightDetail->data->flightOffers[0]->travelerPricings[0]->price->currency;
                        @endphp

                        @foreach ($flightDetail->data->flightOffers[0]->travelerPricings as $price)
                            @php
                                $totalBase = $totalBase + $price->price->base;
                                $total = $total + $price->price->total;
                            @endphp
                            @foreach ($price->price->taxes as $tax)
                                @php
                                    $totaltax = $totaltax + $tax->amount;
                                @endphp
                            @endforeach
                        @endforeach
                        <div class="card-body m-0 p-0">
                            <table class="col-12">
                                <tr>
                                    <th class="pl-3 py-3 label-13">Base</th>
                                    <th class="py-3 label-13">{{ $totalBase }} {{ $currency }}</th>
                                </tr>
                                <tr>
                                    <th class="pl-3 py-3 label-13">Tax</th>
                                    <th class="py-3 label-13">{{ $totaltax }} {{ $currency }}</th>
                                </tr>
                                <tr style="background-color: #148c9f">
                                    <th class="pl-3 py-4 label-13">Total</th>
                                    <th class="py-4 label-13">{{ $total }} {{ $currency }}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-1 col-lg-12"></div>
    </div>

@endsection
