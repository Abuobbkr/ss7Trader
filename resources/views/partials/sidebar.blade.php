<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{ route('dashboard') }}" class="header-logo">
            <img src="{{ asset('images/ss7-logo.png') }}" alt="Logo" class="desktop-dark" style="height: 40px;">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">

            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>

            <ul class="main-menu">

                <!-- Main Category -->
                <li class="slide__category">
                    <span class="category-name">Main</span>
                </li>

                <!-- Dashboard -->
                <li class="slide">
                    <a href="{{ route('dashboard') }}" class="side-menu__item">
                        <i class="bx bx-home side-menu__icon"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <!-- Pages Category -->
                <li class="slide__category">
                    <span class="category-name">Pages</span>
                </li>

                <!-- Signals -->
                <li class="slide">
                    <a href="{{ route('signals.index') }}" class="side-menu__item">
                        <i class="bx bx-signal-5 side-menu__icon"></i>
                        <span class="side-menu__label">Signals</span>
                    </a>
                </li>

                <!-- Subscribers -->
                <li class="slide">
                    <a href="{{ route('subscribers.index') }}" class="side-menu__item">
                        <i class="bx bx-user-check side-menu__icon"></i>
                        <span class="side-menu__label">Subscribers</span>
                    </a>
                </li>

                <!-- Asset -->
                 <li class="slide">
                    <a href="{{ route('assets.index') }}" class="side-menu__item">
                        <i class="bx bx-user-check side-menu__icon"></i>
                        <span class="side-menu__label">Assets</span>
                    </a>
                </li>
                <!-- Ads -->
                 <li class="slide">
                    <a href="{{ route('ads.index') }}" class="side-menu__item">
                        <i class="bx bx-user-check side-menu__icon"></i>
                        <span class="side-menu__label">Advertisement</span>
                    </a>
                </li>
                

            </ul>

            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>

        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->