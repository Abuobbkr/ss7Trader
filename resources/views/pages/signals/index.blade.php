@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>

    </style>
@endsection

@section('title', 'Signals')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Breadcrumb header remains the same -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Signals</h1>
                <div class="ms-md-1 ms-0">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Signal</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Signal List</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SignalModal">
                Create New Signal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="SignalModal" tabindex="-1" aria-labelledby="SignalModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="SignalModalLabel">Create New Signal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="signal-form">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Currency Pair <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="pair_name">
                                                <option value="">Select Currency Pair</option>
                                                @foreach($assets as $asset)
                                                    <option value="{{ $asset->pair_name }}">{{ $asset->pair_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Signal Type <span class="text-danger">*</span></label>
                                            <select class="form-select" name="signal_type">
                                                <option value="buy">Buy/Long</option>
                                                <option value="sell">Sell/Short</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Signal Type <span class="text-danger">*</span></label>
                                            <select class="form-select" name="market_type">
                                                <option value="">Select Market Type</option>
                                                <option value="forex">forex</option>
                                                <option value="crypto">crypto</option>
                                                <option value="stock">stock</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Entry Price <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" step="0.00001" class="form-control" name="entry_price">
                                                <div class="input-group-text">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="entry-price-switch" name="entry_price_premium" checked>
                                                        <label class="form-check-label visually-hidden"
                                                            for="entry-price-switch">Entry Price Premium</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Stop Loss <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" step="0.00001" class="form-control" name="stop_loss">
                                                <div class="input-group-text">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="stop-loss-switch" name="stop_loss_premium" checked>
                                                        <label class="form-check-label visually-hidden"
                                                            for="stop-loss-switch">Stop Loss Premium</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Take Profit <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" step="0.00001" class="form-control" name="take_profit">
                                                <div class="input-group-text">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="take-profit-switch" name="take_profit_premium" checked>
                                                        <label class="form-check-label visually-hidden"
                                                            for="take-profit-switch">Take Profit Premium</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Group Type <span class="text-danger">*</span></label>
                                            <select class="form-select" name="group_type">
                                                <option value="free">Free</option>
                                                <option value="premium">Premium</option>
                                                <option value="both">Both</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-center">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="is-open-switch"
                                                    name="is_open" checked>
                                                <label class="form-check-label" for="is-open-switch">Signal is
                                                    Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="signal-form" class="btn btn-primary">Submit</button>
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
                            <h5 class="card-title">Signal Listing</h5>
                        </div>
                        <div class="card-body">
                            <table id="signals-table" class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Serial Number</th>
                                        <th>Currency Pair</th>
                                        <th>Signal Type</th>
                                        <th>Entry Price</th>
                                        <th>Stop Loss</th>
                                        <th>Take Profit</th>
                                        <th>Group Type</th>
                                        <th>Market Type</th>
                                        <th>Status</th>
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
                                    <div class="spinner-border text-primary" Signal="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmation Modal (remains the same) -->
            <div class="modal fade" id="confirmModal">
                <!-- ... existing modal code ... -->
            </div>
        </div>
    </div>



@endsection
@push('scripts')
    @include('pages.signals.js')

@endpush