@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-primary to-primary-dark text-white flex justify-between items-center">
            <h1 class="text-2xl font-bold">Detail Pesanan #{{ $transaction->id }}</h1>
            <span class="px-4 py-2 bg-white bg-opacity-20 rounded-full text-sm font-semibold backdrop-blur-sm">
                {{ ucfirst($transaction->status) }}
            </span>
        </div>

        <div class="p-6">
            <!-- Info Pesanan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Informasi Pengiriman</h2>
                    <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                        <p class="text-gray-600"><span class="font-semibold w-24 inline-block">Penerima:</span> {{ $transaction->user->username }}</p>
                        <p class="text-gray-600"><span class="font-semibold w-24 inline-block">No. HP:</span> {{ $transaction->user->phone ?? '-' }}</p>
                        <p class="text-gray-600"><span class="font-semibold w-24 inline-block">Alamat:</span> {{ $transaction->address ?? 'Alamat belum diatur' }}</p>
                        <p class="text-gray-600"><span class="font-semibold w-24 inline-block">Tanggal:</span> {{ $transaction->created_at->format('d F Y H:i') }}</p>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Rincian Pembayaran</h2>
                    <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                        <div class="flex justify-between text-gray-600">
                            <span>Metode Pembayaran</span>
                            <span class="font-semibold">Transfer Bank</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Total Harga Barang</span>
                            <span class="font-semibold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span class="font-semibold">Rp 0</span>
                        </div>
                        <div class="border-t border-gray-300 pt-2 mt-2 flex justify-between text-lg font-bold text-primary">
                            <span>Total Bayar</span>
                            <span>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Produk -->
            <h2 class="text-lg font-bold text-gray-800 mb-4">Produk yang Dibeli</h2>
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-600 font-semibold border-b border-gray-200">
                        <tr>
                            <th class="p-4">Produk</th>
                            <th class="p-4 text-center">Jumlah</th>
                            <th class="p-4 text-right">Harga Satuan</th>
                            <th class="p-4 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($transaction->items as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4">
                                <div class="flex items-center space-x-3">
                                    <div class="h-12 w-12 bg-gray-200 rounded-md overflow-hidden">
                                        <!-- Placeholder image if no product image -->
                                         @if($item->product->image_path)
                                            <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                                        <p class="text-xs text-gray-500">SKU: {{ $item->product->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-center">{{ $item->quantity }}</td>
                            <td class="p-4 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="p-4 text-right font-semibold text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('user.dashboard') }}" class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold transition-all">Kembali</a>
                @if($transaction->status == 'pending')
                    <button class="px-6 py-3 bg-gradient-to-r from-primary to-primary-dark text-white rounded-lg hover:shadow-lg font-semibold transition-all transform hover:scale-105">Bayar Sekarang</button>
                @elseif($transaction->status == 'completed')
                    <!-- Review Button Modal Trigger or similar could go here -->
                    <button class="px-6 py-3 border-2 border-primary text-primary rounded-lg hover:bg-green-50 font-semibold transition-all">Beri Ulasan</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
