@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
            /* Above modal content */
            border-radius: 0.5rem;
        }

        .overlay-backdrop {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: 1040;
            /* Below spinner */
        }

        .overlay-spinner {
            position: relative;
            z-index: 1050;
            /* Above backdrop */
        }
    </style>
@endsection

@section('title', 'Assets')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Breadcrumb header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Assets</h1>
                <div class="ms-md-1 ms-0">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Asset</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Asset List</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assetModal">
                Create New Asset
            </button>

            <!-- Modal for Create/Edit Asset -->
            <div class="modal fade" id="assetModal" tabindex="-1" aria-labelledby="assetModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="assetModalLabel">Create New Asset</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="asset-form">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Pair Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="pair_name"
                                                placeholder="e.g., BTC/USD">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Market Type <span class="text-danger">*</span></label>
                                            <select class="form-select" name="market_type">
                                                <option value="">Select Market Type</option>
                                                <option value="forex">Forex</option>
                                                <option value="crypto">Crypto</option>
                                                <option value="stock">Stock</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Image Upload</label>
                                            <input type="file" class="form-control" name="asset_image" accept="image/*">
                                        </div>


                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="asset-form" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Table for Asset Listing -->
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Asset Listing</h5>
                        </div>
                        <div class="card-body">
                            <table id="assets-table" class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Serial Number</th>
                                        <th>Created At</th>
                                        <th>Pair Name</th>
                                        <th>Market Type</th>
                                        <th>Image</th>
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
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmation Modal (for delete) -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this asset? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    @include('pages.assets.js')
@endpush