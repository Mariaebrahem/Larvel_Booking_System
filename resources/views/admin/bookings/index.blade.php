@extends('layout.admin')

@php
    $pageTitle = 'Bookings Management';
@endphp

@section('title', 'Bookings')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">Bookings & Reservations</h2>
            <p class="text-muted mb-0 small">Monitor reservation activity, process guest check-ins, and manage status approvals.</p>
        </div>
        <button class="btn btn-secondary-light" onclick="showToast('Export Data', 'Bookings exported to CSV', 'info')">
            <i data-lucide="download" style="width: 15px; height: 15px;"></i> Export Data
        </button>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Filter Card -->
    <div class="card-custom p-3 mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="search-input-group w-100">
                    <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                    {{-- BACKEND TODO: Connect search input to query booking ID or guest name in database --}}
                    <input type="text" class="form-control" placeholder="Search Guest or Booking ID..." data-table-search="bookingsTable">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                {{-- BACKEND TODO: Filter bookings by status (pending, confirmed, checked-in, checked-out, rejected, cancelled) --}}
                <select class="form-select" data-table-filter="status" data-table-target="bookingsTable">
                    <option value="all">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="checked-in">Checked In</option>
                    <option value="checked-out">Checked Out</option>
                    <option value="rejected">Rejected</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                {{-- BACKEND TODO: Populate select options with hotels from database --}}
                <select class="form-select" id="hotelFilter">
                    <option value="">All Hotels</option>
                    {{-- BACKEND TODO: `@foreach ($hotels as $hotel)` --}}
                </select>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                {{-- BACKEND TODO: Filter bookings by date range --}}
                <div class="input-group">
                    <input type="date" class="form-control" id="startDateFilter">
                    <span class="input-group-text bg-light text-muted border-0">to</span>
                    <input type="date" class="form-control" id="endDateFilter">
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Bookings Table Card -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="bookingsTable">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Guest</th>
                        <th>Hotel</th>
                        <th>Room</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Guests</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th class="text-end" style="min-width: 170px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- BACKEND TODO:
                         Populate this table with real booking records from Laravel.
                         Replace this empty state row with `@foreach ($bookings as $booking)`.
                         The backend should provide:
                         - Booking ID (#BK-XXXX)
                         - Guest Name & Email
                         - Hotel Name
                         - Room Number & Category
                         - Check-in Date
                         - Check-out Date
                         - Guests Count
                         - Total Price ($)
                         - Booking Status (Pending, Confirmed, Checked In, Checked Out, Rejected, Cancelled)
                    --}}
                    <tr>
                        <td colspan="10" class="text-center py-4 text-muted">
                            <div class="py-2">
                                <i data-lucide="calendar-check" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                <p class="mb-0 small fw-semibold">No bookings available</p>
                                <span class="small text-secondary">Guest reservation records will appear here once retrieved from the database.</span>
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

<!-- Booking Details Modal -->
<div class="modal fade" id="bookingDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold fs-6 mb-0">
                    Booking Details
                    {{-- BACKEND TODO: Bind booking ID --}}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border-0">
                            <h6 class="fw-bold text-primary mb-2">Guest Information</h6>
                            {{-- BACKEND TODO: Bind guest details --}}
                            <p class="mb-1 small"><strong>Name:</strong> <span id="modalGuestName">—</span></p>
                            <p class="mb-1 small"><strong>Email:</strong> <span id="modalGuestEmail">—</span></p>
                            <p class="mb-0 small"><strong>Phone:</strong> <span id="modalGuestPhone">—</span></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border-0">
                            <h6 class="fw-bold text-primary mb-2">Reservation Details</h6>
                            {{-- BACKEND TODO: Bind reservation details --}}
                            <p class="mb-1 small"><strong>Hotel:</strong> <span id="modalHotelName">—</span></p>
                            <p class="mb-1 small"><strong>Room:</strong> <span id="modalRoomNumber">—</span></p>
                            <p class="mb-0 small"><strong>Dates:</strong> <span id="modalDates">—</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Close</button>
                {{-- BACKEND TODO: Connect booking action buttons to controller endpoints (accept, reject, check-in, check-out) --}}
            </div>
        </div>
    </div>
</div>
@endsection
