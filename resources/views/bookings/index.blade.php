@extends('layouts.user')

@section('title', 'حجوزاتي')

@section('content')
<div class="container my-4">
    <h3 class="fw-bold mb-4">حجوزاتي</h3>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الفندق</th>
                    <th>الغرفة</th>
                    <th>تاريخ الوصول</th>
                    <th>تاريخ المغادرة</th>
                    <th>السعر الإجمالي</th>
                    <th>الحالة</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->room->hotel->name ?? '-' }}</td>
                        <td>{{ $booking->room->type ?? '-' }}</td>
                        <td>{{ $booking->check_in_date }}</td>
                        <td>{{ $booking->check_out_date }}</td>
                        <td>{{ number_format($booking->total_price, 2) }}$</td>
                        <td>
                            <span class="badge bg-secondary">{{ $booking->status }}</span>
                        </td>
                        <td>
                            @if (in_array($booking->status, ['pending', 'approved']))
                                <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('هل أنت متأكد من إلغاء الحجز؟')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">إلغاء</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">لا توجد حجوزات حتى الآن</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $bookings->links() }}
</div>
@endsection