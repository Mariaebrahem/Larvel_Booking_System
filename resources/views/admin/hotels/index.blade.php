@extends('layout.admin')

@php
    $pageTitle = 'Hotels Management';
@endphp

@section('title', 'Hotels')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">Hotels & Properties</h2>
            <p class="text-muted mb-0 small">Manage registered hotel properties, resort listings, and addresses.</p>
        </div>
        <button class="btn btn-primary-blue" data-bs-toggle="modal" data-bs-target="#addHotelModal">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i> Add New Hotel
        </button>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Filter Card -->
    <div class="card-custom p-3 mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="search-input-group w-100">
                    <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                    {{-- BACKEND TODO: Connect search input to query hotel records by name or address --}}
                    <input type="text" class="form-control" placeholder="Search hotel name or city..." data-table-search="hotelsTable">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                {{-- BACKEND TODO: Populate city options from database and filter hotels accordingly --}}
                <select class="form-select" id="cityFilter">
                    <option value="">All Cities</option>
                    {{-- BACKEND TODO: `@foreach ($cities as $city)` --}}
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                {{-- BACKEND TODO: Filter hotels by active/inactive status --}}
                <select class="form-select" data-table-filter="status" data-table-target="hotelsTable">
                    <option value="all">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Hotels Table Card -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="hotelsTable">
                <thead>
                    <tr>
                        <th style="width: 70px;">Image</th>
                        <th>Hotel Name</th>
                        <th>City</th>
                        <th>Rating</th>
                        <th>Number of Rooms</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- BACKEND TODO:
                         Populate this table with hotel records from the database.
                         Replace this empty state row with `@foreach ($hotels as $hotel)`.
                         Provide: thumbnail image, hotel name, address, city name, average rating, room count, and status.
                    --}}
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <div class="py-2">
                                <i data-lucide="building-2" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                <p class="mb-0 small fw-semibold">No hotels available</p>
                                <span class="small text-secondary">Hotel listings will appear here once retrieved from the database.</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- BACKEND TODO: Render dynamic pagination links from Laravel controller --}}
        <x-pagination :total="0" :perPage="10" />
    </div>

</div>

<!-- Add Hotel Modal -->
<div class="modal fade" id="addHotelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            {{-- BACKEND TODO: Set form action endpoint and method to create new hotel in database --}}
            <form action="" method="POST" class="js-dummy-form">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0">Add New Hotel Listing</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Hotel Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Grand Hotel" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">City</label>
                            {{-- BACKEND TODO: Populate select options from database cities --}}
                            <select name="city_id" class="form-select" required>
                                <option value="">Select City</option>
                                {{-- BACKEND TODO: `@foreach ($cities as $city)` --}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue">Create Hotel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Hotel Modal -->
<div class="modal fade" id="editHotelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            {{-- BACKEND TODO: Set form action endpoint to update hotel record by ID --}}
            <form action="" method="POST" class="js-dummy-form">
                @csrf
                @method('PUT')
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0">Edit Hotel</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Hotel Name</label>
                        {{-- BACKEND TODO: Bind hotel name field --}}
                        <input type="text" name="name" class="form-control" value="" placeholder="Hotel Name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue">Update Hotel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
