@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Start::page-header -->
            @php
                $user = Auth::user();
                $profileImage = $user->profile_image ?? null;

            @endphp
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div>
                    <p class="fw-semibold fs-18 mb-0">Welcome back, {{ $user->name }}!</p>
                    <span class="fs-semibold text-muted">Track your activity, leads and deals here.</span>
                </div>

            </div>

            <!-- End::page-header -->

            <!-- Start::row-1 -->
            <div class="row">
                <div class=" col-xl-12">
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="row">
                                {{-- Total Subscribers --}}
                                <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                    <div class="card custom-card overflow-hidden">
                                        <div class="card-body">
                                            <div class="d-flex align-items-top justify-content-between">
                                                <div>
                                                    <span class="avatar avatar-md avatar-rounded bg-primary">
                                                        <i class="ti ti-users fs-16"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-fill ms-3">
                                                    <div
                                                        class="d-flex align-items-center justify-content-between flex-wrap">
                                                        <div>
                                                            <p class="text-muted mb-0">Total Subscribers</p>
                                                            <h4 class="fw-semibold mt-1">{{ $totalSubscriberCount }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mt-1">
                                                        <a class="text-primary" href="{{ route('subscribers.index') }}">View
                                                            All</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Active Subscribers --}}
                                <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                    <div class="card custom-card overflow-hidden">
                                        <div class="card-body">
                                            <div class="d-flex align-items-top justify-content-between">
                                                <div>
                                                    <span class="avatar avatar-md avatar-rounded bg-success">
                                                        <i class="ti ti-check fs-16"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-fill ms-3">
                                                    <div
                                                        class="d-flex align-items-center justify-content-between flex-wrap">
                                                        <div>
                                                            <p class="text-muted mb-0">Active Subscribers</p>
                                                            <h4 class="fw-semibold mt-1">{{ $activeSubscriberCount }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mt-1">
                                                        <a class="text-primary" href="{{ route('subscribers.index') }}">View
                                                            All</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Inactive Subscribers --}}
                                <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                    <div class="card custom-card overflow-hidden">
                                        <div class="card-body">
                                            <div class="d-flex align-items-top justify-content-between">
                                                <div>
                                                    <span class="avatar avatar-md avatar-rounded bg-danger">
                                                        <i class="ti ti-x fs-16"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-fill ms-3">
                                                    <div
                                                        class="d-flex align-items-center justify-content-between flex-wrap">
                                                        <div>
                                                            <p class="text-muted mb-0">Inactive Subscribers</p>
                                                            <h4 class="fw-semibold mt-1">{{ $inActiveSubscriberCount }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mt-1">
                                                        <a class="text-primary" href="{{ route('subscribers.index') }}">View
                                                            All</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Total Signals --}}
                                <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                    <div class="card custom-card overflow-hidden">
                                        <div class="card-body">
                                            <div class="d-flex align-items-top justify-content-between">
                                                <div>
                                                    <span class="avatar avatar-md avatar-rounded bg-warning">
                                                        <i class="ti ti-waveform fs-16"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-fill ms-3">
                                                    <div
                                                        class="d-flex align-items-center justify-content-between flex-wrap">
                                                        <div>
                                                            <p class="text-muted mb-0">Total Signals</p>
                                                            <h4 class="fw-semibold mt-1">{{ $totalSignalCount }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mt-1">
                                                        <a class="text-primary" href="{{ route('signals.index') }}">View
                                                            All</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Total Assets --}}
                                <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                    <div class="card custom-card overflow-hidden">
                                        <div class="card-body">
                                            <div class="d-flex align-items-top justify-content-between">
                                                <div>
                                                    <span class="avatar avatar-md avatar-rounded bg-info">
                                                        <i class="ti ti-coins fs-16"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-fill ms-3">
                                                    <div
                                                        class="d-flex align-items-center justify-content-between flex-wrap">
                                                        <div>
                                                            <p class="text-muted mb-0">Total Assets</p>
                                                            <h4 class="fw-semibold mt-1">{{ $totalAssetCount }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mt-1">
                                                        <a class="text-primary" href="{{ route('signals.index') }}">View
                                                            All</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div>
                            <div class="d-none" id="crm-main"></div>
                        </div>
                        <div class="d-none" id="crm-total-customers"></div>
                        <div class="d-none" id="crm-total-revenue"></div>
                        <div id="crm-conversion-ratio" class="d-none"></div>
                        <div class="d-none" id="crm-total-deals"></div>
                        <div class="d-none" id="crm-revenue-analytics"></div>
                        <div class="d-none" id="crm-profits-earned"></div>
                        

                    </div>
                </div>

            </div>
            <!-- End::row-1 -->

        </div>
    </div>

    @push('scripts')
        <script>

        </script>
    @endpush
@endsection