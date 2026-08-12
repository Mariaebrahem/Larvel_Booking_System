@extends('layouts.admin')

@section('title', 'إدارة المدن')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>إدارة المدن</h3>
        <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">إضافة مدينة جديدة</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم المدينة</th>
                <th>تاريخ الإضافة</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cities as $city)
                <tr>
                    <td>{{ $city->id }}</td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.cities.edit', $city) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">لا توجد مدن مضافة حاليًا</td>
                </tr>
            @endforelse
        </tbody>
    </table>

  {{ $cities->links() }}
@endsection