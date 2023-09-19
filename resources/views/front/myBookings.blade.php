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

    <div class="row mt-5">
        <div class="col-xl-2"></div>
        <div class="col-xl-8">
            <h5 class="text-uppercase text-muted mb-5">My Bookings</h5>

            <div class="row my-5">
                <div class="col-xl-12">
                    <a href="#">
                        <div class="card bg-info">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">

                                    <span class="text-profile">
                                        @php
                                            echo substr("Bishal", 0, 1).substr("Bishal", 0, 1);
                                        @endphp
                                    </span>

                                    <div>
                                        <h5 class="text-uppercase m-0 p-0">Kathmandu - Pokhara</h5>
                                        <span>2020:20:20</span>-
                                        <span>2020:20:20</span> <br>
                                        <span>4545464654156479871</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-2"></div>
    </div>
@endsection
