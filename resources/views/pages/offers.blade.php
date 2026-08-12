@extends('layouts.user')

@section('title', 'العروض والخصومات')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <i class="fa-solid fa-tags fs-1 mb-3" style="color: var(--primary-rose);"></i>
        <h2 class="fw-bold">العروض والخصومات</h2>
        <p class="text-muted">أفضل العروض الحصرية على أفخم الفنادق والمنتجعات</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
                <i class="fa-solid fa-percent fs-2 mb-3" style="color: var(--primary-rose);"></i>
                <h5 class="fw-bold">خصم 20% على الحجز المبكر</h5>
                <p class="text-muted small">احجز قبل 30 يوم من موعد إقامتك واحصل على خصم فوري.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
                <i class="fa-solid fa-calendar-week fs-2 mb-3" style="color: var(--primary-rose);"></i>
                <h5 class="fw-bold">عروض نهاية الأسبوع</h5>
                <p class="text-muted small">استمتع بإقامة مميزة بأسعار خاصة كل نهاية أسبوع.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
                <i class="fa-solid fa-users fs-2 mb-3" style="color: var(--primary-rose);"></i>
                <h5 class="fw-bold">عروض العائلات</h5>
                <p class="text-muted small">باقات مخصصة للعائلات مع إقامة مجانية للأطفال.</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('hotels.index') }}"
            class="btn btn-rose rounded-3 px-5 py-3 fw-bold"
            style="font-size: 1.05rem; box-shadow: 0 4px 15px rgba(200, 138, 117, 0.35); border: 2px solid var(--primary-rose); transition: all 0.3s ease;"
            onmouseover="this.style.boxShadow='0 8px 25px rgba(200, 138, 117, 0.55)'; this.style.transform='translateY(-3px) scale(1.03)';"
            onmouseout="this.style.boxShadow='0 4px 15px rgba(200, 138, 117, 0.35)'; this.style.transform='translateY(0) scale(1)';">
                <i class="fa-solid fa-arrow-left me-2"></i>
                تصفح الفنادق الآن
        </a>
    </div>
</div>
@endsection