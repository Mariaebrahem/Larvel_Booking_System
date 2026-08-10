@props(['title' => 'Dashboard'])

<header class="top-navbar">
    <div class="d-flex align-items-center gap-3">
        <!-- Sidebar Toggle for Mobile -->
        <button id="sidebarToggle" class="btn btn-secondary-light btn-circle" type="button" aria-label="Toggle Navigation">
            <i data-lucide="menu" style="width: 18px; height: 18px;"></i>
        </button>

        <!-- Page Title & Breadcrumb -->
        <div>
            <h1 class="page-title">{{ $title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom mb-0 text-muted">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Admin</a></li>
                    <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Right Side Actions & User Menu -->
    <div class="d-flex align-items-center gap-3">
        <!-- Search Input -->
        <div class="search-input-group d-none d-md-block">
            <i data-lucide="search" style="width: 16px; height: 16px;"></i>
            <input type="text" class="form-control" placeholder="Search system..." data-table-search="mainTable">
        </div>

        <!-- Notification Bell Dropdown -->
        <div class="dropdown">
            <button class="btn btn-secondary-light btn-circle position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i data-lucide="bell" style="width: 17px; height: 17px;"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-primary rounded-circle"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-0 overflow-hidden" style="width: 310px; border-radius: 14px;">
                <div class="p-3 bg-primary text-white d-flex align-items-center justify-content-between">
                    <span class="mb-0 fw-bold" style="font-size: 0.85rem;">Notifications</span>
                    <span class="badge bg-white text-primary fw-bold" style="font-size: 0.7rem;">
                        {{-- BACKEND TODO: Dynamic unread notification count --}}
                        0 Unread
                    </span>
                </div>
                <div class="list-group list-group-flush small">
                    {{-- BACKEND TODO: Loop over system notifications --}}
                    <div class="p-3 text-center text-muted small">
                        No new notifications.
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Profile Dropdown -->
        <div class="dropdown">
            <button class="btn btn-link p-0 border-0 d-flex align-items-center gap-2 text-decoration-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="btn-circle btn-circle-blue" style="width: 36px; height: 36px;">
                    <i data-lucide="user" style="width: 18px; height: 18px;"></i>
                </div>
                <div class="d-none d-xl-block text-start">
                    <span class="d-block fw-semibold text-dark lh-1" style="font-size: 0.85rem;">
                        {{-- BACKEND TODO: Admin Name --}}
                        Admin
                    </span>
                    <small class="text-muted" style="font-size: 0.725rem;">Administrator</small>
                </div>
                <i data-lucide="chevron-down" style="width: 14px; height: 14px;" class="text-muted ms-1"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" style="border-radius: 12px;">
                <li><a class="dropdown-item small" href="#">Profile</a></li>
                <li><a class="dropdown-item small" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item small text-danger" href="#" onclick="showToast('Logout', 'Logged out', 'warning')">Logout</a></li>
            </ul>
        </div>
    </div>
</header>
