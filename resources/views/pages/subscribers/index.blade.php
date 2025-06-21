@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>

    </style>
@endsection

@section('title', 'Subscribers')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Breadcrumb header remains the same -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Subscribers</h1>
                <div class="ms-md-1 ms-0">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Subscriber</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Subscriber List</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SubscriberModal">
                Create New Subscriber
            </button>

            <!-- Modal -->
            <div class="modal fade" id="SubscriberModal" tabindex="-1" aria-labelledby="SubscriberModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="SubscriberModalLabel">Create New Subscriber</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Fixed form ID (was typo "subsciber-form") -->
                            <form id="subscriber-form">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="username"
                                            placeholder="Enter Username">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Enter Password">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is-open-switch"
                                                name="is_open" checked>
                                            <label class="form-check-label" for="is-open-switch">Subscriber is
                                                Active</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- Fixed form reference (was "Subscriber-form") -->
                            <button type="submit" form="subscriber-form" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side-by-side layout -->
            <div class="row mt-3">
                <!-- Left Column - Form -->


                <!-- Right Column - Table -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Subscriber Listing</h5>
                        </div>
                        <div class="card-body">
                            <table id="Subscribers-table" class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Serial Number</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Expire Date</th>
                                        <th>Created Date</th>
                                       
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded via JavaScript -->
                                </tbody>
                            </table>
                            <div id="table-loading-overlay" style="display: none;">
                                <div class="overlay-backdrop"></div>
                                <div class="overlay-spinner">
                                    <div class="spinner-border text-primary" Subscriber="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('scripts')
    @include('pages.subscribers.js')
@endpush