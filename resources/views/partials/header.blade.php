<!-- app-header -->
<header class="app-header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="" class="header-logo">
                        <img src="{{ asset('images/ss7-logo.png') }}" alt="logo" class="desktop-logo">
                        <img src="{{ asset('images/ss7-logo.png') }}" alt="logo" class="toggle-logo">
                        <img src="{{ asset('images/ss7-logo.png') }}" alt="logo" class="desktop-dark">
                        <img src="{{ asset('images/ss7-logo.png') }}" alt="logo" class="toggle-dark">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link -->
                <a aria-label="Hide Sidebar"
                    class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                    data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">



            <!-- Start::header-element -->
            <div class="header-element header-theme-mode">
                <!-- Start::header-link|layout-setting -->
                <a href="javascript:void(0);" class="header-link layout-setting">
                    <span class="light-layout">
                        <!-- Start::header-link-icon -->
                        <i class="bx bx-moon header-link-icon"></i>
                        <!-- End::header-link-icon -->
                    </span>
                    <span class="dark-layout">
                        <!-- Start::header-link-icon -->
                        <i class="bx bx-sun header-link-icon"></i>
                        <!-- End::header-link-icon -->
                    </span>
                </a>
                <!-- End::header-link|layout-setting -->
            </div>
            <!-- End::header-element -->





            <!-- End::header-element -->
            @php
                $user = Auth::user();
                $profileImage = $user->profile_image ?? null;
                $imagePath = $profileImage && file_exists(public_path('uploads/profiles/' . $profileImage))
                    ? asset('uploads/profiles/' . $profileImage)
                    : asset('images/default.png'); // default image path
            @endphp
            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="#" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="me-sm-2 me-0">
                            <img src="{{ $imagePath }}" alt="img" width="32" height="32" class="rounded-circle">
                        </div>
                        <div class="d-sm-block d-none">
                            <p class="fw-semibold mb-0 lh-1">{{ $user->name }}</p>
                            <span class="op-7 fw-normal d-block fs-11">{{ $user->role ?? 'User' }}</span>
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                    aria-labelledby="mainHeaderProfile">
                    <!-- <li><a class="dropdown-item d-flex" href="profile.html"><i
                                class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li>

                    <li> -->
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex bg-transparent border-0">
                                <i class="ti ti-logout fs-18 me-2 op-7"></i>Log Out
                            </button>
                        </form>
                    </li>


                </ul>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->

            <!-- End::header-element -->

        </div>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
<!-- /app-header -->