@extends('layouts.user')

@section('title', 'تفاصيل الفندق')

@section('content')
<div class="container my-5">
    <!-- Hotel Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">فندق النيل الفاخر</h2>
            <p class="text-muted mb-0"><i class="fa-solid fa-location-dot text-danger me-1"></i> القاهرة، كورنيش النيل، وسط البلد</p>
        </div>
        <div class="mt-3 mt-md-0 text-md-end">
            <span class="fs-3 fw-bold text-primary">120$</span> <span class="text-muted">/ ليلة</span>
            <div class="text-warning"><i class="fa-solid fa-star"></i> 4.9 (128 تقييم)</div>
        </div>
    </div>

    <!-- Image Gallery -->
    <div class="row g-3 mb-5">
        <div class="col-md-8">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80" class="img-fluid rounded-4 w-100 shadow-sm" style="height: 410px; object-fit: cover;" alt="Main Image">
        </div>
        <div class="col-md-4 d-flex flex-column gap-3">
            <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=500&q=80" class="img-fluid rounded-4 h-50 w-100 shadow-sm" style="object-fit: cover;" alt="Sub Image 1">
            <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=500&q=80" class="img-fluid rounded-4 h-50 w-100 shadow-sm" style="object-fit: cover;" alt="Sub Image 2">
        </div>
    </div>

    <div class="row g-4">
        <!-- Details & Rooms -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h4 class="fw-bold mb-3">عن الفندق</h4>
                <p class="text-muted leading-relaxed">
                    يقع فندق النيل الفاخر في قلب مدينة القاهرة، ويوفر إطلالات ساحرة ومباشرة على نهر النيل. يتميز الفندق بغرف مدروسة بعناية لتوفر أعلى مستويات الراحة، بالإضافة إلى مطاعم عالمية وحمام سباحة مكشوف.
                </p>

                <h5 class="fw-bold mt-4 mb-3">الخدمات والمرافق</h5>
                <div class="row g-3 text-secondary">
                    <div class="col-6 col-md-4"><i class="fa-solid fa-wifi text-primary me-2"></i> إنترنت سريع مجاني</div>
                    <div class="col-6 col-md-4"><i class="fa-solid fa-water-ladder text-primary me-2"></i> حمام سباحة</div>
                    <div class="col-6 col-md-4"><i class="fa-solid fa-square-parking text-primary me-2"></i> موقف سيارات</div>
                    <div class="col-6 col-md-4"><i class="fa-solid fa-utensils text-primary me-2"></i> مطعم فاخر</div>
                    <div class="col-6 col-md-4"><i class="fa-solid fa-dumbbell text-primary me-2"></i> صالة ألعاب رياضية</div>
                    <div class="col-6 col-md-4"><i class="fa-solid fa-ban-smoking text-primary me-2"></i> غرف لغير التدخين</div>
                </div>
            </div>
        </div>

        <!-- Booking Box -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 20px;">
                <h5 class="fw-bold mb-3">حجز الغرفة</h5>
                <form id="detailsBookingForm">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">تاريخ الوصول</label>
                        <input type="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">تاريخ المغادرة</label>
                        <input type="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">نوع الغرفة</label>
                        <select class="form-select">
                            <option>غرفة ديلوكس مطلة على النيل (120$)</option>
                            <option>جناح ملكي (250$)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 fw-bold mt-2">
                        تأكيد الحجز الان
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('detailsBookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'تم استلام طلب الحجز!',
            text: 'شكراً لك، تم إرسال تفاصيل حجزك بنجاح وسيتواصل معك فريق الاستقبال.',
            icon: 'success',
            confirmButtonColor: '#0d6efd',
            confirmButtonText: 'موافق'
        });
    });
</script>
@endpush