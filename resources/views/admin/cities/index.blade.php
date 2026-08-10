@extends('layout.admin')

@php
    $pageTitle = 'Cities Management';
@endphp

@section('title', 'Cities')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">Cities & Destinations</h2>
            <p class="text-muted mb-0 small">Manage destination cities where hotel properties and apartments are located.</p>
        </div>
        <button class="btn btn-primary-blue" data-bs-toggle="modal" data-bs-target="#addCityModal">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i> Add New City
        </button>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Filter Card -->
    <div class="card-custom p-3 mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="search-input-group w-100">
                    <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                    {{-- BACKEND TODO: Connect search query parameter to search cities in database --}}
                    <input type="text" class="form-control" placeholder="Search city by name..." data-table-search="citiesTable">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                {{-- BACKEND TODO: Connect status filter parameter to filter active/inactive cities --}}
                <select class="form-select" data-table-filter="status" data-table-target="citiesTable">
                    <option value="all">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-3 ms-auto text-end">
                <span class="text-muted small">
                    Total Cities: 
                    <strong class="text-dark">
                        {{-- BACKEND TODO: Display total count of cities from database --}}
                        0
                    </strong>
                </span>
            </div>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Cities Table Card -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="citiesTable">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>City Name</th>
                        <th>Hotels Count</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- BACKEND TODO:
                         Populate this table with city records retrieved from the database.
                         Replace this empty state row with `@foreach ($cities as $city)`.
                         The backend should provide: city ID, city name, region/country, hotel count, image path, and status.
                    --}}
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <div class="py-2">
                                <i data-lucide="map-pin" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                <p class="mb-0 small fw-semibold">No cities available</p>
                                <span class="small text-secondary">City records will appear here once retrieved from the database.</span>
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

<!-- Add City Modal -->
<div class="modal fade" id="addCityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            {{-- BACKEND TODO: Set form action endpoint and HTTP method to create a new city in database --}}
            <form action="" method="POST" class="js-dummy-form">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0">Add New City</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">City Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Cairo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Country / Region</label>
                        <input type="text" name="region" class="form-control" placeholder="e.g. Capital Region" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue">Save City</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit City Modal -->
<div class="modal fade" id="editCityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            {{-- BACKEND TODO: Set form action endpoint to update city record by ID --}}
            <form action="" method="POST" class="js-dummy-form">
                @csrf
                @method('PUT')
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0">Edit City</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">City Name</label>
                        {{-- BACKEND TODO: Bind city name field --}}
                        <input type="text" name="name" class="form-control" value="" placeholder="City Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        {{-- BACKEND TODO: Bind selected status --}}
                        <select name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue">Update City</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
