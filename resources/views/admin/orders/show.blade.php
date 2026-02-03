<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - Admin</title>
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
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan #{{ $order->id }}</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Customer</h2>
                <div class="space-y-2">
                    <p class="text-sm"><span class="font-medium">Nama:</span> {{ $order->user->username }}</p>
                    <p class="text-sm"><span class="font-medium">Email:</span> {{ $order->user->email }}</p>
                    <p class="text-sm"><span class="font-medium">Phone:</span> {{ $order->user->phone ?? '-' }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pesanan</h2>
                <div class="space-y-2">
                    <p class="text-sm"><span class="font-medium">Tanggal:</span> {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p class="text-sm"><span class="font-medium">Status:</span> 
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 
                               ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                               ($order->status == 'processing' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PATCH')
                        <label class="block text-sm font-medium mb-2">Update Status:</label>
                        <div class="flex gap-2">
                            <select name="status" class="flex-1 rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Detail Produk</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($order->details as $detail)
                    <div class="flex items-center space-x-4 pb-4 border-b last:border-0">
                        <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
                            @if($detail->product->image)
                                <img src="{{ asset('storage/' . $detail->product->image) }}" class="w-full h-full object-cover" alt="{{ $detail->product->name }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900">{{ $detail->product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $detail->qty }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right font-medium text-gray-900">
                            Rp {{ number_format($detail->price * $detail->qty, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="p-6 bg-gray-50 border-t">
                <div class="flex justify-between items-center text-lg font-bold">
                    <span>Total Pembayaran</span>
                    <span class="text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>
</body>
</html>
