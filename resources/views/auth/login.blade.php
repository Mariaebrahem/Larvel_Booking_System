@extends('layouts.user')

@section('title', 'تسجيل الدخول')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold text-center mb-4">تسجيل الدخول</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">كلمة المرور</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                        <button type="submit"
                                class="btn btn-rose w-100 py-3 fw-bold rounded-3 mt-2"
                                style="font-size: 1.05rem; box-shadow: 0 4px 15px rgba(200, 138, 117, 0.35); border: 2px solid var(--primary-rose); transition: all 0.3s ease;"
                                onmouseover="this.style.boxShadow='0 8px 25px rgba(200, 138, 117, 0.55)'; this.style.transform='translateY(-3px) scale(1.02)';"
                                onmouseout="this.style.boxShadow='0 4px 15px rgba(200, 138, 117, 0.35)'; this.style.transform='translateY(0) scale(1)';">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>
                            دخول
                        </button>
                </form>

                <div class="text-center mt-3">
                    <span class="text-muted small">مفيش عندك حساب؟</span>
                    <a href="{{ route('register.show') }}" class="small fw-bold" style="color: var(--primary-rose);">إنشاء حساب جديد</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection