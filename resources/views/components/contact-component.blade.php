<div class="row" style="background-color: #fbfcf8">
    <div class="col-xl-1 col-lg-1"></div>
    <div class="col-xl-10 col-lg-12 py-5">
        <div class="row px-3">
            <div class="col-xl-6  col-lg-6 col-md-5 mb-3">
                <h1>For all enquiries, please send a message</h1>
                <label class="mt-4">There are many variations of passages of Lorem Ipsum available, but the majority
                    have suffered
                    alteration.</label>

                <div class="card bg-info mt-5">
                    <div class="text-white card-body">
                        <h5 class="fw-bold text-white">Let's get in touch</h5>
                        <label class="">To make strong relation with us.</label>

                        <div class="d-flex mt-5 align-items-center">
                            <div class="contact-icon">
                                <i class="fa-solid fa-location-pin"></i>
                            </div>
                            <label class="pl-3"> <b class="text-uppercase">Address :</b> Dhangadhi, Kailali </label>
                        </div>

                        <div class="d-flex mt-3 align-items-center">
                            <div class="contact-icon">
                                <i class="fa-solid fa-mobile"></i>
                            </div>
                            <label class="pl-3"> <b class="text-uppercase">Contact :</b> 9814668499 </label>
                        </div>

                        <div class="d-flex mt-3 align-items-center">
                            <div class="contact-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <label class="pl-3"> <b class="text-uppercase">Email :</b> cbishal@gmail.com </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-7">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="{{ route('front.contactUs') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 mb-4">
                                    <div class="wrapper">
                                        <label class="text-secondary text-uppercase label-13">Name :</label>
                                        <div class="search-input search-input1">
                                            <a href="" target="_blank" hidden></a>
                                            <input type="text" required name="name" value=""
                                                placeholder="Full Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 mb-4">
                                    <div class="wrapper">
                                        <label class="text-secondary text-uppercase label-13">Email :</label>
                                        <div class="search-input search-input1">
                                            <a href="" target="_blank" hidden></a>
                                            <input type="text" required name="email" value=""
                                                placeholder="Email">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 mb-4">
                                    <div class="wrapper">
                                        <label class="text-secondary text-uppercase label-13">Subject :</label>
                                        <div class="search-input search-input1">
                                            <a href="" target="_blank" hidden></a>
                                            <input type="text" required name="subject" value=""
                                                placeholder="Subject">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 mb-4">
                                    <div class="wrapper">
                                        <label class="text-secondary text-uppercase label-13">Message :</label>
                                        <div class="search-input search-input1">
                                            <a href="" target="_blank" hidden></a>
                                            <textarea name="message" class="form-control" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 mb-4">
                                    <div class="wrapper">
                                        <input type="submit" required name="subject" value="Send"
                                            class="btn btn-info" placeholder="Subject">
                                    </div>
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
