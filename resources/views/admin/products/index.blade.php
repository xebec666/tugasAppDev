@extends('layouts.app')

@section('title', 'Kelola Produk')

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

    .btn-custom-primary {
        background: var(--primary-green);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-custom-primary:hover {
        background: var(--primary-green-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
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

    .product-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        background: #eee;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        margin-right: 5px;
        transition: all 0.2s;
        border: none;
        color: white;
    }

    .btn-edit { background: #f39c12; }
    .btn-delete { background: #e74c3c; }
    
    .btn-edit:hover, .btn-delete:hover {
        transform: scale(1.1);
        color: white;
    }

</style>

<div class="container-fluid py-4">
    <div class="page-header">
        <h1 class="page-title"><i class="fas fa-box"></i> Manajemen Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="btn-custom-primary">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; border: none; background: #d4edda; color: #155724;">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="content-card">
        <div class="table-responsive">
            <table class="table-custom text-nowrap">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="10%">Gambar</th>
                        <th width="25%">Nama Produk</th>
                        <th width="15%">Harga</th>
                        <th width="10%">Stok</th>
                        <th width="20%">Deskripsi (Short)</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>#{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="product-img" alt="{{ $product->name }}">
                            @else
                                <div class="product-img d-flex align-items-center justify-content-center text-muted">No Img</div>
                            @endif
                        </td>
                        <td class="fw-bold text-dark">{{ $product->name }}</td>
                        <td class="text-success fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            @if($product->stock > 10)
                                <span class="badge bg-success">{{ $product->stock }} Pcs</span>
                            @elseif($product->stock > 0)
                                <span class="badge bg-warning text-dark">{{ $product->stock }} Pcs</span>
                            @else
                                <span class="badge bg-danger">Habis</span>
                            @endif
                        </td>
                        <td class="text-muted">{{ Str::limit($product->description, 50) }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="action-btn btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-box-open fa-3x mb-3"></i>
                                <p>Belum ada produk yang ditambahkan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
