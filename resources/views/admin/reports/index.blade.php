@extends('layouts.admin')

@section('title', 'التقارير')

@section('content')
    <h3 class="mb-4">تقارير الإيرادات والحجوزات</h3>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">إجمالي الإيرادات</h5>
                    <h2>{{ number_format($totalRevenue, 2) }} ج.م</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">إيرادات الشهر الحالي</h5>
                    <h2>{{ number_format($monthlyRevenue, 2) }} ج.م</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">توزيع الحجوزات حسب الحالة</div>
        <div class="card-body">
            @forelse ($bookingsByStatus as $status => $count)
                <span class="badge bg-secondary me-2">{{ $status }}: {{ $count }}</span>
            @empty
                <p class="text-muted">لا توجد حجوزات حاليًا</p>
            @endforelse
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">أكثر 5 فنادق حجزًا</div>
                <ul class="list-group list-group-flush">
                    @forelse ($topHotels as $hotel)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $hotel->name }}
                            <span class="badge bg-info">{{ $hotel->bookings_count }} حجز</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">لا توجد بيانات كافية</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">أكثر 5 غرف حجزًا</div>
                <ul class="list-group list-group-flush">
                    @forelse ($topRooms as $room)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $room->type }} - {{ $room->hotel->name ?? '' }}
                            <span class="badge bg-info">{{ $room->bookings_count }} حجز</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">لا توجد بيانات كافية</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection