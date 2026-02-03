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
                            
                            <div class="flex items-center space-x-2">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= round($product->reviews_avg_rating) ? 'fill-current' : 'text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-sm text-gray-500">({{ $product->reviews_count }} ulasan)</span>
                            </div>
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
                            @if($product->stock > 0)
                                <div class="space-y-4">
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

                                    <div class="flex space-x-4">
                                        <button type="button" 
                                                onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->image ? asset('storage/' . $product->image) : '' }}', {{ $product->stock }})"
                                                class="flex-1 px-8 py-4 bg-white border-2 border-primary text-primary font-bold rounded-xl shadow-lg hover:bg-green-50 hover:scale-105 transition-all transform flex items-center justify-center space-x-2">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <span>Tambah Keranjang</span>
                                        </button>

                                        <button type="button" onclick="buyNow()" class="flex-1 px-8 py-4 bg-gradient-to-r from-primary to-primary-dark text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all transform flex items-center justify-center space-x-2">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path> 
                                            </svg>
                                            <span>Beli Sekarang</span>
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2 text-center md:text-left">
                                        *Pembayaran instan (Simple Payment)
                                    </p>
                                </div>
                            @else
                                <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <p class="text-red-800 font-bold text-lg mb-2">Stok Habis</p>
                                    <p class="text-red-600 text-sm">Produk ini sedang tidak tersedia</p>
                                </div>
                            @endif
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

        <!-- Reviews Section -->
        <div class="mt-8 bg-white rounded-2xl shadow-xl overflow-hidden p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Ulasan Produk</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Reviews List -->
                <div class="md:col-span-2 space-y-6">
                    @forelse($product->reviews as $review)
                        <div class="border-b border-gray-100 pb-6 last:border-0">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <div class="font-bold text-gray-800">{{ $review->user->name }}</div>
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                        @endfor
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 leading-relaxed">{{ $review->review }}</p>
                        </div>
                    @empty
                        <div class="text-center py-10 text-gray-500">
                            <p>Belum ada ulasan untuk produk ini.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Review Form -->
                <div>
                    @auth
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                            <h3 class="font-bold text-gray-900 mb-4">Tulis Ulasan</h3>
                            <form action="{{ route('user.reviews.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                    <div class="flex flex-row-reverse justify-end space-x-1 space-x-reverse group">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" name="rating" id="star{{$i}}" value="{{$i}}" class="peer hidden" required />
                                            <label for="star{{$i}}" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 peer-hover:text-yellow-400">
                                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            </label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="review" class="block text-sm font-medium text-gray-700 mb-1">Ulasan Anda</label>
                                    <textarea name="review" id="review" rows="4" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 p-2 text-sm" placeholder="Bagikan pengalaman Anda..." required></textarea>
                                </div>

                                <button type="submit" class="w-full bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600 transition-colors">
                                    Kirim Ulasan
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 text-center">
                            <p class="text-gray-600 mb-4">Silakan login untuk menulis ulasan.</p>
                            <a href="{{ route('login') }}" class="inline-block bg-white border border-gray-300 text-gray-700 font-semibold py-2 px-6 rounded-lg hover:bg-gray-50 transition-colors">
                                Login
                            </a>
                        </div>
                    @endauth
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
                        
                        <div class="flex items-center mt-1">
                            <div class="flex text-yellow-400 text-xs">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3 h-3 {{ $i <= round($related->reviews_avg_rating) ? 'fill-current' : 'text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-400 ml-1">({{ $related->reviews_avg_rating ? number_format($related->reviews_avg_rating, 1) : '0' }})</span>
                        </div>
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

        // Get current user ID
        const currentUserId = {{ Auth::id() }};
        const cartKey = currentUserId ? `cart_${currentUserId}` : 'cart';

        function addToCart(id, name, price, image, stock) {
            let cart = JSON.parse(localStorage.getItem(cartKey)) || [];
            const qtyInput = document.getElementById('quantity');
            const requestedQuantity = qtyInput ? parseInt(qtyInput.value) : 1;

            const existingItem = cart.find(item => item.id === id);
            
            if (existingItem) {
                const totalQuantity = existingItem.quantity + requestedQuantity;
                if (totalQuantity > stock) {
                    alert(`Stok tidak mencukupi. Maksimal stok yang bisa dipesan adalah ${stock}.`);
                    existingItem.quantity = stock;
                } else {
                    existingItem.quantity = totalQuantity;
                }
            } else {
                if (requestedQuantity > stock) {
                    alert(`Stok tidak mencukupi. Maksimal stok yang bisa dipesan adalah ${stock}.`);
                    cart.push({
                        id: id,
                        name: name,
                        price: price,
                        image: image,
                        quantity: stock,
                        stock: stock
                    });
                } else {
                    cart.push({
                        id: id,
                        name: name,
                        price: price,
                        image: image,
                        quantity: requestedQuantity,
                        stock: stock
                    });
                }
            }

            localStorage.setItem(cartKey, JSON.stringify(cart));
            
            // Visual feedback
            alert('Produk berhasil ditambahkan ke keranjang!');
        }

        function buyNow() {
            const productId = {{ $product->id }};
            const productName = '{{ $product->name }}';
            const productPrice = {{ $product->price }};
            const productImage = '{{ $product->image ? asset('storage/' . $product->image) : '' }}';
            const qtyInput = document.getElementById('quantity');
            const quantity = qtyInput ? parseInt(qtyInput.value) : 1;

            // Clear cart and add only this product
            const cart = [{
                id: productId,
                name: productName,
                price: productPrice,
                image: productImage,
                quantity: quantity
            }];

            localStorage.setItem(cartKey, JSON.stringify(cart));
            
            // Redirect to checkout
            window.location.href = '{{ route('user.transactions.create') }}';
        }
    </script>
</body>
</html>
