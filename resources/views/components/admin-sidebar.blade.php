<aside class="admin-sidebar">
    <!-- Sidebar Brand -->
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand text-decoration-none d-flex align-items-center gap-2">
        <div class="brand-icon">
            <i data-lucide="building-2" style="width: 18px; height: 18px;"></i>
        </div>
        <span>GrandStay</span>
    </a>

    <!-- Navigation -->
    <div class="sidebar-menu">
        <div class="sidebar-heading">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link-custom {{ request()->is('admin/dashboard') || request()->is('admin') ? 'active' : '' }}">
            <i data-lucide="layout-dashboard"></i>
            <span>Dashboard</span>
        </a>

        <div class="sidebar-heading mt-2">Management</div>
        <a href="{{ route('admin.cities.index') }}" class="nav-link-custom {{ request()->is('admin/cities*') ? 'active' : '' }}">
            <i data-lucide="map-pin"></i>
            <span>Cities</span>
        </a>
        <a href="{{ route('admin.hotels.index') }}" class="nav-link-custom {{ request()->is('admin/hotels*') ? 'active' : '' }}">
            <i data-lucide="building-2"></i>
            <span>Hotels</span>
        </a>
        <a href="{{ route('admin.rooms.index') }}" class="nav-link-custom {{ request()->is('admin/rooms*') ? 'active' : '' }}">
            <i data-lucide="bed-double"></i>
            <span>Rooms</span>
        </a>
        <a href="{{ route('admin.room-types.index') }}" class="nav-link-custom {{ request()->is('admin/room-types*') ? 'active' : '' }}">
            <i data-lucide="layers-3"></i>
            <span>Room Types</span>
        </a>
        <a href="{{ route('admin.amenities.index') }}" class="nav-link-custom {{ request()->is('admin/amenities*') ? 'active' : '' }}">
            <i data-lucide="sparkles"></i>
            <span>Amenities</span>
        </a>

        <div class="sidebar-heading mt-2">Operations</div>
        <a href="{{ route('admin.bookings.index') }}" class="nav-link-custom {{ request()->is('admin/bookings*') ? 'active' : '' }}">
            <i data-lucide="calendar-check"></i>
            <span>Bookings</span>
            {{-- BACKEND TODO: Display dynamic unread booking count badge --}}
        </a>
        <a href="{{ route('admin.reports.index') }}" class="nav-link-custom {{ request()->is('admin/reports*') ? 'active' : '' }}">
            <i data-lucide="chart-no-axes-combined"></i>
            <span>Reports & Analytics</span>
        </a>
    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        {{-- BACKEND TODO: Bind authenticated admin profile data here --}}
        <div class="admin-profile-card">
            <div class="btn-circle btn-circle-slate" style="width: 38px; height: 38px;">
                <i data-lucide="user" style="width: 18px; height: 18px;"></i>
            </div>
            <div class="admin-info overflow-hidden">
                <p class="admin-name text-truncate">
                    {{-- BACKEND TODO: Admin Name --}}
                    Admin
                </p>
                <p class="admin-role">
                    {{-- BACKEND TODO: Admin Role --}}
                    Administrator
                </p>
            </div>
            <button class="btn btn-link text-secondary p-0 ms-auto text-decoration-none" title="Logout" onclick="showToast('Logout', 'Logged out', 'info')">
                <i data-lucide="log-out" style="width: 18px; height: 18px;"></i>
            </button>
        </div>
    </div>
</aside>
