@extends('front.app')
@section('content')
    <section>
        <div class="col-12 row mt-5 mb-5">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <div class="d-flex align-items-center">
                    <div>
                        <img src="{{ asset('logo.png') }}" alt="" style="height: 80px">
                    </div>
                    <div class="pl-3">
                        <h5>Flights Mojo</h5>
                        <label>Reviews {{ $num }} ({{ $ststus }})</label>
                        <div class="d-flex mt-2 align-items-center">
                            <div id="rateYo1" class="m-0 p-0" data-rateyo-rating="{{ $rating }}"></div>
                            <label class="pl-3">{{ Str::substr($rating, 0, 3) }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2"></div>
        </div>

        <hr>

        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-10 col-lg-12 mb-5">
                <div class="row px-3">
                    <div class="col-xl-7 col-lg-7 col-md-6">
                        <form action="{{ route('reviews.store') }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-lg-6">
                                            <h5>Rating us</h5>
                                        </div>
                                        <div class="col-lg-6 d-flex justify-content-end">
                                            <input type="hidden" value="4.5" name="rating" id="ratingInput">
                                            <div class="m-0 p-0">
                                                <div id="rateYo" class="m-0 p-0"></div>

                                                <span class="text-muted">Rating : <span class="m-0 p-0"
                                                        id="txtRating">4.5</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="wrapper mb-3">
                                        {{-- <label class="text-secondary text-uppercase label-13">First Name :</label> --}}
                                        <div class="search-input search-input1">
                                            <a href="" target="_blank" hidden></a>
                                            <input type="text" required name="name" value=""
                                                placeholder="Customer Name">
                                        </div>
                                    </div>
                                    <textarea name="comment" placeholder="Write your reviews" class="form-control" id="" cols="30"
                                        rows="10"></textarea>


                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <input type="submit" value="Submit" class="btn btn-info">
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- <div class="card mt-3">
                            <div class="card-body">
                                <h5>Reviews <i class="fa-regular fa-star"></i> 5.0</h5>
                                <label>1000 Total</label>

                                <div class="row mt-3">
                                    <div class="col">5-Star</div>
                                    <div class="col-xl-9">
                                        <div class="progress">
                                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col">78%</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">4-Star</div>
                                    <div class="col-xl-9">
                                        <div class="progress">
                                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col">78%</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">3-Star</div>
                                    <div class="col-xl-9">
                                        <div class="progress">
                                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col">78%</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">2-Star</div>
                                    <div class="col-xl-9">
                                        <div class="progress">
                                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col">78%</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">1-Star</div>
                                    <div class="col-xl-9">
                                        <div class="progress">
                                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col">78%</div>
                                </div>
                            </div>
                        </div> --}}

                        @foreach ($reviews as $review)
                            <div class="card mt-3 mb-5">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center justify-content-center bg-info text-white"
                                            style="height: 50px;width: 50px;border-radius:50%">
                                            {{ Str::substr($review->name, 0, 1) }}</div>
                                        <label class="pl-3">{{ $review->name }}</label>
                                    </div>
                                    <hr>
                                    <label>{{ $review->comment }}</label>

                                    <hr>

                                    @php
                                        $dateTime = new DateTime($review->created_at);
                                        $date = $dateTime->format('Y-m-d');
                                        $timeWithAMPM = $dateTime->format('h:i A');
                                    @endphp
                                    <label class="text-muted"><i class="fa-solid fa-calendar-days"></i>
                                        {{ $date }}</label>
                                    <label class="pl-3 text-muted"><i class="fa-solid fa-clock"></i>
                                        {{ $timeWithAMPM }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-6 sticky" style="position: sticky;top:10px">
                        <div class="card">
                            <div class="card-body">
                                <h5>Contact Us</h5>

                                <form action="{{ route('front.contactUs') }}" method="POST">
                                    @csrf
                                    <div class="wrapper">
                                        <label class="text-secondary text-uppercase label-13">Name :</label>
                                        <div class="search-input search-input1">
                                            <a href="" target="_blank" hidden></a>
                                            <input type="text" required name="name" value=""
                                                placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="wrapper">
                                        <label class="text-secondary text-uppercase label-13">Email :</label>
                                        <div class="search-input search-input1">
                                            <a href="" target="_blank" hidden></a>
                                            <input type="text" required name="email" value=""
                                                placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="wrapper">
                                        <label class="text-secondary text-uppercase label-13">Subject :</label>
                                        <div class="search-input search-input1">
                                            <a href="" target="_blank" hidden></a>
                                            <input type="text" required name="subject" value=""
                                                placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="wrapper">
                                        <label class="text-secondary text-uppercase label-13">Message :</label>
                                        <div class="search-input search-input1">
                                            <a href="" target="_blank" hidden></a>
                                            <textarea name="message" class="form-control" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 mt-4">
                                        <div class="wrapper">
                                            <input type="submit" required name="subject" value="Send"
                                                class="btn btn-info" placeholder="Subject">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2"></div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(function() {

            $("#rateYo").rateYo({
                rating: 4.5,
                precision: 2,
                onChange: function(rating, rateYoInstance) {
                    $("#ratingInput").val(rating);
                    $("#txtRating").text(rating);
                }
            });
            var normalFill = $("#rateYo").rateYo("option", "precision"); //returns 2

            // Setter
            $("#rateYo").rateYo("option", "precision", 3); //returns a jQuery Element
        });
    </script>
@endpush
