@extends('layouts.admin')

@section('title', 'إضافة مدينة')

@section('content')
    <h3>إضافة مدينة جديدة</h3>

    <form action="{{ route('cities.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <label class="form-label">اسم المدينة</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
        <a href="{{ route('cities.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
@endsection