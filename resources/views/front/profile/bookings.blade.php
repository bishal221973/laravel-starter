@extends('front.app')
@section('content')
    <section class="home-section" style="height: 300px">
        <div id="myCarousel" class="carousel slide h-100" data-ride="carousel">


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

    {{-- <div class="profile-container">
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <div class="row">
                    <div class="user-profile-div">
                        <img src="{{ asset('flight1.jpg') }}" alt="" srcset="" class="user-profile">
                    </div>
                    <h3 class="mt-3" style="margin-left: 180px">{{ Auth()->user()->first_name }}
                        {{ Auth()->user()->last_name }}</h3>
                </div>
                <div style="height: 100px"></div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card bg-info text-white mb-2">
                            <div class="card-body">
                                <div class="col-12 d-flex justify-content-between mb-3">
                                    <h5 class="text-white text-uppercase fw-bold">Name :</h5>
                                    <span class="text-uppercase">{{ Auth()->user()->first_name }}
                                        {{ Auth()->user()->last_name }}</span>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <h5 class="text-white text-uppercase fw-bold">Email :</h5>
                                    <span class="text-uppercase">{{ Auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-info text-white mb-2">
                            <div class="card-body">
                                <div class="col-12 d-flex justify-content-between mb-3">
                                    <h5 class="text-white text-uppercase fw-bold">Gender :</h5>
                                    <span
                                        class="text-uppercase">{{ Auth()->user()->gender ? Auth()->user()->gender : 'NULL' }}</span>
                                </div>
                                <div class="col-12 d-flex justify-content-between mb-3">
                                    <h5 class="text-white text-uppercase fw-bold">Contact No. :</h5>
                                    <span
                                        class="text-uppercase">{{ Auth()->user()->contact_number ? Auth()->user()->contact_number : 'NULL' }}</span>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <h5 class="text-white text-uppercase fw-bold">DOB :</h5>
                                    <span
                                        class="text-uppercase">{{ Auth()->user()->dob ? Auth()->user()->dob : 'NULL' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="col-12 d-flex justify-content-between mb-3">
                                    <h5 class="text-white text-uppercase fw-bold">Total Booking :</h5>
                                    <span
                                        class="text-uppercase">0</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <form action="#">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6 mb-3">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase">First Name
                                                    :</label>
                                                <div class="search-input search-input1">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="text" name="first_name"
                                                        value="{{ Auth()->user()->first_name }}" placeholder="First Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 mb-3">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase">Last Name
                                                    :</label>
                                                <div class="search-input search-input1">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="text" name="last_name"
                                                        value="{{ Auth()->user()->last_name }}" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mb-3">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase">Gender
                                                    :</label>
                                                <div class="search-input search-input1">
                                                    <a href="" target="_blank" hidden></a>
                                                    <select name="" id="" class="form-control">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mb-3">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase">Contact no.
                                                    :</label>
                                                <div class="search-input search-input1">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mb-3">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase">DOB
                                                    :</label>
                                                <div class="search-input search-input1">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 d-flex justify-content-end mt-3">
                                            <button type="submit" class="btn btn-info col-12">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="#">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-10">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase">Email
                                                    :</label>
                                                <div class="search-input search-input1">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="email" name="email"
                                                        value="{{ Auth()->user()->email }}" placeholder="First Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2" style="height: 45px">
                                            <br>
                                            <button type="submit" class="btn btn-info "
                                                style="margin-top: 12px">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="#">
                            <div class="card mb-5">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 mb-3">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase">Current Password
                                                    :</label>
                                                <div class="search-input search-input1">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="text" placeholder="xxxxxxxxxxxxxxx">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 mb-3">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase">New Password
                                                    :</label>
                                                <div class="search-input search-input1">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="text" placeholder="xxxxxxxxxxxxxxx">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="wrapper">
                                                <label class="text-secondary text-uppercase">Confirm Password
                                                    :</label>
                                                <div class="search-input search-input1">
                                                    <a href="" target="_blank" hidden></a>
                                                    <input type="text" placeholder="xxxxxxxxxxxxxxx">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12" style="height: 45px">
                                            <br>
                                            <button type="submit" class="btn btn-info col-12">Update</button>
                                        </div>
                                    </div>
                                    <div style="height: 20px">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-2"></div>
        </div>
    </div> --}}

    <div class="row mt-5">
        <div class="col-xl-2"></div>
        <div class="col-xl-8">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="col-12 mb-4 d-flex justify-content-center">
                                <img src="{{ asset('flight1.jpg') }}" alt="" srcset=""
                                    style="height: 80px;width:80px;border-radius:50%">
                            </div>
                            <h5 class="text-info text-center text-uppercase">{{ Auth()->user()->first_name }}
                                {{ Auth()->user()->last_name }}</h5>
                            <label class="col-12 text-center">Welcome Back</label>
                        </div>
                    </div>

                    <div class="card">
                        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center front-menu border">
                            <i class="fa-solid fa-home mr-3"></i>
                            <label>Dashboard</label>
                        </a>
                        <a href="{{ route('user.myBooking') }}" class="d-flex align-items-center front-menu border">
                            <i class="fa-solid fa-home mr-3"></i>
                            <label>My Bookings</label>
                        </a>
                        <a href="{{ route('user.myProfile') }}" class="d-flex align-items-center front-menu border">
                            <i class="fa-solid fa-home mr-3"></i>
                            <label>My Profile</label>
                        </a>
                        <a href="#" class="d-flex align-items-center front-menu border">
                            <i class="fa-solid fa-home mr-3"></i>
                            <label>Logout</label>
                        </a>

                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            <h4 class="text-blue h4">My Bookings</h4>
                        </div>
                        <div class="pb-20">
                            <table class="data-table table hover multiple-select-row nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">SN</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Price</th>
                                        {{-- <th>Booking Id</th> --}}
                                        <th>Payment Ststus</th>
                                        <th>Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (App\Models\Booking::where('user_id', Auth()->user()->id)->get() as $booking)
                                        <tr>
                                            <td class="table-plus">{{ $loop->iteration }}</td>
                                            <td>
                                                {{ getCity($booking->fromIataCode) }} ({{ $booking->fromIataCode }}) <br>
                                                <span class="text-muted"><i class="fa-solid fa-calendar-days"></i>
                                                    {{ getDates($booking->fromTime) }} <i class="fa-solid fa-clock"></i>
                                                    {{ getTime($booking->fromTime) }}</span>
                                            </td>
                                            <td>
                                                {{ getCity($booking->toIataCode) }} ({{ $booking->toIataCode }}) <br>
                                                <span class="text-muted"><i class="fa-solid fa-calendar-days"></i>
                                                    {{ getDates($booking->toTime) }} <i class="fa-solid fa-clock"></i>
                                                    {{ getTime($booking->toTime) }}</span>
                                            </td>
                                            <td>{{$booking->price}}</td>
                                            {{-- <td>{{$booking->booking_id}}</td> --}}
                                            <td>{{$booking->status}}</td>
                                            <td>
                                                <a href="#"><i class="fa-solid fa-download fa-2x"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2"></div>
    </div>
@endsection
