@extends('layout.admin')

@php
    $pageTitle = 'Reports & Analytics';
@endphp

@section('title', 'Reports')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">Financial & Booking Reports</h2>
            <p class="text-muted mb-0 small">Performance intelligence, occupancy metrics, and gross revenue reports.</p>
        </div>
        <button class="btn btn-primary-blue" onclick="showToast('Export Report', 'Report exported to PDF', 'success')">
            <i data-lucide="file-text" style="width: 15px; height: 15px;"></i> Export PDF Report
        </button>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Filter Card -->
    <div class="card-custom p-3 mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-12 col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">From Date</label>
                {{-- BACKEND TODO: Connect start date filter parameter --}}
                <input type="date" class="form-control" id="fromDateFilter">
            </div>
            <div class="col-12 col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">To Date</label>
                {{-- BACKEND TODO: Connect end date filter parameter --}}
                <input type="date" class="form-control" id="toDateFilter">
            </div>
            <div class="col-12 col-sm-6 col-md-2">
                <label class="form-label small fw-semibold text-muted mb-1">City</label>
                {{-- BACKEND TODO: Populate select options from database cities --}}
                <select class="form-select" id="reportCityFilter">
                    <option value="">All Cities</option>
                    {{-- BACKEND TODO: `@foreach ($cities as $city)` --}}
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-2">
                <label class="form-label small fw-semibold text-muted mb-1">Hotel</label>
                {{-- BACKEND TODO: Populate select options from database hotels --}}
                <select class="form-select" id="reportHotelFilter">
                    <option value="">All Hotels</option>
                    {{-- BACKEND TODO: `@foreach ($hotels as $hotel)` --}}
                </select>
            </div>
            <div class="col-12 col-md-2">
                {{-- BACKEND TODO: Trigger controller query to reload filtered analytics report --}}
                <button class="btn btn-secondary-light w-100" onclick="showToast('Filtered', 'Applied date filters', 'info')">
                    <i data-lucide="filter" style="width: 15px; height: 15px;"></i> Apply Filters
                </button>
            </div>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Stat Cards Row -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            {{-- BACKEND TODO: Provide total filtered booking count --}}
            <x-stat-card 
                title="Total Bookings" 
                value="0" 
                icon="journal-check" 
                trend="0%" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            {{-- BACKEND TODO: Provide total filtered gross revenue ($) --}}
            <x-stat-card 
                title="Total Revenue" 
                value="$0" 
                icon="wallet-2" 
                trend="0%" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            {{-- BACKEND TODO: Provide average booking value ($) --}}
            <x-stat-card 
                title="Avg Booking Value" 
                value="$0.00" 
                icon="trending-up" 
                trend="0%" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            {{-- BACKEND TODO: Provide top performing hotel property name & booking share --}}
            <x-stat-card 
                title="Most Booked Hotel" 
                value="—" 
                icon="trophy" 
                trend="0% Share" 
                :trendUp="true" 
            />
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Report Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Bookings Over Time -->
        <div class="col-12 col-lg-6">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold text-dark mb-0">Bookings Over Time</h5>
                    <span class="text-muted small">Monthly Count</span>
                </div>
                <div style="height: 270px;">
                    <canvas id="reportBookingsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Revenue Over Time -->
        <div class="col-12 col-lg-6">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold text-dark mb-0">Revenue Over Time</h5>
                    <span class="text-muted small">Gross Earnings ($)</span>
                </div>
                <div style="height: 270px;">
                    <canvas id="reportRevenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Most Booked Places Table Card -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="p-3 bg-white border-bottom">
            <h5 class="fw-bold text-dark mb-0">Most Booked Places Summary</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th style="width: 60px;">Rank</th>
                        <th>Hotel Property</th>
                        <th>City</th>
                        <th>Total Bookings</th>
                        <th>Avg Occupancy</th>
                        <th>Gross Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- BACKEND TODO:
                         Populate hotel ranking summary records from backend controller.
                         Replace this empty state row with `@foreach ($rankedHotels as $index => $hotel)`.
                         Provide: rank position (#1, #2...), hotel name, city, booking count, occupancy percentage, and total revenue.
                    --}}
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <div class="py-2">
                                <i data-lucide="chart-no-axes-combined" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                <p class="mb-0 small fw-semibold">No report analytics available</p>
                                <span class="small text-secondary">Property performance summaries will appear here once retrieved from the database.</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bookings Report Chart
        // BACKEND TODO: Supply real monthly booking volume array from Laravel backend.
        const reportBookingsLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'];
        const reportBookingsData = []; // e.g. [140, 165, 190, ...]

        const ctxBookings = document.getElementById('reportBookingsChart').getContext('2d');
        new Chart(ctxBookings, {
            type: 'line',
            data: {
                labels: reportBookingsLabels,
                datasets: [{
                    label: 'Bookings',
                    data: reportBookingsData,
                    borderColor: '#0F62FE',
                    backgroundColor: 'rgba(15, 98, 254, 0.08)',
                    fill: true,
                    tension: 0.3,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Revenue Report Chart
        // BACKEND TODO: Supply real gross revenue data array from Laravel backend.
        const reportRevenueLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'];
        const reportRevenueData = []; // e.g. [18000, 21000, 24500, ...]

        const ctxRevenue = document.getElementById('reportRevenueChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'bar',
            data: {
                labels: reportRevenueLabels,
                datasets: [{
                    label: 'Revenue ($)',
                    data: reportRevenueData,
                    backgroundColor: '#0F62FE',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endpush
