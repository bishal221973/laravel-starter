<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
            <img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo" />
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
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="myicon fa-solid fa-shield-halved"></span><span class="mtext">Role Management</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="#">Role List</a></li>
                        <li><a href="{{route('role.create')}}">New Role</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="myicon fa-solid fa-map"></span><span class="mtext">Address</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('country.index')}}">Country</a></li>
                        <li><a href="{{route('role.create')}}">Province</a></li>
                        <li><a href="{{route('role.create')}}">District</a></li>
                        <li><a href="{{route('role.create')}}">Municipality</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
