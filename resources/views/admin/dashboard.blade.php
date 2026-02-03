@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    :root {
        --primary-green: #27ae60;
        --primary-green-dark: #1e8449;
    }

    .dashboard-container {
        padding: 30px 0;
    }

    .welcome-banner {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
        color: white;
        border-radius: 12px;
        padding: 40px;
        margin-bottom: 40px;
        box-shadow: 0 5px 20px rgba(39, 174, 96, 0.2);
    }

    .welcome-banner h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .welcome-banner p {
        font-size: 16px;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 20px;
        border-left: 5px solid var(--primary-green);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
        font-size: 32px;
        color: var(--primary-green);
        margin-bottom: 15px;
    }

    .stat-number {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary-green);
        margin-bottom: 5px;
    }

    .stat-label {
        color: #666;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }

    .card-section h2 {
        color: var(--primary-green);
        font-weight: 700;
        margin-bottom: 25px;
        font-size: 22px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #999;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        color: #ddd;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .menu-item {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
        color: white;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        text-decoration: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 10px rgba(39, 174, 96, 0.2);
    }

    .menu-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(39, 174, 96, 0.3);
        color: white;
        text-decoration: none;
        cursor: pointer;
    }

    .menu-item i {
        font-size: 40px;
        margin-bottom: 15px;
        display: block;
    }

    .menu-item-title {
        font-weight: 700;
        font-size: 16px;
    }

    .recent-item {
        border-bottom: 1px solid #e0e0e0;
        padding: 15px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .recent-item:last-child {
        border-bottom: none;
    }

    .recent-item-info h4 {
        margin-bottom: 5px;
        color: #333;
        font-size: 15px;
        font-weight: 600;
    }

    .recent-item-info p {
        margin-bottom: 0;
        color: #999;
        font-size: 13px;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-completed { background: #d4edda; color: #155724; }
    .status-cancelled { background: #f8d7da; color: #721c24; }
</style>

<div class="dashboard-container">
    <div class="welcome-banner">
        <h1><i class="fas fa-chart-line"></i> Dashboard Admin</h1>
        <p>Kelola toko dan transaksi Healthy Store</p>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number">{{ $totalUsers ?? 0 }}</div>
                <div class="stat-label">Total User</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-number">{{ $totalProducts ?? 0 }}</div>
                <div class="stat-label">Total Produk</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-number">{{ $totalOrders ?? 0 }}</div>
                <div class="stat-label">Total Pesanan</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-number">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
                <div class="stat-label">Total Penjualan</div>
            </div>
        </div>
    </div>

    <div class="card-section mt-4">
        <h2>
            <i class="fas fa-th-large"></i> Menu Manajemen
        </h2>
        <div class="menu-grid">
            <a href="{{ route('admin.products.index') }}" class="menu-item">
                <i class="fas fa-box"></i>
                <div class="menu-item-title">Kelola Produk</div>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="menu-item">
                <i class="fas fa-shopping-cart"></i>
                <div class="menu-item-title">Kelola Pesanan</div>
            </a>
            <a href="{{ route('profile.edit') }}" class="menu-item">
                <i class="fas fa-cogs"></i>
                <div class="menu-item-title">Pengaturan</div>
            </a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card-section">
                <h2>
                    <i class="fas fa-list"></i> Pesanan Terbaru
                </h2>
                @if(isset($recentOrders) && $recentOrders->count() > 0)
                    @foreach($recentOrders as $order)
                    <div class="recent-item">
                        <div class="recent-item-info">
                            <h4>Order #{{ $order->id }} - {{ $order->user->username ?? 'Guest' }}</h4>
                            <p>{{ $order->created_at->format('d M Y H:i') }} | {{ $order->items->count() }} Items</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="fw-bold text-success">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div><i class="fas fa-inbox"></i></div>
                        <p>Belum ada pesanan</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-section">
                <h2>
                    <i class="fas fa-info-circle"></i> Informasi
                </h2>
                <div class="recent-item p-3">
                    <div class="recent-item-info">
                        <h4>Versi Sistem</h4>
                        <p>v1.0.0</p>
                    </div>
                </div>
                <div class="recent-item p-3">
                    <div class="recent-item-info">
                        <h4>Last Updated</h4>
                        <p>{{ now()->format('d F Y') }}</p>
                    </div>
                </div>
                <div class="recent-item p-3">
                    <div class="recent-item-info">
                        <h4>Status</h4>
                        <p style="color: var(--primary-green); font-weight: 600;">Online</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection