<div class="col-12 py-5 testimonials">
    <div class="row">
        <h5 class="col-12 text-uppercase text-center text-white" style="z-index: 9">Client's Testimonials</h5>
        <label class="col-12 text-center text-white" style="z-index: 9">What they are saying</label>
        <div class="col-xl-1"></div>
        <div class="col-xl-10">
            <div class="row mt-5">

                @foreach ($reviews as $review)
                    <div class="col-xl-3 col-lg-6 mb-3 col-md-6">

                        <div class="card" style="z-index: 9">
                            <div class="card-body">
                                <i class="fa-solid fa-quote-right comment-icon"></i>
                                <label class="mt-3 mb-3">"{{ Str::substr($review->comment, 0, 200) . "..." }}"</label>

                                <h5 class="">{{$review->name}}</h5>

                                <div class="d-flex mt-2">
                                    <div id="" class="rateYo m-0 p-0" data-rateyo-rating="{{$review->rating}}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="col-12 mt-5">
                <h3>{{$ststus}}</h3>
                <div class="d-flex mt-2">
                    <div id="rateYo1" class=" m-0 p-0" data-rateyo-rating="{{$rating}}"></div>
                </div>
                <label class="mt-3">Based on <a href="{{ route('flight.review') }}" class="text-dark"><u>{{$total}}
                    reviews</u></a></label>
            </div>
        </div>
    </div>
</div>
