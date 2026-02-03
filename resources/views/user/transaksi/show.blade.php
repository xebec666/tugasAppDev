<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - Healthy Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10b981',
                        'primary-dark': '#059669',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    
    <!-- Navbar (Simple) -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-primary">Healthy Store</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-primary font-medium">Dashboard</a>
                    <a href="{{ route('user.transactions.index') }}" class="text-gray-600 hover:text-primary font-medium">Riwayat</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Detail Transaksi #{{ $transaction->id }}</h1>
            <span class="px-3 py-1 rounded-full text-sm font-bold 
                {{ $transaction->status == 'success' ? 'bg-green-100 text-green-800' : 
                   ($transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                {{ ucfirst($transaction->status) }}
            </span>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Produk</h2>
                <div class="space-y-4">
                    @foreach($transaction->items as $item)
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover" alt="{{ $item->product->name }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="text-gray-900 font-medium">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right font-medium text-gray-900">
                            Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="p-6 bg-gray-50">
                <div class="flex justify-between items-center text-lg font-bold text-gray-900">
                    <span>Total Pembayaran</span>
                    <span class="text-primary">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <div class="flex justify-between">
            <a href="{{ route('user.transactions.index') }}" class="text-gray-600 hover:text-gray-900 font-medium flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Riwayat
            </a>
            
            @if($transaction->status == 'pending')
            <a href="{{ route('user.transactions.payment', $transaction->id) }}" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition shadow-md">
                Bayar Sekarang / Konfirmasi
            </a>
            @endif
        </div>
    </div>
</body>
</html>
