@extends('layout.admin')

@php
    $pageTitle = 'Rooms Management';
@endphp

@section('title', 'Rooms')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">Hotel Rooms</h2>
            <p class="text-muted mb-0 small">Manage individual room inventory, room pricing, capacities, and availability status.</p>
        </div>
        <button class="btn btn-primary-blue" data-bs-toggle="modal" data-bs-target="#addRoomModal">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i> Add New Room
        </button>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Filter Card -->
    <div class="card-custom p-3 mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-4">
                <div class="search-input-group w-100">
                    <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                    {{-- BACKEND TODO: Search room records by room number or hotel name --}}
                    <input type="text" class="form-control" placeholder="Search room # or hotel..." data-table-search="roomsTable">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                {{-- BACKEND TODO: Populate select options from database hotels --}}
                <select class="form-select" id="hotelFilter">
                    <option value="">All Hotels</option>
                    {{-- BACKEND TODO: `@foreach ($hotels as $hotel)` --}}
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                {{-- BACKEND TODO: Filter rooms by availability status --}}
                <select class="form-select" data-table-filter="status" data-table-target="roomsTable">
                    <option value="all">All Room Statuses</option>
                    <option value="available">Available</option>
                    <option value="occupied">Occupied</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Rooms Table Card -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="roomsTable">
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Hotel</th>
                        <th>Room Type</th>
                        <th>Price / Night</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- BACKEND TODO:
                         Populate this table with room records from database.
                         Replace this empty state row with `@foreach ($rooms as $room)`.
                         Provide: room number, hotel name, room category, night price ($), max capacity, and availability status.
                    --}}
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <div class="py-2">
                                <i data-lucide="bed-double" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                <p class="mb-0 small fw-semibold">No rooms available</p>
                                <span class="small text-secondary">Room inventory records will appear here once retrieved from the database.</span>
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

<!-- Add Room Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            {{-- BACKEND TODO: Set form action endpoint and method to create room record --}}
            <form action="" method="POST" class="js-dummy-form">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0">Add New Room</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Hotel</label>
                        {{-- BACKEND TODO: Populate select options from database hotels --}}
                        <select name="hotel_id" class="form-select" required>
                            <option value="">Select Hotel</option>
                            {{-- BACKEND TODO: `@foreach ($hotels as $hotel)` --}}
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Room Number</label>
                            <input type="text" name="room_number" class="form-control" placeholder="e.g. 101" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Price per Night ($)</label>
                            <input type="number" name="price" class="form-control" placeholder="150" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Room Modal -->
<div class="modal fade" id="editRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            {{-- BACKEND TODO: Set form action endpoint to update room record by ID --}}
            <form action="" method="POST" class="js-dummy-form">
                @csrf
                @method('PUT')
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0">Edit Room</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Price per Night ($)</label>
                        {{-- BACKEND TODO: Bind room price field --}}
                        <input type="number" name="price" class="form-control" value="" placeholder="Price per Night" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue">Update Room</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
