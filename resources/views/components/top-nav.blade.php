<nav class="nav">
    <div class="col-12" style="border-bottom: 1px solid #ccc">
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <div class="col-12 d-flex justify-content-between">
                    <div>
                        <img src="{{ asset('logo.png') }}" class="logo">
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center mx-3 border-right">
                            <span class="micon bg-primary"><i class="fa-solid fa-phone-volume "></i></span>
                            <div class="d-block">
                                <small class="text-uppercase nav-text1">Offline Call</small> <br>
                                <label class="nav-text1">(977) 9813668499</label>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-lr">
                            <span class="micon bg-success"><i class="fa-solid fa-phone-volume "></i></span>
                            <div class="d-block">
                                <small class="text-uppercase nav-text1">Online support</small> <br>
                                <label class="nav-text1">bishalcodeslaravel@gmail.com</label>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mx-4">
                            <span class="micon bg-warning"><i class="fa-solid fa-location-dot "></i></span>
                            <div class="d-block">
                                <small class="text-uppercase nav-text1">Our Location</small> <br>
                                <label class="nav-text1">Dhangadhi, Motichok</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        @auth
                            <h3 class="fw-bold text-uppercase bg-info text-white d-flex justify-content-center align-items-center"
                                style="height: 50px;width:50px;border-radius:50%">
                                @php
                                    echo substr(Auth()->user()->name, 0, 1);
                                @endphp
                            </h3>
                        @else
                            <a href="#" class="btn btn-info text-white"><i class="fa-solid fa-lock"></i> &nbsp;
                                Login</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-xl-2"></div>
        </div>
    </div>

</nav>
