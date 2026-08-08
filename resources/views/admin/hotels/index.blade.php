@extends('layouts.admin')

@section('title', 'إدارة الفنادق')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>إدارة الفنادق</h3>
        <a href="{{ route('hotels.create') }}" class="btn btn-primary">إضافة فندق جديد</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم الفندق</th>
                <th>المدينة</th>
                <th>التقييم</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hotels as $hotel)
                <tr>
                    <td>{{ $hotel->id }}</td>
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->city->name }}</td>
                    <td>{{ $hotel->rating }}</td>
                    <td>
                        <a href="{{ route('hotels.edit', $hotel) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('hotels.destroy', $hotel) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">لا توجد فنادق مضافة حاليًا</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $hotels->links() }}
@endsection