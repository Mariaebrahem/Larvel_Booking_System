@extends('layouts.user')

@section('title', 'إنشاء حساب جديد')

@section('content')
<div class="container my-5 py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-gradient bg-primary text-white text-center py-4 border-0">
                    <div class="bg-white text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2 shadow-sm" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-user-plus fs-3"></i>
                    </div>
                    <h4 class="fw-bold mb-1">إنشاء حساب جديد</h4>
                    <p class="text-white-50 mb-0 small">انضم إلينا واستمتع بأفضل عروض الفنادق</p>
                </div>
                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="{{ url('/register') }}" method="POST" id="registerForm">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary small">الاسم بالكامل</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="name" class="form-control bg-light border-start-0 py-2" placeholder="أحمد محمد" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary small">البريد الإلكتروني</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-start-0 py-2" placeholder="example@domain.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary small">كلمة المرور</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-start-0 py-2" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small">تأكيد كلمة المرور</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-shield-halved"></i></span>
                                <input type="password" name="password_confirmation" class="form-control bg-light border-start-0 py-2" placeholder="••••••••" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 fw-bold mb-3 shadow-sm">
                            <i class="fa-solid fa-user-check me-2"></i> إنشاء الحساب
                        </button>

                        <div class="text-center pt-2">
                            <span class="text-muted small">لديك حساب بالفعل؟</span>
                            <a href="{{ url('/login') }}" class="text-primary fw-bold text-decoration-none small ms-1">تسجيل الدخول</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection