@extends('layouts.admin')

@section('title', 'إدارة الغرف')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>إدارة الغرف</h3>
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">إضافة غرفة جديدة</a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>الصورة</th>
                <th>النوع</th>
                <th>الفندق</th>
                <th>السعر</th>
                <th>السعة</th>
                <th>متاحة؟</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>
                        @if ($room->image)
                            <img src="{{ asset('storage/' . $room->image) }}" width="70" height="50" style="object-fit: cover;">
                        @else
                            <span class="text-muted">لا توجد صورة</span>
                        @endif
                    </td>
                    <td>{{ $room->type }}</td>
                    <td>{{ $room->hotel->name }}</td>
                    <td>{{ $room->price }} ج.م</td>
                    <td>{{ $room->capacity }}</td>
                    <td>
                        @if ($room->is_available)
                            <span class="badge bg-success">متاحة</span>
                        @else
                            <span class="badge bg-secondary">غير متاحة</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">لا توجد غرف مضافة حاليًا</td>
                </tr>
            @endforelse
        </tbody>
    </table>

  {{ $rooms->links() }}
@endsection