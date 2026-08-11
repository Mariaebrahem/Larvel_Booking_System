@extends('layouts.user')

@section('title', 'استكشف أفخم الفنادق والمنتجعات')

@push('styles')
<style>
    /* Nude & Rose Gold Palette Variables */
    :root {
        --bg-main: #FDF8F5;
        --card-bg: #FFFFFF;
        --text-color: #4A3E3D;
        --text-muted: #8C7A7B;
        --primary-rose: #C88A75;
        --primary-rose-hover: #B07460;
        --accent-brown: #6F4E37;
        --border-color: #F1E4DE;
        --shadow-color: rgba(141, 91, 76, 0.08);
    }

    /* Dark Mode Palette */
    [data-theme="dark"] {
        --bg-main: #1C1817;
        --card-bg: #272221;
        --text-color: #F3ECE8;
        --text-muted: #BDB0AA;
        --primary-rose: #D8A798;
        --primary-rose-hover: #E3B8AA;
        --accent-brown: #E8C3B9;
        --border-color: #38302E;
        --shadow-color: rgba(0, 0, 0, 0.4);
    }

    body {
        background-color: var(--bg-main);
        color: var(--text-color);
        transition: background-color 0.4s ease, color 0.4s ease;
    }

    /* Theme Toggle Button */
    .theme-toggle-btn {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        color: var(--text-color);
        border-radius: 50px;
        padding: 8px 18px;
        font-weight: bold;
        box-shadow: 0 4px 12px var(--shadow-color);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    /* Hero Search Bar */
    .hero-rose {
        background: linear-gradient(135deg, var(--accent-brown) 0%, var(--primary-rose) 100%);
        border-radius: 24px;
        box-shadow: 0 15px 35px var(--shadow-color);
    }

    .search-card {
        background-color: var(--card-bg) !important;
        border: 1px solid var(--border-color);
    }

    /* Hotel Cards & Hover Animation */
    .hotel-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s ease, border-color 0.4s ease;
    }

    .hotel-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 18px 30px var(--shadow-color) !important;
        border-color: var(--primary-rose);
    }

    .hotel-img-wrapper {
        position: relative;
        height: 230px;
        overflow: hidden;
        border-radius: 20px 20px 0 0;
    }

    .hotel-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .hotel-card:hover .hotel-img-wrapper img {
        transform: scale(1.1);
    }

    .badge-price {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(111, 78, 55, 0.85);
        backdrop-filter: blur(8px);
        color: #FFF;
    }

    /* Buttons Style */
    .btn-rose {
        background-color: var(--primary-rose);
        color: #FFF !important;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-rose:hover {
        background-color: var(--primary-rose-hover);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(200, 138, 117, 0.4);
    }

    .btn-outline-rose {
        border: 1px solid var(--primary-rose);
        color: var(--primary-rose) !important;
        background: transparent;
        transition: all 0.3s ease;
    }

    .btn-outline-rose:hover {
        background-color: var(--primary-rose);
        color: #FFF !important;
    }

    .badge-tag {
        background-color: var(--bg-main);
        color: var(--text-muted);
        border: 1px solid var(--border-color);
    }

    /* Pagination */
    .custom-pagination .page-link {
        background-color: var(--card-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .custom-pagination .page-item.active .page-link {
        background-color: var(--primary-rose);
        border-color: var(--primary-rose);
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="container my-4">

    <!-- Header Actions (Dark/Light Switcher) -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">الملاذ المثالي لراحتك</h3>
            <p class="text-muted small mb-0">اختر من بين تشكيلة فاخرة من الفنادق المصممة خصيصاً لأجلك</p>
        </div>
        <button id="themeToggleBtn" class="theme-toggle-btn d-flex align-items-center gap-2">
            <i class="fa-solid fa-moon text-warning" id="themeIcon"></i>
            <span id="themeText">المظهر الداكن</span>
        </button>
    </div>

    <!-- Hero Search Bar -->
    <div class="hero-rose text-white p-4 p-md-5 mb-5">
        <h2 class="fw-bold mb-2">ابحث عن وجهتك القادمة</h2>
        <p class="text-white-50 mb-4 small">استمتع بتجربة إقامة تجمع بين الفخامة والراحة</p>

        <form action="{{ url('/hotels') }}" method="GET" class="search-card p-3 p-md-4 rounded-4 shadow-sm">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold small text-muted"><i class="fa-solid fa-location-dot me-1" style="color: var(--primary-rose);"></i> المدينة / اسم الفندق</label>
                    <input type="text" name="query" class="form-control border-0 bg-body-tertiary py-2" placeholder="القاهرة، شرم الشيخ، أسوان...">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted"><i class="fa-solid fa-calendar-days me-1" style="color: var(--primary-rose);"></i> تاريخ الوصول</label>
                    <input type="date" name="check_in" class="form-control border-0 bg-body-tertiary py-2">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted"><i class="fa-solid fa-user-group me-1" style="color: var(--primary-rose);"></i> عدد الضيوف</label>
                    <select name="guests" class="form-select border-0 bg-body-tertiary py-2">
                        <option value="1">شخص واحد</option>
                        <option value="2" selected>شخصين (غرفة مزدوجة)</option>
                        <option value="4">عائلة (4 أشخاص)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-rose w-100 py-2 rounded-3 fw-bold">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> بحث
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Hotels Grid (6 الفنادق) -->
    <div class="row g-4 mb-5">
        
        <!-- Hotel 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="card hotel-card h-100">
                <div class="hotel-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=700&q=80" alt="قصر النيل">
                    <span class="badge badge-price px-3 py-2 rounded-pill fw-bold">180$ / ليلة</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0">قصر النيل بوتيك</h5>
                            <div class="text-warning small"><i class="fa-solid fa-star"></i> 4.9</div>
                        </div>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> القاهرة، الزمالك</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-wifi"></i> واي فاي</span>
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-hot-tub-person"></i> سبا وفاخر</span>
                        </div>
                    </div>
                    <div class="pt-3 border-top border-secondary-subtle d-flex justify-content-between align-items-center">
                        <a href="{{ url('/hotels/1') }}" class="btn btn-outline-rose rounded-3 w-100 me-2 fw-bold">عرض التفاصيل</a>
                        <button onclick="bookNow('قصر النيل بوتيك')" class="btn btn-rose rounded-3 text-nowrap fw-bold px-3">حجز سريع</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotel 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="card hotel-card h-100">
                <div class="hotel-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=700&q=80" alt="منتجع الرملة البيضاء">
                    <span class="badge badge-price px-3 py-2 rounded-pill fw-bold">250$ / ليلة</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0">منتجع الروز والرمال</h5>
                            <div class="text-warning small"><i class="fa-solid fa-star"></i> 4.8</div>
                        </div>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> شرم الشيخ، رأس جميلة</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-water-ladder"></i> مسبح خاص</span>
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-umbrella-beach"></i> شاطئ</span>
                        </div>
                    </div>
                    <div class="pt-3 border-top border-secondary-subtle d-flex justify-content-between align-items-center">
                        <a href="{{ url('/hotels/2') }}" class="btn btn-outline-rose rounded-3 w-100 me-2 fw-bold">عرض التفاصيل</a>
                        <button onclick="bookNow('منتجع الروز والرمال')" class="btn btn-rose rounded-3 text-nowrap fw-bold px-3">حجز سريع</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotel 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="card hotel-card h-100">
                <div class="hotel-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=700&q=80" alt="جراند أسوان">
                    <span class="badge badge-price px-3 py-2 rounded-pill fw-bold">130$ / ليلة</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0">فندق رويال أسوان</h5>
                            <div class="text-warning small"><i class="fa-solid fa-star"></i> 4.7</div>
                        </div>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> أسوان، الجزر النوبية</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-utensils"></i> إفطار مجاني</span>
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-mountain-sun"></i> إطلالة</span>
                        </div>
                    </div>
                    <div class="pt-3 border-top border-secondary-subtle d-flex justify-content-between align-items-center">
                        <a href="{{ url('/hotels/3') }}" class="btn btn-outline-rose rounded-3 w-100 me-2 fw-bold">عرض التفاصيل</a>
                        <button onclick="bookNow('فندق رويال أسوان')" class="btn btn-rose rounded-3 text-nowrap fw-bold px-3">حجز سريع</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotel 4 -->
        <div class="col-md-6 col-lg-4">
            <div class="card hotel-card h-100">
                <div class="hotel-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=700&q=80" alt="الجونة فيلا">
                    <span class="badge badge-price px-3 py-2 rounded-pill fw-bold">310$ / ليلة</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0">أجنحة الجونة الفاخرة</h5>
                            <div class="text-warning small"><i class="fa-solid fa-star"></i> 5.0</div>
                        </div>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> الغردقة، الجونة</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-ship"></i> مرسى يخوت</span>
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-dumbbell"></i> جيم</span>
                        </div>
                    </div>
                    <div class="pt-3 border-top border-secondary-subtle d-flex justify-content-between align-items-center">
                        <a href="{{ url('/hotels/4') }}" class="btn btn-outline-rose rounded-3 w-100 me-2 fw-bold">عرض التفاصيل</a>
                        <button onclick="bookNow('أجنحة الجونة الفاخرة')" class="btn btn-rose rounded-3 text-nowrap fw-bold px-3">حجز سريع</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotel 5 -->
        <div class="col-md-6 col-lg-4">
            <div class="card hotel-card h-100">
                <div class="hotel-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=700&q=80" alt="دهب إيكو لودج">
                    <span class="badge badge-price px-3 py-2 rounded-pill fw-bold">95$ / ليلة</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0">منتجع دهب الهادئ</h5>
                            <div class="text-warning small"><i class="fa-solid fa-star"></i> 4.6</div>
                        </div>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> جنوب سيناء، دهب</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-person-swimming"></i> غوص</span>
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-spa"></i> يوغا</span>
                        </div>
                    </div>
                    <div class="pt-3 border-top border-secondary-subtle d-flex justify-content-between align-items-center">
                        <a href="{{ url('/hotels/5') }}" class="btn btn-outline-rose rounded-3 w-100 me-2 fw-bold">عرض التفاصيل</a>
                        <button onclick="bookNow('منتجع دهب الهادئ')" class="btn btn-rose rounded-3 text-nowrap fw-bold px-3">حجز سريع</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotel 6 -->
        <div class="col-md-6 col-lg-4">
            <div class="card hotel-card h-100">
                <div class="hotel-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=700&q=80" alt="فندق الساحل الشمالي">
                    <span class="badge badge-price px-3 py-2 rounded-pill fw-bold">280$ / ليلة</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0">فندق مراسي بلازا</h5>
                            <div class="text-warning small"><i class="fa-solid fa-star"></i> 4.9</div>
                        </div>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-1 text-danger"></i> الساحل الشمالي، العلمين</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-glass-water"></i> بار</span>
                            <span class="badge badge-tag px-2 py-1"><i class="fa-solid fa-square-parking"></i> جراج VIP</span>
                        </div>
                    </div>
                    <div class="pt-3 border-top border-secondary-subtle d-flex justify-content-between align-items-center">
                        <a href="{{ url('/hotels/6') }}" class="btn btn-outline-rose rounded-3 w-100 me-2 fw-bold">عرض التفاصيل</a>
                        <button onclick="bookNow('فندق مراسي بلازا')" class="btn btn-rose rounded-3 text-nowrap fw-bold px-3">حجز سريع</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Pagination UI -->
    <nav aria-label="Page navigation">
        <ul class="pagination custom-pagination justify-content-center">
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
    // Dark / Light Mode Toggle Logic
    const toggleBtn = document.getElementById('themeToggleBtn');
    const themeIcon = document.getElementById('themeIcon');
    const themeText = document.getElementById('themeText');

    const currentTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', currentTheme);
    updateToggleUI(currentTheme);

    toggleBtn.addEventListener('click', () => {
        let theme = document.documentElement.getAttribute('data-theme');
        let newTheme = theme === 'dark' ? 'light' : 'dark';
        
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateToggleUI(newTheme);
    });

    function updateToggleUI(theme) {
        if (theme === 'dark') {
            themeIcon.className = 'fa-solid fa-sun text-warning';
            themeText.innerText = 'المظهر الفاتح';
        } else {
            themeIcon.className = 'fa-solid fa-moon text-dark';
            themeText.innerText = 'المظهر الداكن';
        }
    }

    // SweetAlert Booking Handler
    function bookNow(hotelName) {
        Swal.fire({
            title: 'تأكيد الحجز المبدئي',
            text: 'هل ترغب في تأكيد طلب الحجز لـ ' + hotelName + '؟',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#C88A75',
            cancelButtonColor: '#8C7A7B',
            confirmButtonText: 'نعم، حجز الآن',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'تم إرسال طلب الحجز بنجاح!',
                    text: 'سيتم التواصل معك قريباً لتأكيد تفاصيل الإقامة.',
                    icon: 'success',
                    confirmButtonColor: '#C88A75'
                });
            }
        });
    }
</script>
@endpush