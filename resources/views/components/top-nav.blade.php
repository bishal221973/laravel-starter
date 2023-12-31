<nav class="nav">
    <div class="col-12" style="border-bottom: 1px solid #ccc">
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <div class="col-12 d-flex justify-content-between align-center-nam">
                    <div>
                        <img src="{{ asset('logo.png') }}" class="logo">
                    </div>
                    <div class="d-flex align-items-center contact-container">
                        <div class="d-flex align-items-center mx-3 ">
                            <span class="micon bg-primary"><i class="fa-solid fa-phone-volume "></i></span>
                            <div class="d-block">
                                <small class="text-uppercase nav-text1 label-12"><i
                                        class="fa-solid fa-phone-volume d-none icon1 padding1  m-0 p-0"></i>Offline
                                    Call</small> <br>
                                <label
                                    class="nav-text1 label-13 m-0 p-0">{{ settings()->get('org_contact', $default = null) }}</label>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-lr">
                            <span class="micon bg-success"><i class="fa-solid fa-envelope "></i></span>
                            <div class="d-block">
                                <small class="text-uppercase nav-text1 label-12"><i
                                        class="fa-solid fa-envelope d-none icon1"></i>Online support</small> <br>
                                <label
                                    class="nav-text1 label-13">{{ settings()->get('org_email', $default = null) }}</label>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mx-4">
                            <span class="micon bg-warning"><i class="fa-solid fa-location-dot "></i></span>
                            <div class="d-block">
                                <small class="text-uppercase nav-text1 label-12"><i
                                        class="fa-solid fa-phone-volume d-none icon1"></i>Our Location</small> <br>
                                <label
                                    class="nav-text1 label-13">{{ settings()->get('org_address', $default = null) }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center btn-login-container">
                        @auth
                            <div class="dropdown">
                                <h3 class="fw-bold text-uppercase bg-info text-white d-flex justify-content-center align-items-center"
                                    style="height: 50px;width:50px;border-radius:50%;cursor:pointer" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @php
                                        echo substr(Auth()->user()->first_name, 0, 1);
                                    @endphp
                                </h3>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('user.dashboard') }}"> <i
                                            class="fa-solid fa-user"></i> &nbsp;
                                        Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="dw dw-logout"></i> &nbsp; {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-info btn670 text-white"><i
                                    class="fa-solid fa-lock"></i> &nbsp;
                                Login</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-xl-2"></div>
        </div>
    </div>

</nav>
