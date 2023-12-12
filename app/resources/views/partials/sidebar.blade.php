<!-- sidebar wrapper start -->
<aside class="sidebar-wrap">
    <!-- logo -->
    <div class="logo-box">
        <a href="{{url('/')}}">
            <img src="{{ asset('public/assets/images/logo.svg') }}" alt="Logo" class="img-fluid">
        </a>
    </div>
    <!-- logo -->

    <!-- navbar -->
    <div class="side-navbar-wrap">
        <ul>
            <li>
                <a href="{{url('/dashboard')}}" class="{{ Request::is('dashboard') ? 'active' : ''}}">
                    <img src="{{ asset('public/assets/images/icons/dashboard.svg') }}" alt="I" class="img-fluid">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{url('/category')}}" class="{{ Request::is('category*') ? 'active' : ''}}">
                    <img src="{{ asset('public/assets/images/icons/marketplace.svg') }}" alt="I" class="img-fluid">
                    Categories
                </a>
            </li>
            <li>
                <a href="{{url('/marketplace')}}" class="{{ Request::is('marketplace*') ? 'active' : ''}}">
                    <img src="{{ asset('public/assets/images/icons/marketplace.svg') }}" alt="I" class="img-fluid">
                    Marketplace
                </a>
            </li>
            <li>
                <a href="{{url('/company')}}" class="{{ Request::is('company*') ? 'active' : ''}}">
                    <img src="{{ asset('public/assets/images/icons/company.svg') }}" alt="I" class="img-fluid">
                    Company
                </a>
            </li>
            <li>
                <a href="{{url('/users')}}" class="{{ Request::is('users*') ? 'active' : ''}}">
                    <img src="{{ asset('public/assets/images/icons/customer.svg') }}" alt="I" class="img-fluid">
                    Customer
                </a>
            </li>
            <li>
                <a href="{{url('/analytics')}}" class="{{ Request::is('analytics*') ? 'active' : ''}}">
                    <img src="{{ asset('public/assets/images/icons/analytics.svg') }}" alt="I" class="img-fluid">
                    Analytics
                </a>
            </li>
            <li>
                <a href="{{url('/earning')}}" class="{{ Request::is('earning*') ? 'active' : ''}}">
                    <img src="{{ asset('public/assets/images/icons/earnings.svg') }}" alt="I" class="img-fluid">
                     Earning
                </a>
            </li>
            <li>
                <a href="{{url('/packages')}}" class="{{ Request::is('packages*') ? 'active' : ''}}">
                    <img src="{{ asset('public/assets/images/icons/fee.svg') }}" alt="I" class="img-fluid">
                    Monthly &amp; Yearly Fee
                </a>
            </li>
            <li>
                <a href="{{url('/advertisement')}}" class="{{ Request::is('advertisement*') ? 'active' : ''}}">
                    <img src="{{ asset('public/assets/images/icons/advertisment.svg') }}" alt="I" class="img-fluid">
                    Advertisement
                </a>
            </li>
            <li>
                <a href="{{url('/logout')}}">
                    <i class="fas fa-sign-out me-3"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- navbar -->
</aside>
<!-- sidebar wrapper end -->
