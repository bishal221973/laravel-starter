<nav class="my-navbar sticky">

    <div class="col-12" id="myHeader">
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <div class="col-12 align-items-center d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <a href="{{route('front.index')}}" class="menu-item text-secondary label-13 label-menu">Home</a>
                        <a href="#" class="menu-item text-secondary label-13 label-menu">Flight</a>
                        <a href="#" class="menu-item text-secondary label-13 label-menu">Contact us</a>
                    </div>


                    <div class="d-flex align-items-center">
                        <div class="align-items-center btn-login-container1 d-none">
                            @auth
                                <div class="dropdown">
                                    <h3 class="fw-bold text-uppercase bg-info text-white d-flex justify-content-center align-items-center"
                                        style="height: 50px;width:50px;border-radius:50%;cursor:pointer"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
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
                                <a href="{{ route('login') }}" class="btn btn-info text-white"><i
                                        class="fa-solid fa-lock"></i> &nbsp;
                                    Login</a>
                            @endauth
                        </div>
                        <a href="{{ route('user.myBookings') }}" class="text-secondary" data-toggle="tooltip"
                            data-placement="bottom" title="My Bookings"><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-2"></div>
        </div>
    </div>
</nav>
