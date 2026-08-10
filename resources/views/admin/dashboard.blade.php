@extends('layout.admin')

@php
    $pageTitle = 'Dashboard Overview';
@endphp

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Top Welcome Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">
                Welcome back
                {{-- BACKEND TODO: Display authenticated admin name here --}}
            </h2>
            <p class="text-muted mb-0 small">Here is what is happening with your hotels & bookings today.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-secondary-light" onclick="showToast('Refreshed', 'Dashboard stats updated', 'info')">
                <i data-lucide="refresh-cw" style="width: 15px; height: 15px;"></i> Refresh
            </button>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary-blue">
                <i data-lucide="plus" style="width: 15px; height: 15px;"></i> Manage Bookings
            </a>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Stat Cards Row -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            {{-- BACKEND TODO: Provide total number of bookings from database --}}
            <x-stat-card 
                title="Total Bookings" 
                value="0" 
                icon="calendar-check" 
                trend="0%" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            {{-- BACKEND TODO: Provide total gross revenue ($) from database --}}
            <x-stat-card 
                title="Total Revenue" 
                value="$0" 
                icon="dollar-sign" 
                trend="0%" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            {{-- BACKEND TODO: Provide total registered user count from database --}}
            <x-stat-card 
                title="Total Users" 
                value="0" 
                icon="users" 
                trend="0%" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            {{-- BACKEND TODO: Provide available room count from database --}}
            <x-stat-card 
                title="Available Places" 
                value="0 Rooms" 
                icon="building-2" 
                trend="0%" 
                :trendUp="false" 
            />
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Booking Statistics Over Time -->
        <div class="col-12 col-lg-8">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Booking Statistics Over Time</h5>
                        <small class="text-muted">Monthly reservation volume</small>
                    </div>
                    {{-- BACKEND TODO: Connect year filter parameter to update chart dataset dynamically --}}
                    <select class="form-select form-select-sm w-auto" id="dashboardYearFilter">
                        <option value="2026">This Year (2026)</option>
                        <option value="2025">Last Year (2025)</option>
                    </select>
                </div>
                <div style="height: 280px;">
                    <canvas id="bookingTrendsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Most Booked Places Doughnut -->
        <div class="col-12 col-lg-4">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Most Booked Places</h5>
                        <small class="text-muted">Distribution by Top Hotel</small>
                    </div>
                </div>
                <div style="height: 260px;" class="d-flex align-items-center justify-content-center">
                    <canvas id="mostBookedChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Revenue Overview & Recent Bookings -->
    <div class="row g-4">
        <!-- Revenue Bar Chart -->
        <div class="col-12 col-xl-4">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Revenue Overview</h5>
                        <small class="text-muted">Quarterly earnings ($)</small>
                    </div>
                </div>
                <div style="height: 270px;">
                    <canvas id="revenueBarChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Bookings Table Card -->
        <div class="col-12 col-xl-8">
            <div class="card-custom h-100 mb-0 p-0 overflow-hidden">
                <div class="p-3 bg-white border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Recent Reservations</h5>
                        <small class="text-muted">Latest guest activity</small>
                    </div>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary-light btn-sm">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom align-middle" id="mainTable">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Guest</th>
                                <th>Hotel</th>
                                <th>Room</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- BACKEND TODO:
                                Loop through the recent booking records from the database.
                                Replace this empty state row with `@foreach ($recentBookings as $booking)`.
                                Provide: booking ID, guest name/email, hotel name, room type, check-in date, check-out date, and status.
                            --}}
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <div class="py-2">
                                        <i data-lucide="inbox" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                        <p class="mb-0 small fw-semibold">No recent reservations available</p>
                                        <span class="small text-secondary">New booking records will appear here once retrieved from the database.</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Booking Trends Line Chart
        // BACKEND TODO: Supply real monthly booking counts array from backend controller.
        const bookingTrendsLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const bookingTrendsData = []; // Fill with real data array e.g. [10, 20, 30, ...]
        const ctxTrends = document.getElementById('bookingTrendsChart').getContext('2d');
        new Chart(ctxTrends, {
            type: 'line',
            data: {
                labels: bookingTrendsLabels,
                datasets: [{
                    label: 'Bookings',
                    data: bookingTrendsData,
                    borderColor: '#0F62FE',
                    backgroundColor: 'rgba(15, 98, 254, 0.08)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#0F62FE',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#EAECEF' }, ticks: { color: '#6F6E77' }, beginAtZero: true },
                    x: { grid: { display: false }, ticks: { color: '#6F6E77' } }
                }
            }
        });
        // 2. Most Booked Places Doughnut Chart
        // BACKEND TODO: Supply real hotel breakdown labels and reservation count distribution from backend controller.
        const mostBookedLabels = []; // e.g. ['Hotel A', 'Hotel B']
        const mostBookedData = [];   // e.g. [50, 30]
        const ctxMostBooked = document.getElementById('mostBookedChart').getContext('2d');
        new Chart(ctxMostBooked, {
            type: 'doughnut',
            data: {
                labels: mostBookedLabels,
                datasets: [{
                    data: mostBookedData,
                    backgroundColor: ['#0F62FE', '#6F6E77', '#161616', '#A855F7'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, padding: 12 } } },
                cutout: '72%'
            }
        });
        // 3. Revenue Bar Chart
        // BACKEND TODO: Supply real quarterly/monthly revenue array from backend controller.
        const revenueLabels = ['Q1', 'Q2', 'Q3', 'Q4'];
        const revenueData = []; // e.g. [15000, 22000, 30000, 25000]
        const ctxRevenue = document.getElementById('revenueBarChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'bar',
            data: {
                labels: revenueLabels,
                datasets: [{
                    label: 'Revenue ($)',
                    data: revenueData,
                    backgroundColor: '#0F62FE',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#EAECEF' }, ticks: { color: '#6F6E77' }, beginAtZero: true },
                    x: { grid: { display: false }, ticks: { color: '#6F6E77' } }
                }
            }
        });
    });
</script>
@endpush
