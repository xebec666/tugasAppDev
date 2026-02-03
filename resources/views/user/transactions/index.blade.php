@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-primary to-primary-dark">
            <h1 class="text-2xl font-bold text-white">Riwayat Transaksi</h1>
        </div>
        
        <div class="p-6">
            <div class="divide-y divide-gray-200">
                @forelse($transactions as $transaction)
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between space-y-4 lg:space-y-0">
                        <div class="flex items-start space-x-4">
                            <div class="bg-gradient-to-br from-primary to-primary-dark p-4 rounded-xl shadow-md">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-lg">Pesanan #{{ $transaction->id }}</p>
                                <p class="text-sm text-gray-600 mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $transaction->created_at->format('d F Y • H:i') }}
                                </p>
                                <p class="text-sm text-gray-600 mt-1">{{ $transaction->items->count() }} Item Produk</p>
                                <p class="text-xl font-bold text-primary mt-2">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end space-y-3">
                            <span class="px-4 py-2 bg-blue-100 text-blue-800 text-sm rounded-full font-semibold">{{ ucfirst($transaction->status) }}</span>
                            <div class="flex space-x-2">
                                <a href="{{ route('user.transactions.show', $transaction) }}" class="px-5 py-2 border-2 border-primary text-primary rounded-lg hover:bg-green-50 text-sm font-semibold transition-all">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-10 text-center text-gray-500">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-lg">Belum ada riwayat transaksi.</p>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
