@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<style>
    :root {
        --primary-green: #27ae60;
        --primary-green-dark: #1e8449;
    }

    .page-header {
        background: white;
        padding: 20px 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #333;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .page-title i {
        color: var(--primary-green);
    }

    .content-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table-custom th {
        background: #f8f9fa;
        padding: 15px;
        font-weight: 600;
        color: #555;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
        border: none;
    }
    
    .table-custom th:first-child { border-radius: 8px 0 0 8px; }
    .table-custom th:last-child { border-radius: 0 8px 8px 0; }

    .table-custom td {
        background: white;
        padding: 15px;
        vertical-align: middle;
        border-top: 1px solid #f0f0f0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .table-custom tr td:first-child { border-left: 1px solid #f0f0f0; border-radius: 8px 0 0 8px; }
    .table-custom tr td:last-child { border-right: 1px solid #f0f0f0; border-radius: 0 8px 8px 0; }

    .table-custom tr:hover td {
        background-color: #fbfbfb;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-completed { background: #d4edda; color: #155724; }
    .status-cancelled { background: #f8d7da; color: #721c24; }

    .btn-view {
        background: #3498db;
        color: white;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: none;
        transition: all 0.2s;
    }

    .btn-view:hover {
        background: #2980b9;
        transform: scale(1.1);
        color: white;
    }
</style>

<div class="container-fluid py-4">
    <div class="page-header">
        <h1 class="page-title"><i class="fas fa-history"></i> Riwayat Transaksi</h1>
    </div>

    <div class="content-card">
        <div class="table-responsive">
            <table class="table-custom text-nowrap">
                <thead>
                    <tr>
                        <th width="10%">Order ID</th>
                        <th width="20%">Tanggal</th>
                        <th width="20%">Pelanggan</th>
                        <th width="15%">Total</th>
                        <th width="15%">Status</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                    <tr>
                        <td class="fw-bold">#{{ $transaction->id }}</td>
                        <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $transaction->user->username ?? 'Guest' }}</td>
                        <td class="text-success fw-bold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge status-{{ $transaction->status }}">
                                {{ $transaction->status }}
                            </span>
                        </td>
                        <td>
                            <button class="btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-receipt fa-3x mb-3"></i>
                                <p>Belum ada transaksi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
