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

    <div class="profile-container">
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
    </div>
@endsection
