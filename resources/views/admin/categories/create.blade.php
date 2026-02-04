@extends('layouts.app')

@section('title', 'Tambah Kategori')

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
        text-decoration: none;
    }

    .btn-back {
        color: #666;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .btn-back:hover {
        color: var(--primary-green);
    }

    .content-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        max-width: 800px;
        margin: 0 auto;
    }

    .form-label {
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #ddd;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.2);
    }

    .btn-submit {
        background: var(--primary-green);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s;
        width: 100%;
    }

    .btn-submit:hover {
        background: var(--primary-green-dark);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
    }
</style>

<div class="container-fluid py-4">
    <div class="page-header">
        <a href="{{ route('admin.categories.index') }}" class="page-title">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
        <h2 class="m-0" style="font-size: 20px; color: #666;">Tambah Kategori Baru</h2>
    </div>

    <div class="content-card">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama kategori..." required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Slug akan dibuat otomatis dari nama kategori</small>
            </div>

            <div class="mb-5">
                <label for="description" class="form-label">Deskripsi (Opsional)</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Jelaskan kategori ini...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save me-2"></i> Simpan Kategori
            </button>
        </form>
    </div>
</div>
@endsection
