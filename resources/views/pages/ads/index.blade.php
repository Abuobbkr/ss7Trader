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

@section('title', 'Advertisments')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Breadcrumb header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Advertisment</h1>
                <div class="ms-md-1 ms-0">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Advertisment</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Advertisment List</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SideImageModal">
                Create Side Image
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#BannerImageModal">
                Create New Banner Image
            </button>

            <!-- Modal for Create/Edit Advertisment -->
            <div class="modal fade" id="SideImageModal" tabindex="-1" aria-labelledby="SideImageModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="SideImageModalLabel">Create Side Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="ads-sidebar-form">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Side Image Upload</label>
                                            <input type="file" class="form-control" name="sidebar_image" accept="image/*">
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="ads-sidebar-form" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="BannerImageModal" tabindex="-1" aria-labelledby="BannerImageModal"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="BannerImageModalLabel">Create Banner Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="ads-banner-form">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-3">

                                        <div class="col-md-6">
                                            <label class="form-label">Banner Image Upload</label>
                                            <input type="file" class="form-control" name="banner_image" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="ads-banner-form" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Sidebar Images</h3>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sideImages as $index => $ad)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><img src="{{ $ad->sidebar_image }}" width="100"></td>
                                        <td>{{ $ad->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No sidebar images found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="card-header">

                            <h3>Banner Images</h3>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bannerImages as $index => $ad)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><img src="{{ $ad->banner_image }}" width="100"></td>
                                        <td>{{ $ad->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No banner images found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
                            Are you sure you want to delete this Advertisment? This action cannot be undone.
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
    @include('pages.ads.js')
@endpush