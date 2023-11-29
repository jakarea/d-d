<!-- header part start -->
<header class="header-area">
    <!-- search box start -->
    <div class="header-search-box">
        <img src="{{ asset('assets/images/icons/search.svg') }}" alt="S" class="img-fluid search">
        <input type="text" class="form-control" placeholder="Search">
        <a href="#" class="filter">
            <img src="{{ asset('assets/images/icons/filter.svg') }}" alt="F" class="img-fluid">
        </a>
    </div>
    <!-- search box end -->

    <!-- header icons start -->
    <div class="header-icons-box">
        <ul class="main">
            <li>
                <a href="#">
                    <span></span>
                    <img src="{{ asset('assets/images/icons/bell.svg') }}" alt="B" class="img-fluid">
                </a>
            </li>
            <li>
                <div class="dropdown p-0 header-dropdown">
                    <a class="p-0 user" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/user.png') }}" alt="B" class="img-fluid">
                        <i class="fas fa-angle-down ms-2"></i>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item {{ Request::is('account/my-profile') ? 'active' : ''}}"
                                href="{{url('account/my-profile')}}">Profile
                                @if (Request::is('account/my-profile'))
                                <i class="fas fa-check"></i>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item  {{ Request::is('account/edit-profile') ? 'active' : ''}}"
                                href="{{url('account/edit-profile')}}">
                                Profile Setting
                                @if (Request::is('account/edit-profile'))
                                <i class="fas fa-check"></i>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#" class="d-lg-none" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- header icons end -->
</header>
<!-- header part end -->