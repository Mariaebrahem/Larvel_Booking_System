@props(['status' => 'Pending'])

@php
    $statusLower = strtolower(trim($status));
    $badgeClass = 'badge-pending';
    $icon = 'clock';

    switch($statusLower) {
        case 'confirmed':
            $badgeClass = 'badge-confirmed';
            $icon = 'check-circle-2';
            break;
        case 'checked in':
        case 'checked-in':
            $badgeClass = 'badge-checked-in';
            $icon = 'door-open';
            break;
        case 'checked out':
        case 'checked-out':
            $badgeClass = 'badge-checked-out';
            $icon = 'log-out';
            break;
        case 'rejected':
            $badgeClass = 'badge-rejected';
            $icon = 'x-circle';
            break;
        case 'cancelled':
        case 'canceled':
            $badgeClass = 'badge-cancelled';
            $icon = 'slash';
            break;
        case 'available':
        case 'active':
            $badgeClass = 'badge-available';
            $icon = 'check';
            break;
        case 'occupied':
            $badgeClass = 'badge-occupied';
            $icon = 'user-check';
            break;
        case 'maintenance':
        case 'inactive':
            $badgeClass = 'badge-maintenance';
            $icon = 'wrench';
            break;
    }
@endphp

<span class="badge-pill-custom {{ $badgeClass }}" data-status="{{ $statusLower }}">
    <i data-lucide="{{ $icon }}" style="width: 13px; height: 13px;"></i> {{ ucfirst($status) }}
</span>
