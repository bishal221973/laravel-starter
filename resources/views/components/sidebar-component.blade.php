<div class="left-side-bar">
    <div class="brand-logo mt-3">
        <a href="{{route('home')}}">
            @if (settings()->get('logo'))
                <img src="{{asset('storage')}}{{'/'}}{{settings()->get('logo')}}" style="height: 70px;width:70px" alt="" class="light-logo" />
                <h3 class="text-white pl-3">{{settings()->get('short_name')}}</h3>
            @else
                <img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo" />
            @endif
            {{-- <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo" /> --}}
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="{{ route('home') }}" class="dropdown-toggle">
                        <span class="myicon bi bi-house"></span><span class="mtext">Home</span>
                    </a>

                </li>


                <li class="dropdown">
                    <a href="{{ route('reviews.index') }}" class="dropdown-toggle">
                        <span class="myicon fa-solid fa-comments"></span><span class="mtext">Reviews</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('agency.index') }}" class="dropdown-toggle">
                        <span class="myicon fa-solid fa-sitemap"></span><span class="mtext">Agency</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('servece.index') }}" class="dropdown-toggle">
                        <span class="myicon fa-solid fa-sliders"></span><span class="mtext">Services</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('user.index') }}" class="dropdown-toggle">
                        <span class="myicon fa-solid fa-users"></span><span class="mtext">Users</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('setting.index') }}" class="dropdown-toggle">
                        <span class="myicon fa-solid fa-gear"></span><span class="mtext">Settings</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('report') }}" class="dropdown-toggle">
                        <span class="myicon bi bi-house"></span><span class="mtext">Report</span>
                    </a>

                </li>
            </ul>
        </div>
    </div>
</div>
