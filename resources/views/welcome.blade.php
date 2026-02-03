<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Grocery - Order Your Daily Groceries</title>
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
                    <a href="#" class="text-green-500 font-medium hover:text-green-600">Home</a>
                    <a href="#" class="text-gray-600 hover:text-green-500">Categories</a>
                    <a href="#" class="text-gray-600 hover:text-green-500">Our Offering</a>
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

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-green-100 to-green-50 py-16">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h1 class="text-5xl font-bold text-gray-800 mb-4">Order your<br>Daily Groceries</h1>
                    <p class="text-green-500 text-xl mb-8">#Free Delivery</p>
                    <div class="relative max-w-md">
                        <input type="text" placeholder="Search your daily groceries..." class="w-full px-6 py-4 rounded-full border-2 border-gray-200 focus:border-green-500 focus:outline-none">
                        <button class="absolute right-2 top-2 bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600">Search</button>
                    </div>
                </div>
                <div class="md:w-1/2 relative">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=600&h=600&fit=crop" alt="Groceries" class="rounded-3xl shadow-2xl">
                    <div class="absolute -bottom-4 -left-4 w-24 h-24 hidden md:block">
                        
                    </div>
                    <div class="absolute top-8 -right-4 w-20 h-20 hidden md:block">
                        <img src="https://images.unsplash.com/photo-1523049673857-eb18f1d7b578?w=80&h=80&fit=crop" alt="Avocado" class="rounded-full shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Category</h2>
                <div class="flex space-x-2">
                    <button class="p-2 rounded-full border border-gray-300 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button class="p-2 rounded-full bg-green-500 text-white hover:bg-green-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-3 md:grid-cols-7 gap-6">
                <div class="flex flex-col items-center text-center group cursor-pointer">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-2 group-hover:bg-green-100 transition">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Need A Hot</span>
                </div>
                <div class="flex flex-col items-center text-center group cursor-pointer">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-2 group-hover:bg-green-100 transition">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Vegetables</span>
                </div>
                <div class="flex flex-col items-center text-center group cursor-pointer">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-2 group-hover:bg-green-100 transition">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Medicine</span>
                </div>
                <div class="flex flex-col items-center text-center group cursor-pointer">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-2 group-hover:bg-green-100 transition">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Baby</span>
                </div>
                <div class="flex flex-col items-center text-center group cursor-pointer">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-2 group-hover:bg-green-100 transition">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Bakery</span>
                </div>
                <div class="flex flex-col items-center text-center group cursor-pointer">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-2 group-hover:bg-green-100 transition">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Beauty</span>
                </div>
                <div class="flex flex-col items-center text-center group cursor-pointer">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-2 group-hover:bg-green-100 transition">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Grooming</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Products -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Popular Product</h2>
                <button class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600">See All</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @forelse($products as $product)
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
                    <p class="text-sm text-gray-500 mb-3 line-clamp-2 min-h-[40px]">{{ $product->description }}</p>
                    
                    <div class="mt-auto flex items-center justify-between">
                        <span class="text-xl font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <div class="flex items-center space-x-2">
                             <input type="number" id="qty-{{ $product->id }}" min="1" value="1" class="w-12 text-center border border-gray-300 rounded-lg py-1 focus:ring-green-500 focus:border-green-500">
                            <!-- Add to Cart functionality -->
                            <button onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->image ? asset('storage/' . $product->image) : '' }}')" class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white hover:bg-green-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-4 text-center py-10">
                    <p class="text-gray-500 text-lg">Belum ada produk yang tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Popular Bundle Pack -->
    <section class="py-16 bg-gradient-to-br from-green-50 to-green-100">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Popular Bundle Pack</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Bundle Card 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=300&h=300&fit=crop" alt="Medium Box" class="w-full h-48 object-cover rounded-xl mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Medium Box</h3>
                    <p class="text-sm text-gray-500 mb-3">Cabbage 1x, Cauliflower</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-gray-800">$55</span>
                        <div class="flex items-center space-x-2">
                            <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100">-</button>
                            <span class="font-medium">2</span>
                            <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100">+</button>
                            <button class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white hover:bg-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Bundle Card 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=300&h=300&fit=crop" alt="Big Pack" class="w-full h-48 object-cover rounded-xl mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Big Pack</h3>
                    <p class="text-sm text-gray-500 mb-3">Cabbage 1x, Cauliflower</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-gray-800">$55</span>
                        <div class="flex items-center space-x-2">
                            <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100">-</button>
                            <span class="font-medium">2</span>
                            <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100">+</button>
                            <button class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white hover:bg-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Bundle Card 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1610348725531-843dff563e2c?w=300&h=300&fit=crop" alt="Small" class="w-full h-48 object-cover rounded-xl mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Small</h3>
                    <p class="text-sm text-gray-500 mb-3">Cabbage 1x, Cauliflower</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-gray-800">$55</span>
                        <div class="flex items-center space-x-2">
                            <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100">-</button>
                            <span class="font-medium">2</span>
                            <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100">+</button>
                            <button class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white hover:bg-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">What Our Clients Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-2xl p-6">
                    <div class="flex items-center mb-4">
                        <img src="https://ui-avatars.com/api/?name=James+Bond" alt="James Bond" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-gray-800">James Bond</h4>
                            <div class="flex text-yellow-400">
                                ★★★★★
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6">
                    <div class="flex items-center mb-4">
                        <img src="https://ui-avatars.com/api/?name=Thor+Bott" alt="Thor Bott" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-gray-800">Thor Bott</h4>
                            <div class="flex text-yellow-400">
                                ★★★★☆
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Download App -->
    <section class="py-16 bg-gradient-to-br from-green-50 to-green-100">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Download App</h2>
                <p class="text-gray-600 mb-6">Download our mobile app and get access to exclusive deals and faster checkout!</p>
                <div class="flex space-x-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play" class="h-12">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg" alt="App Store" class="h-12">
                </div>
            </div>
        </div>
    </section>

    <!-- Partners -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-center space-x-12 opacity-50">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Adidas_Logo.svg" alt="Adidas" class="h-8 grayscale">
                <span class="text-2xl font-bold text-gray-400">CORSAIR</span>
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/3f/Walt_Disney_Signature.svg" alt="Disney" class="h-12 grayscale">
            </div>
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
                        <a href="{{ route('user.transactions.create') }}" class="flex w-full py-4 bg-green-500 text-white rounded-xl font-bold text-lg hover:bg-green-600 shadow-lg transform active:scale-95 transition-all items-center justify-center">
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
        // Store cart in localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function toggleCart() {
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

        function addToCart(id, name, price, image) {
            const qtyInput = document.getElementById(`qty-${id}`);
            const quantity = qtyInput ? parseInt(qtyInput.value) : 1;

            const existingItem = cart.find(item => item.id === id);
            
            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    image: image,
                    quantity: quantity
                });
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
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cart-count').innerText = count;
        }

        function updateCartUI() {
            const container = document.getElementById('cart-items-container');
            const subtotalEl = document.getElementById('cart-subtotal');
            const taxEl = document.getElementById('cart-tax');
            const totalEl = document.getElementById('cart-total');

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
                return;
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
            cart[index].quantity += change;
            if (cart[index].quantity < 1) cart[index].quantity = 1;
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
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            updateCartCount();
        });
    </script>
</body>
</html>