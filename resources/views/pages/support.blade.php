@extends('layouts.user')

@section('title', 'الدعم الفني')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-5">
                <i class="fa-solid fa-headset fs-1 mb-3" style="color: var(--primary-rose);"></i>
                <h2 class="fw-bold">الدعم الفني</h2>
                <p class="text-muted">نحن هنا لمساعدتك في أي وقت</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3">تواصل معنا</h5>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <i class="fa-solid fa-envelope" style="color: var(--primary-rose);"></i>
                    <span>support@fanadqy.com</span>
                </div>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <i class="fa-solid fa-phone" style="color: var(--primary-rose);"></i>
                    <span>19000</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <i class="fa-solid fa-clock" style="color: var(--primary-rose);"></i>
                    <span>متاح على مدار الساعة، طوال أيام الأسبوع</span>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">الأسئلة الشائعة</h5>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                إزاي ألغي حجزي؟
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small">
                                تقدر تلغي حجزك من صفحة "حجوزاتي" بالضغط على زرار الإلغاء بجانب الحجز.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                إمتى بيتأكد حجزي؟
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small">
                                بعد ما تحجز، الحجز بيبقى "قيد المراجعة" لحد ما فريقنا يأكده خلال 24 ساعة.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection