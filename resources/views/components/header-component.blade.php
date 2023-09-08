<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
        <div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>

    </div>
    <div class="header-right">

        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        @if (Auth()->user()->image)
                            <img src="{{ asset('storage') }}{{ '/' }}{{ Auth()->user()->image }}"
                                alt="" id="test" />
                        @else
                            <img src="{{ asset('user1.png') }}" alt="" id="test" />
                        @endif
                    </span>

                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list profile-dropdown">
                    <div class="d-flex px-3 header-profile align-items-center    ">
                        @if (Auth()->user()->image)
                            <img src="{{ asset('storage') }}{{ '/' }}{{ Auth()->user()->image }}"
                                alt="" id="test" class="header-profile-image" />
                        @else
                            <img src="{{ asset('user1.png') }}" alt="" class="header-profile-image"
                                id="test" />
                        @endif &nbsp;&nbsp;&nbsp;
                        <div class="d-block">
                            <h5 class="mt-4">{{ Auth()->user()->first_name . ' ' . Auth()->user()->last_name }}</h5>
                            <label class="text-uppercase text-success font-weight-bold"><i
                                    class="fa-solid fa-circle"></i> Online</label>
                        </div>
                    </div>
                    <hr>
                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('setting.index') }}"><i class="dw dw-settings2"></i>
                        Setting</a>
                    {{-- <a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="dw dw-logout"></i>{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
