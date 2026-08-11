@extends('layouts.user')

@section('title', 'استكشف أفضل الفنادق')

@push('styles')
<style>
    .hotel-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }
    .hotel-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.12) !important;
    }
    .hotel-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 220px;
    }
    .hotel-img-wrapper img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        transition: transform 0.5s ease;
    }
    .hotel-card:hover .hotel-img-wrapper img {
        transform: scale(1.08);
    }
    .badge-price {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(13, 110, 253, 0.9);
        backdrop-filter: blur(4px);
    }
    .hero-search {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border-radius: 20px;
    }
</style>
@endpush

@section('content')
<div class="container my-4">
    <!-- Hero & Search Section -->
    <div class="hero-search text-white p-4 p-md-5 mb-5 shadow">
        <div class="row align-items-center mb-4">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-2">ابحث عن إقامتك القادمة</h2>
                <p class="text-white-50 mb-0">اعثر على أفضل الفنادق والمنتجعات بأفضل الأسعار المتاحة</p>
            </div>
        </div>

        <!-- Search Form -->
        <form action="{{ url('/hotels') }}" method="GET" class="bg-white p-3 p-md-4 rounded-4 shadow-sm text-dark">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold small text-muted"><i class="fa-solid fa-location-dot me-1 text-primary"></i> المدينة / الفندق</label>
                    <input type="text" name="query" class="form-control bg-light" placeholder="القاهرة، شرم الشيخ..." value="{{ request('query') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted"><i class="fa-solid fa-calendar-days me-1 text-primary"></i> تاريخ الوصول</label>
                    <input type="date" name="check_in" class="form-control bg-light" value="{{ request('check_in') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted"><i class="fa-solid fa-users me-1 text-primary"></i> النزلاء</label>
                    <select name="guests" class="form-select bg-light">
                        <option value="1">شخص واحد</option>
                        <option value="2" selected>شخصين</option>
                        <option value="4">عائلة (4 أشخاص)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> بحث
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Hotels Grid -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-hotel text-primary me-2"></i>الفنادق المتاحة</h4>
        <span class="text-muted small">عرض 1 - 3 من أصل 12 فندق</span>
    </div>

    <div class="row g-4 mb-5">
        <!-- Hotel 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="card hotel-card h-100 shadow-sm rounded-4 overflow-hidden">
                <div class="hotel-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=600&q=80" alt="فندق النيل الفاخر">
                    <span class="badge badge-price text-white px-3 py-2 rounded-pill fw-bold">120$ / ليلة</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold text-dark mb-0">فندق النيل الفاخر</h5>
                            <div class="text-warning small"><i class="fa-solid fa-star"></i> 4.9</div>
                        </div>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> القاهرة، وسط البلد</p>
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge bg-light text-secondary rounded-pill px-2 py-1"><i class="fa-solid fa-wifi"></i> واي فاي</span>
                            <span class="badge bg-light text-secondary rounded-pill px-2 py-1"><i class="fa-solid fa-water-ladder"></i> حمام سباحة</span>
                        </div>
                    </div>
                    <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ url('/hotels/1') }}" class="btn btn-outline-primary rounded-3 w-100 me-2 fw-bold">عرض التفاصيل</a>
                        <button onclick="bookNow('فندق النيل الفاخر')" class="btn btn-primary rounded-3 text-nowrap fw-bold px-3">حجز سريع</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotel 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="card hotel-card h-100 shadow-sm rounded-4 overflow-hidden">
                <div class="hotel-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=600&q=80" alt="منتجع البحر الأحمر">
                    <span class="badge badge-price text-white px-3 py-2 rounded-pill fw-bold">200$ / ليلة</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold text-dark mb-0">منتجع البحر الأحمر</h5>
                            <div class="text-warning small"><i class="fa-solid fa-star"></i> 4.8</div>
                        </div>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> شرم الشيخ، خليج نعمة</p>
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge bg-light text-secondary rounded-pill px-2 py-1"><i class="fa-solid fa-umbrella-beach"></i> شاطئ خاص</span>
                            <span class="badge bg-light text-secondary rounded-pill px-2 py-1"><i class="fa-solid fa-utensils"></i> أفطار مجاني</span>
                        </div>
                    </div>
                    <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ url('/hotels/2') }}" class="btn btn-outline-primary rounded-3 w-100 me-2 fw-bold">عرض التفاصيل</a>
                        <button onclick="bookNow('منتجع البحر الأحمر')" class="btn btn-primary rounded-3 text-nowrap fw-bold px-3">حجز سريع</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotel 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="card hotel-card h-100 shadow-sm rounded-4 overflow-hidden">
                <div class="hotel-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=600&q=80" alt="فندق جراند أسوان">
                    <span class="badge badge-price text-white px-3 py-2 rounded-pill fw-bold">90$ / ليلة</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold text-dark mb-0">فندق جراند أسوان</h5>
                            <div class="text-warning small"><i class="fa-solid fa-star"></i> 4.6</div>
                        </div>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> أسوان، كورنيش النيل</p>
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge bg-light text-secondary rounded-pill px-2 py-1"><i class="fa-solid fa-square-parking"></i> جراج مجاني</span>
                            <span class="badge bg-light text-secondary rounded-pill px-2 py-1"><i class="fa-solid fa-spa"></i> سبا</span>
                        </div>
                    </div>
                    <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ url('/hotels/3') }}" class="btn btn-outline-primary rounded-3 w-100 me-2 fw-bold">عرض التفاصيل</a>
                        <button onclick="bookNow('فندق جراند أسوان')" class="btn btn-primary rounded-3 text-nowrap fw-bold px-3">حجز سريع</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Functional Pagination UI -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled"><a class="page-link rounded-circle mx-1" href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
            <li class="page-item active"><a class="page-link rounded-circle mx-1" href="#">1</a></li>
            <li class="page-item"><a class="page-link rounded-circle mx-1" href="#">2</a></li>
            <li class="page-item"><a class="page-link rounded-circle mx-1" href="#">3</a></li>
            <li class="page-item"><a class="page-link rounded-circle mx-1" href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
        </ul>
    </nav>
</div>
@endsection

@push('scripts')
<script>
    function bookNow(hotelName) {
        Swal.fire({
            title: 'تأكيد الحجز المبدئي',
            text: 'هل ترغب في تأكيد طلب الحجز لـ ' + hotelName + '؟',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'نعم، حجز الآن',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'تم إرسال طلب الحجز!',
                    text: 'سيتم التواصل معك لتأكيد تفاصيل الحجز.',
                    icon: 'success',
                    confirmButtonColor: '#0d6efd'
                });
            }
        });
    }
</script>
@endpush