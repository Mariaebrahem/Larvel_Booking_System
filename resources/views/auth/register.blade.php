@extends('layouts.user')

@section('title', 'إنشاء حساب جديد')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">
                    
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa-solid fa-user-plus fs-3"></i>
                        </div>
                        <h4 class="fw-bold">إنشاء حساب جديد</h4>
                        <p class="text-muted small">سجّل الآن للاستمتاع بأفضل العروض وحجوزات الفنادق</p>
                    </div>

                    <!-- Register Form -->
                    <form action="{{ url('/register') }}" method="POST" id="registerForm">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label fw-bold small">الاسم بالكامل</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="name" class="form-control bg-light border-start-0" placeholder="أدخل اسمك بالكامل" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-bold small">البريد الإلكتروني</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-start-0" placeholder="example@domain.com" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label fw-bold small">كلمة المرور</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Password Confirmation -->
                        <div class="mb-4">
                            <label class="form-label fw-bold small">تأكيد كلمة المرور</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-shield-halved"></i></span>
                                <input type="password" name="password_confirmation" class="form-control bg-light border-start-0" placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 fw-bold mb-3">
                            <i class="fa-solid fa-check-circle me-1"></i> إنشاء الحساب
                        </button>

                        <!-- Login link -->
                        <div class="text-center">
                            <span class="text-muted small">لديك حساب بالفعل؟</span>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">تسجيل الدخول</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'تم إنشاء الحساب بنجاح!',
            text: 'مرحباً بك في نظام حجز الفنادق.',
            icon: 'success',
            confirmButtonColor: '#0d6efd',
            confirmButtonText: 'الذهاب للفنادق'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url('/hotels') }}";
            }
        });
    });
</script>
@endpush