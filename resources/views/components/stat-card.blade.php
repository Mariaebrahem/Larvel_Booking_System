@props([
    'title' => 'Stat Title',
    'value' => '0',
    'icon' => 'bar-chart-3',
    'trend' => null,
    'trendUp' => true
])

<div class="stat-card-box">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <span class="stat-label-text">{{ $title }}</span>
        <div class="btn-circle btn-circle-blue" style="width: 32px; height: 32px; font-size: 0.8rem;">
            <i data-lucide="{{ $icon }}" style="width: 16px; height: 16px;"></i>
        </div>
    </div>
    <div class="stat-value-text">{{ $value }}</div>
    @if($trend)
        <div class="stat-trend-badge {{ $trendUp ? 'trend-up' : 'trend-down' }}">
            <i data-lucide="{{ $trendUp ? 'trending-up' : 'trending-down' }}" style="width: 14px; height: 14px;"></i>
            <span>{{ $trend }}</span>
            <span class="text-muted fw-normal ms-1" style="font-size: 0.725rem;">vs last month</span>
        </div>
    @endif
</div>
