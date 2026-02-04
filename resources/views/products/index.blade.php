<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - E-Grocery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="text-2xl font-bold text-gray-800">E-Grocery</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-500">Home</a>
                    <a href="{{ route('products.index') }}" class="text-green-500 font-medium hover:text-green-600">Products</a>
                    <a href="#" class="text-gray-600 hover:text-green-500">Categories</a>
                    <a href="#" class="text-gray-600 hover:text-green-500">Our App</a>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Cart Trigger -->
                    <button onclick="toggleCart()" class="relative hover:text-green-500 transition-colors focus:outline-none">
                        <svg class="w-6 h-6 text-gray-600 hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-green-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </button>

                    <!-- Auth Logic -->
                    @auth
                        <div class="flex items-center space-x-2">
                            <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->username) }}" alt="{{ Auth::user()->username }}" class="w-8 h-8 rounded-full border border-gray-200">
                            <a href="{{ route('user.dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-green-500 transition-colors">{{ Auth::user()->username }}</a>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-green-500 transition-colors">Login</a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-full hover:bg-green-600 transition-colors shadow-sm">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <section class="bg-white border-b">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-green-500">Home</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-800 font-medium">All Products</span>
            </div>
        </div>
    </section>

    <!-- Page Header -->
    <section class="bg-gradient-to-br from-green-100 to-green-50 py-12">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">All Products</h1>
            <p class="text-gray-600 mb-6">Discover our complete range of fresh and healthy groceries</p>
            
            <!-- Search Bar -->
            <form method="GET" action="{{ route('products.index') }}" class="max-w-2xl mb-6">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for products..." class="w-full px-6 py-4 rounded-full border-2 border-gray-200 focus:border-green-500 focus:outline-none">
                    <button type="submit" class="absolute right-2 top-2 bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600">Search</button>
                </div>
            </form>

            <!-- Category Filter -->
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('products.index', ['search' => request('search')]) }}" class="px-6 py-2 {{ !request('category') ? 'bg-green-500 text-white' : 'bg-white text-gray-700 border border-gray-300' }} rounded-full font-medium hover:bg-green-500 hover:text-white transition-all shadow-sm text-sm">
                    All
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->name, 'search' => request('search')]) }}" class="px-6 py-2 {{ request('category') == $category->name ? 'bg-green-500 text-white' : 'bg-white text-gray-700 border border-gray-300' }} rounded-full font-medium hover:bg-green-500 hover:text-white transition-all shadow-sm text-sm">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            @if($products->count() > 0)
                <div class="mb-6 flex items-center justify-between">
                    <p class="text-gray-600">Showing <span class="font-semibold">{{ $products->firstItem() }}</span> to <span class="font-semibold">{{ $products->lastItem() }}</span> of <span class="font-semibold">{{ $products->total() }}</span> products</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                    <!-- Product Card -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition flex flex-col h-full">
                        <div class="relative h-48 mb-4 overflow-hidden rounded-xl">
                            <a href="{{ route('products.show', $product->id) }}">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </a>
                        </div>
                        
                        <a href="{{ route('products.show', $product->id) }}">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1 line-clamp-1" title="{{ $product->name }}">{{ $product->name }}</h3>
                        </a>
                        
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3 h-3 {{ $i <= round($product->reviews_avg_rating) ? 'fill-current' : 'text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-400 ml-1">({{ $product->reviews_avg_rating ? number_format($product->reviews_avg_rating, 1) : '0' }})</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-3 line-clamp-2 min-h-[40px]">{{ $product->description }}</p>
                        
                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-xl font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <div class="flex items-center space-x-2">
                                @if($product->stock > 0)
                                    <input type="number" id="qty-{{ $product->id }}" min="1" max="{{ $product->stock }}" value="1" class="w-12 text-center border border-gray-300 rounded-lg py-1 focus:ring-green-500 focus:border-green-500">
                                    <!-- Add to Cart functionality -->
                                    <button onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->image ? asset('storage/' . $product->image) : '' }}', {{ $product->stock }})" class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white hover:bg-green-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </button>
                                @else
                                    <span class="text-xs text-red-600 font-semibold bg-red-50 px-3 py-1 rounded-full">Stok Habis</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">No Products Found</h3>
                    <p class="text-gray-600 mb-6">Try adjusting your search or filters</p>
                    <a href="{{ route('products.index') }}" class="inline-block px-6 py-3 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors">View All Products</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">About</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">Service Us</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                        <li><a href="#" class="hover:text-white">Company</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Delivery</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white">Orders Delivery</a></li>
                        <li><a href="#" class="hover:text-white">Track Your order</a></li>
                        <li><a href="#" class="hover:text-white">Delivery Status</a></li>
                        <li><a href="#" class="hover:text-white">Shipping</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white">WhatsApp</a></li>
                        <li><a href="#" class="hover:text-white">Support 24/7</a></li>
                        <li><a href="mailto:shoppingcenter@gmail.com" class="hover:text-white">shoppingcenter@gmail.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cart Sidebar -->
    <div id="cart-sidebar" class="fixed inset-0 z-50 hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity" onclick="toggleCart()"></div>
        
        <!-- Sidebar -->
        <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl transform transition-transform duration-300 translate-x-full" id="cart-panel">
            <div class="flex flex-col h-full">
                <!-- Header -->
                <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-green-500 text-white">
                    <h2 class="text-xl font-bold flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Keranjang Belanja
                    </h2>
                    <button onclick="toggleCart()" class="p-2 hover:bg-green-600 rounded-full transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Cart Items (Scrollable) -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4" id="cart-items-container">
                    <!-- Empty State (Default) -->
                    <div class="text-center py-10 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-lg font-medium">Keranjang Anda kosong</p>
                        <p class="text-sm">Yuk mulai belanja kebutuhan harianmu!</p>
                    </div>
                    
                    <!-- Items will be injected here by JS -->
                </div>

                <!-- Order Details / Footer -->
                <div class="p-6 border-t border-gray-100 bg-gray-50">
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-semibold" id="cart-subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Pajak (11%)</span>
                            <span class="font-semibold" id="cart-tax">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-xl font-bold text-gray-800 pt-3 border-t border-gray-200">
                            <span>Total</span>
                            <span class="text-green-600" id="cart-total">Rp 0</span>
                        </div>
                    </div>
                    
                    @auth
                        <a id="checkout-btn" href="{{ route('user.transactions.create') }}" class="flex w-full py-4 bg-green-500 text-white rounded-xl font-bold text-lg hover:bg-green-600 shadow-lg transform active:scale-95 transition-all items-center justify-center">
                            Checkout Sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full py-4 bg-gray-800 text-white text-center rounded-xl font-bold text-lg hover:bg-gray-700 shadow-lg transform active:scale-95 transition-all">
                            Login untuk Checkout
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <script>
        const currentUserId = {{ Auth::id() ?? 'null' }};
        const cartKey = currentUserId ? `cart_${currentUserId}` : null;
        
        // Store cart in localStorage
        let cart = cartKey ? (JSON.parse(localStorage.getItem(cartKey)) || []) : [];

        function toggleCart() {
            if (!currentUserId) {
                window.location.href = "{{ route('login') }}";
                return;
            }

            const sidebar = document.getElementById('cart-sidebar');
            const panel = document.getElementById('cart-panel');
            
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                setTimeout(() => {
                    panel.classList.remove('translate-x-full');
                }, 10);
                updateCartUI();
            } else {
                panel.classList.add('translate-x-full');
                setTimeout(() => {
                    sidebar.classList.add('hidden');
                }, 300);
            }
        }

        function addToCart(id, name, price, image, stock) {
            if (!currentUserId) {
                window.location.href = "{{ route('login') }}";
                return;
            }

            const qtyInput = document.getElementById(`qty-${id}`);
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

            saveCart();
            updateCartCount();
            
            // Visual feedback
            const btn = event.currentTarget;
            const originalContent = btn.innerHTML;
            btn.innerHTML = `<svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`;
            setTimeout(() => {
                btn.innerHTML = originalContent;
            }, 1000);
            
            // Optional: Open cart
             toggleCart();
        }

        function updateCartCount() {
            if (!currentUserId) {
                document.getElementById('cart-count').innerText = 0;
                return;
            }
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cart-count').innerText = count;
        }

        function updateCartUI() {
            if (!currentUserId) return;

            const container = document.getElementById('cart-items-container');
            const subtotalEl = document.getElementById('cart-subtotal');
            const taxEl = document.getElementById('cart-tax');
            const totalEl = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('checkout-btn');

            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-10 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-lg font-medium">Keranjang Anda kosong</p>
                        <p class="text-sm">Yuk mulai belanja kebutuhan harianmu!</p>
                    </div>`;
                subtotalEl.innerText = 'Rp 0';
                taxEl.innerText = 'Rp 0';
                totalEl.innerText = 'Rp 0';
                
                if (checkoutBtn) {
                   checkoutBtn.classList.add('pointer-events-none', 'opacity-50', 'cursor-not-allowed');
                }
                return;
            }
            
            if (checkoutBtn) {
               checkoutBtn.classList.remove('pointer-events-none', 'opacity-50', 'cursor-not-allowed');
            }

            let subtotal = 0;
            container.innerHTML = cart.map((item, index) => {
                subtotal += item.price * item.quantity;
                return `
                <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-xl">
                    <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center overflow-hidden border border-gray-200">
                        ${item.image ? `<img src="${item.image}" class="w-full h-full object-cover">` : 
                        `<svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>`}
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 line-clamp-1">${item.name}</h4>
                        <p class="text-green-600 font-bold text-sm">Rp ${item.price.toLocaleString('id-ID')}</p>
                        <div class="flex items-center space-x-2 mt-2">
                            <button onclick="updateQty(${index}, -1)" class="w-6 h-6 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:bg-gray-100 text-xs">-</button>
                            <span class="text-sm font-medium w-6 text-center">${item.quantity}</span>
                            <button onclick="updateQty(${index}, 1)" class="w-6 h-6 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:bg-gray-100 text-xs">+</button>
                        </div>
                    </div>
                    <button onclick="removeItem(${index})" class="text-gray-400 hover:text-red-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
                `;
            }).join('');

            const tax = subtotal * 0.11;
            const total = subtotal + tax;

            subtotalEl.innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
            taxEl.innerText = 'Rp ' + tax.toLocaleString('id-ID');
            totalEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        function updateQty(index, change) {
            const item = cart[index];
            const newQuantity = item.quantity + change;
            
            if (newQuantity < 1) {
                item.quantity = 1;
            } else if (newQuantity > item.stock) {
                alert(`Stok tidak mencukupi untuk ${item.name}. Maksimal stok: ${item.stock}`);
                item.quantity = item.stock;
            } else {
                item.quantity = newQuantity;
            }
            
            saveCart();
            updateCartUI();
            updateCartCount();
        }

        function removeItem(index) {
            cart.splice(index, 1);
            saveCart();
            updateCartUI();
            updateCartCount();
        }

        function saveCart() {
            if (cartKey) {
                localStorage.setItem(cartKey, JSON.stringify(cart));
            }
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            updateCartCount();
        });
    </script>
</body>
</html>
