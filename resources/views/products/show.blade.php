<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Healthy Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10b981',
                        'primary-dark': '#059669',
                        'primary-light': '#34d399',
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
                    @auth
                        <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-primary font-medium">Dashboard</a>
                        <form method="GET" action="{{ route('logout') }}"> 
                            <!-- Note: Using script in dashboard for logout, here typical link -->
                             <a href="{{ route('logout') }}" class="text-gray-600 hover:text-primary font-medium">Logout</a>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-colors">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 font-medium">{{ $product->name }}</span>
        </nav>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Product Image -->
                <div class="md:w-1/2 p-6 bg-gray-100 flex items-center justify-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto max-h-[500px] object-contain rounded-xl shadow-sm mix-blend-multiply">
                    @else
                        <div class="w-full h-[400px] bg-gray-200 flex items-center justify-center rounded-xl text-gray-400">
                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="md:w-1/2 p-8 md:p-10 flex flex-col justify-between">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-4">{{ $product->name }}</h1>
                        
                        <div class="flex items-center space-x-4 mb-6">
                            <p class="text-3xl font-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            @if($product->stock > 0)
                                <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wide">Tersedia: {{ $product->stock }}</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wide">Stok Habis</span>
                            @endif
                        </div>

                        <div class="prose prose-sm text-gray-600 mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi Produk</h3>
                            <p class="leading-relaxed">{{ $product->description }}</p>
                        </div>
                    </div>

                    <!-- Action Area -->
                    <div class="border-t border-gray-100 pt-8">
                        @auth
                            <form action="{{ route('user.transactions.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="flex items-center space-x-4">
                                    <div class="w-32">
                                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                        <div class="flex items-center border border-gray-300 rounded-lg">
                                            <button type="button" onclick="decrement()" class="px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-l-lg">-</button>
                                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full text-center border-none focus:ring-0 p-2" readonly>
                                            <button type="button" onclick="increment()" class="px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-r-lg">+</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="w-full md:w-auto px-8 py-4 bg-gradient-to-r from-primary to-primary-dark text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all transform flex items-center justify-center space-x-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <span>Beli Sekarang / Bayar</span>
                                </button>
                                <p class="text-xs text-gray-500 mt-2 text-center md:text-left">
                                    *Pembayaran instan (Simple Payment)
                                </p>
                            </form>
                        @else
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
                                <p class="text-blue-800 font-medium mb-2">Silakan login untuk membeli produk ini</p>
                                <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold">Login Sekarang</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Lainnya</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <a href="{{ route('products.show', $related->id) }}" class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all overflow-hidden border border-gray-100">
                    <div class="h-48 bg-gray-100 flex items-center justify-center relative overflow-hidden">
                        @if($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 group-hover:text-primary transition-colors truncate">{{ $related->name }}</h3>
                        <p class="text-primary font-bold mt-2">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </main>

    <script>
        function increment() {
            var input = document.getElementById('quantity');
            var max = parseInt(input.getAttribute('max'));
            var value = parseInt(input.value);
            if (value < max) {
                input.value = value + 1;
            }
        }

        function decrement() {
            var input = document.getElementById('quantity');
            var value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        }
    </script>
</body>
</html>
