@extends('layouts.user')

@section('title', 'استكشف أفخم الفنادق')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border-radius: 20px;
        color: white;
        padding: 40px 20px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(30, 60, 114, 0.2);
    }
    .hotel-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
    }
    .hotel-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.12) !important;
    }
    .hotel-img-wrapper {
        position: relative;
        height: 220px;
        overflow: hidden;
    }
    .hotel-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .hotel-card:hover .hotel-img-wrapper img {
        transform: scale(1.08);
    }
    .badge-rating {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        color: #2b2b2b;
        font-weight: bold;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
    }
    .btn-custom {
        border-radius: 10px;
        font-weight: 600;
        padding: 10px 20px;
    }
</style>
@endpush

@section('content')
<div class="container my-3">
    <!-- Hero & Search Section -->
    <div class="hero-section text-center position-relative overflow-hidden">
        <h1 class="fw-bold mb-3">اعثر على إقامتك المثالية 🏨</h1>
        <p class="lead opacity-75 mb-4">احجز أفضل الفنادق بأفضل الأسعار وأعلى جودة للخدمات</p>
        
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <form action="{{ url('/hotels') }}" method="GET" class="bg-white p-2 rounded-4 shadow-lg">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-8">
                            <div class="input-group input-group-lg border-0">
                                <span class="input-group-text bg-transparent border-0 text-muted">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
                                <input type="text" name="search" class="form-control border-0 fs-6 shadow-none" placeholder="ابحث باسم الفندق، المدينة، أو المنطقة..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100 btn-custom shadow-sm">
                                <i class="fa-solid fa-magnifying-glass me-2"></i> بحث الآن
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Section Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">الفنادق المتاحة</h3>
            <p class="text-muted small mb-0">اختر من بين مجموعة مميزة من الفنادق والمنتجعات</p>
        </div>
        <span class="badge bg-primary-subtle text-primary fs-6 px-3 py-2 rounded-pill">عروض حصرية</span>
    </div>

    @php
        // بيانات تجريبية احترافية في حال عدم وجود فنادق بالداتابيز لتجربة الديزاين
        $demoHotels = [
            [
                'name' => 'فندق الفورسيزونز القاهرة',
                'location' => 'القاهرة، جاردن سيتي',
                'price' => '3,500',
                'rating' => '4.9 ★',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80',
                'description' => 'إطلالة ساحرة على النيل مباشرة مع خدمات 5 نجوم وفاخرة وشاملة الإفطار.'
            ],
            [
                'name' => 'منتجع ريكسوس شرم الشيخ',
                'location' => 'شرم الشيخ، خليج نبق',
                'price' => '4,200',
                'rating' => '4.8 ★',
                'image' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=800&q=80',
                'description' => 'إقامة شاطئية فائقة الفخامة مع ألعاب مائية ومطاعم عالمية متنوعة.'
            ],
            [
                'name' => 'فندق شتيجنبرجر الجونة',
                'location' => 'الغردقة، الجونة',
                'price' => '2,800',
                'rating' => '4.7 ★',
                'image' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=800&q=80',
                'description' => 'هدوء تام، إطلالة على البحيرات الصناعية وملعب جولف متكامل.'
            ],
            [
                'name' => 'فندق هلنان فلسطين',
                'location' => 'الأسكندرية، المنتزه',
                'price' => '2,100',
                'rating' => '4.6 ★',
                'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=800&q=80',
                'description' => 'إقامة مميزة داخل حدائق المنتزه مع شاطئ خاص وتراس بانورامي.'
            ],
            [
                'name' => 'منتجع موفنبيك أسوان',
                'location' => 'أسوان، جزيرة الفنتين',
                'price' => '1,950',
                'rating' => '4.8 ★',
                'image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=800&q=80',
                'description' => 'استمتع بسحر النيل والطبيعة الخلابة وسط صعيد مصر العريق.'
            ],
            [
                'name' => 'فندق وأجنحة الماسة',
                'location' => 'العاصمة الإدارية الجديدة',
                'price' => '3,100',
                'rating' => '4.9 ★',
                'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=800&q=80',
                'description' => 'تصميم عصري راقٍ وخدمات رجال الأعمال والمؤتمرات على أعلى مستوى.'
            ]
        ];

        $displayHotels = (isset($hotels) && count($hotels) > 0) ? $hotels : $demoHotels;
    @endphp

    <!-- Hotels Grid -->
    <div class="row g-4">
        @foreach($displayHotels as $hotel)
            @php
                $name = is_array($hotel) ? $hotel['name'] : $hotel->name;
                $location = is_array($hotel) ? $hotel['location'] : $hotel->location;
                $price = is_array($hotel) ? $hotel['price'] : ($hotel->price_per_night ?? '1500');
                $rating = is_array($hotel) ? $hotel['rating'] : '4.8 ★';
                $image = is_array($hotel) ? $hotel['image'] : ($hotel->image_url ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80');
                $description = is_array($hotel) ? $hotel['description'] : ($hotel->description ?? 'استمتع بإقامة مميزة مع أرقى الخدمات المتاحة للنزلاء.');
            @endphp
            
            <div class="col-md-6 col-lg-4">
                <div class="card hotel-card shadow-sm h-100">
                    <div class="hotel-img-wrapper">
                        <img src="{{ $image }}" alt="{{ $name }}">
                        <span class="badge-rating"><i class="fa-solid fa-star text-warning me-1"></i> {{ $rating }}</span>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="fw-bold text-dark mb-1">{{ $name }}</h5>
                        <p class="text-muted small mb-3">
                            <i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $location }}
                        </p>
                        <p class="text-secondary small flex-grow-1 lh-base">
                            {{ Str::limit($description, 95) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center pt-3 mt-3 border-top">
                            <div>
                                <span class="text-muted small d-block">السعر يبدأ من</span>
                                <span class="fw-bold text-primary fs-5">{{ $price }} <small class="fs-6 font-monospace">ج.م</small> / ليلة</span>
                            </div>
                            <button onclick="confirmBooking('{{ $name }}')" class="btn btn-outline-primary btn-custom shadow-none">
                                حجز الآن
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmBooking(hotelName) {
        Swal.fire({
            title: 'تأكيد طلب الحجز',
            html: `هل ترغب في البدء في إجراءات حجز <b>${hotelName}</b>؟`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e3c72',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fa-solid fa-check me-1"></i> نعم، تابع',
            cancelButtonText: 'إلغاء',
            customClass: {
                popup: 'rounded-4'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'رائع!',
                    text: 'جاري تحويلك لصفحة إدخال البيانات والتأكيد...',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
@endpush