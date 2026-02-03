<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
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
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white shadow-lg flex flex-col transition-all duration-300 relative z-20">
            <!-- Logo & Brand -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-primary to-primary-dark">
                <h1 class="text-2xl font-bold text-white">MyDashboard</h1>
                <p class="text-xs text-green-50 mt-1">Portal Pengguna</p>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="#" onclick="showSection('profil')" class="nav-item flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 bg-primary text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="font-medium">Edit Profil</span>
                </a>
                
                <a href="#" onclick="showSection('pesanan')" class="nav-item flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    <span class="font-medium">Pesanan Saya</span>
                </a>
                
                <a href="#" onclick="showSection('notifikasi')" class="nav-item flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="font-medium">Notifikasi</span>
                    <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1 font-semibold">5</span>
                </a>
                
                <a href="#" onclick="showSection('transaksi')" class="nav-item flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">Riwayat Transaksi</span>
                </a>
                
                <a href="#" onclick="showSection('helpdesk')" class="nav-item flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">Help Desk</span>
                </a>
            </nav>
            
            <!-- User Info & Logout -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3 mb-3 p-3 bg-gradient-to-r from-primary to-primary-dark rounded-lg">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=10b981&color=fff" alt="User" class="w-10 h-10 rounded-full border-2 border-white">
                    <div class="flex-1">
                        <p class="font-medium text-white text-sm">{{ $user->username }}</p>
                        <p class="text-xs text-green-50">{{ ucfirst($user->role) }}</p>
                    </div>
                </div>
                <button onclick="logout()" class="w-full flex items-center justify-center space-x-2 p-3 rounded-lg text-red-600 hover:bg-red-50 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span class="font-semibold">Logout</span>
                </button>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-10">
                <div class="flex items-center justify-between p-6">
                    <div>
                        <h2 id="page-title" class="text-2xl font-bold text-gray-800">Edit Profil</h2>
                        <p id="page-subtitle" class="text-gray-600 text-sm mt-1">Kelola informasi profil Anda</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Notification Icon -->
                        <button onclick="showSection('notifikasi')" class="relative p-2 text-gray-600 hover:text-primary hover:bg-green-50 rounded-full transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                        </button>
                        
                        <!-- Mobile Menu Toggle -->
                        <button onclick="toggleSidebar()" class="lg:hidden p-2 text-gray-600 hover:text-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Container -->
            <div class="p-6">
                <!-- Edit Profil Section -->
                <div id="section-profil" class="content-section">
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <!-- Profile Header -->
                        <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 mb-8 pb-6 border-b border-gray-200">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&size=128&background=10b981&color=fff" alt="Profile" class="w-32 h-32 rounded-full border-4 border-primary shadow-lg">
                            </div>
                            <div class="text-center md:text-left">
                                <h3 class="text-2xl font-bold text-gray-800">{{ $user->username }}</h3>
                                <p class="text-gray-600 mt-1">{{ $user->email }}</p>
                                <div class="flex items-center justify-center md:justify-start space-x-2 mt-3">
                                    <span class="px-3 py-1 bg-gradient-to-r from-primary to-primary-dark text-white text-xs rounded-full font-semibold shadow">{{ ucfirst($user->role) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Form -->
                        <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                                    <input type="text" name="username" value="{{ $user->username }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="Masukkan nama lengkap">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="Masukkan email">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon *</label>
                                    <input type="tel" name="phone" value="{{ $user->phone }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="+62">
                                </div>
                                
                            </div>
                           
                            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4">
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary to-primary-dark text-white rounded-lg hover:shadow-lg font-semibold transition-all transform hover:scale-105">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Pesanan Saya Section -->
                <div id="section-pesanan" class="content-section hidden">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-all transform hover:scale-105">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-orange-100 text-sm font-medium">Menunggu Pembayaran</p>
                                    <p class="text-4xl font-bold mt-2">{{ $pendingOrderCount }}</p>
                                    <p class="text-orange-100 text-xs mt-1">pesanan</p>
                                </div>
                                <div class="bg-white bg-opacity-20 p-4 rounded-full">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-all transform hover:scale-105">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm font-medium">Diproses</p>
                                    <p class="text-4xl font-bold mt-2">{{ $processingOrderCount }}</p>
                                    <p class="text-blue-100 text-xs mt-1">pesanan</p>
                                </div>
                                <div class="bg-white bg-opacity-20 p-4 rounded-full">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-all transform hover:scale-105">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-100 text-sm font-medium">Dikirim</p>
                                    <p class="text-4xl font-bold mt-2">{{ $shippedOrderCount }}</p>
                                    <p class="text-purple-100 text-xs mt-1">pesanan</p>
                                </div>
                                <div class="bg-white bg-opacity-20 p-4 rounded-full">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-primary to-primary-dark rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-all transform hover:scale-105">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-100 text-sm font-medium">Selesai</p>
                                    <p class="text-4xl font-bold mt-2">{{ $completedOrderCount }}</p>
                                    <p class="text-green-100 text-xs mt-1">pesanan</p>
                                </div>
                                <div class="bg-white bg-opacity-20 p-4 rounded-full">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Orders List (Dynamic) -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between space-y-3 sm:space-y-0">
                                <h3 class="text-xl font-bold text-gray-800">Daftar Pesanan Terakhir</h3>
                                <div class="flex space-x-2">
                                    <a href="{{ route('user.transactions.index') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-all text-sm font-semibold">
                                        Lihat Semua
                                    </a>
                                </div>
                            </div>
                        </div>
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
                            <div class="p-6 text-center text-gray-500">Belum ada pesanan terbaru.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Notifikasi Section -->
                <div id="section-notifikasi" class="content-section hidden">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-primary to-primary-dark">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-bold text-white">Notifikasi</h3>
                                <button class="text-white hover:text-green-100 text-sm font-semibold flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Tandai Semua Dibaca</span>
                                </button>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @forelse($notifications as $notification)
                            <div class="p-6 hover:bg-gray-50 bg-green-50 transition-colors">
                                <div class="flex items-start space-x-4">
                                    <div class="bg-gradient-to-br from-primary to-primary-dark text-white p-4 rounded-xl shadow-md">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-1">
                                            <h4 class="font-bold text-gray-800 text-lg">{{ $notification->data['title'] ?? 'Notifikasi' }}</h4>
                                            <span class="text-xs text-gray-500 ml-2">{{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-600 text-sm leading-relaxed">{{ $notification->data['message'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="p-6 text-center text-gray-500">Belum ada notifikasi.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Riwayat Transaksi Section -->
                <div id="section-transaksi" class="content-section hidden">
                    <!-- Summary Card -->
                    <div class="bg-gradient-to-r from-primary to-primary-dark rounded-xl shadow-lg mb-6 p-8 text-white">
                        <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0">
                            <div>
                                <h3 class="text-2xl font-bold mb-2">Ringkasan Transaksi</h3>
                                <p class="text-green-100">Total Pengeluaran Anda</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                            <div class="bg-white bg-opacity-20 rounded-lg p-5 backdrop-blur-sm">
                                <p class="text-green-100 text-sm font-medium mb-2">Total Transaksi</p>
                                <p class="text-4xl font-bold">{{ $transactions->count() }}</p>
                                <p class="text-green-100 text-xs mt-1">transaksi</p>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-lg p-5 backdrop-blur-sm">
                                <p class="text-green-100 text-sm font-medium mb-2">Total Belanja</p>
                                <p class="text-4xl font-bold">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
                                <p class="text-green-100 text-xs mt-1">semua waktu</p>
                            </div>
                        </div>
                    </div>

                    <!-- Transaction List -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between space-y-3 sm:space-y-0">
                                <h3 class="text-xl font-bold text-gray-800">Riwayat Transaksi</h3>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @forelse($transactions as $transaction)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col lg:flex-row lg:items-center justify-between space-y-3 lg:space-y-0">
                                    <div class="flex items-start space-x-4">
                                        <div class="bg-gradient-to-br from-primary to-primary-dark p-4 rounded-xl shadow-md">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                             </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-800 text-lg">Pembelian Produk</p>
                                            <p class="text-sm text-gray-600 mt-1">{{ $transaction->created_at->format('d F Y • H:i') }} WIB</p>
                                            <p class="text-sm text-gray-600">Pesanan #{{ $transaction->id }}</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end space-y-2">
                                        <p class="text-2xl font-bold text-primary">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full font-semibold">{{ ucfirst($transaction->status) }}</span>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="p-6 text-center text-gray-500">Belum ada riwayat transaksi.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Help Desk Section -->
                <div id="section-helpdesk" class="content-section hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Contact Options -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Quick Help -->
                            <div class="bg-gradient-to-r from-primary to-primary-dark rounded-xl shadow-lg p-8 text-white">
                                <h3 class="text-2xl font-bold mb-2">Butuh Bantuan?</h3>
                                <p class="text-green-100 mb-6">Tim kami siap membantu Anda 24/7</p>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <button class="bg-white text-primary p-4 rounded-lg hover:shadow-xl transition-all flex flex-col items-center space-y-2 font-semibold">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Email</span>
                                    </button>
                                    <button class="bg-white text-primary p-4 rounded-lg hover:shadow-xl transition-all flex flex-col items-center space-y-2 font-semibold">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>Telepon</span>
                                    </button>
                                    <button class="bg-white text-primary p-4 rounded-lg hover:shadow-xl transition-all flex flex-col items-center space-y-2 font-semibold">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                        <span>Live Chat</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Contact Form -->
                            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                                <h3 class="text-xl font-bold text-gray-800 mb-6">Kirim Pesan</h3>
                                <form class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Subjek *</label>
                                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Masukkan subjek pesan">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori *</label>
                                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                            <option>Pilih kategori</option>
                                            <option>Masalah Pembayaran</option>
                                            <option>Masalah Pengiriman</option>
                                            <option>Masalah Produk</option>
                                            <option>Pertanyaan Umum</option>
                                            <option>Lainnya</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan *</label>
                                        <textarea rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Deskripsikan masalah Anda..."></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Lampiran</label>
                                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors cursor-pointer">
                                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                            <p class="text-gray-600 text-sm">Klik untuk upload atau drag & drop</p>
                                            <p class="text-gray-400 text-xs mt-1">PNG, JPG, PDF (max. 5MB)</p>
                                        </div>
                                    </div>
                                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-primary to-primary-dark text-white rounded-lg hover:shadow-lg font-semibold transition-all transform hover:scale-105">
                                        Kirim Pesan
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- FAQ & Info -->
                        <div class="space-y-6">
                            <!-- FAQ -->
                            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center space-x-2">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>FAQ</span>
                                </h3>
                                <div class="space-y-3">
                                    <details class="group">
                                        <summary class="flex items-center justify-between cursor-pointer p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                            <span class="font-semibold text-gray-700 text-sm">Bagaimana cara melacak pesanan?</span>
                                            <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </summary>
                                        <p class="mt-3 text-sm text-gray-600 px-3">Anda dapat melacak pesanan melalui menu "Pesanan Saya" atau melalui link tracking yang dikirim via email.</p>
                                    </details>
                                    <details class="group">
                                        <summary class="flex items-center justify-between cursor-pointer p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                            <span class="font-semibold text-gray-700 text-sm">Berapa lama proses pengiriman?</span>
                                            <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </summary>
                                        <p class="mt-3 text-sm text-gray-600 px-3">Pengiriman biasanya memakan waktu 2-3 hari kerja untuk area Jabodetabek dan 3-5 hari untuk luar kota.</p>
                                    </details>
                                    <details class="group">
                                        <summary class="flex items-center justify-between cursor-pointer p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                            <span class="font-semibold text-gray-700 text-sm">Bagaimana cara pembatalan pesanan?</span>
                                            <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </summary>
                                        <p class="mt-3 text-sm text-gray-600 px-3">Pembatalan dapat dilakukan melalui menu pesanan selama status masih "Menunggu Pembayaran" atau "Diproses".</p>
                                    </details>
                                    <details class="group">
                                        <summary class="flex items-center justify-between cursor-pointer p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                            <span class="font-semibold text-gray-700 text-sm">Metode pembayaran apa saja?</span>
                                            <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </summary>
                                        <p class="mt-3 text-sm text-gray-600 px-3">Kami menerima transfer bank, kartu kredit/debit, e-wallet, dan COD untuk area tertentu.</p>
                                    </details>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Kontak</h3>
                                <div class="space-y-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="bg-green-100 p-2 rounded-lg">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-700">Email</p>
                                            <p class="text-sm text-gray-600">support@mydashboard.com</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <div class="bg-green-100 p-2 rounded-lg">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-700">Telepon</p>
                                            <p class="text-sm text-gray-600">+62 21 1234 5678</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <div class="bg-green-100 p-2 rounded-lg">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-700">Jam Operasional</p>
                                            <p class="text-sm text-gray-600">24/7 (Setiap Hari)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Response Time -->
                            <div class="bg-gradient-to-br from-primary to-primary-dark rounded-xl shadow-lg p-6 text-white text-center">
                                <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                <h4 class="text-lg font-bold mb-2">Respon Cepat</h4>
                                <p class="text-green-100 text-sm">Rata-rata waktu respon kami adalah 2-3 jam</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Navigation Functions
        function showSection(section) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(el => {
                el.classList.add('hidden');
            });
            
            // Show selected section
            document.getElementById('section-' + section).classList.remove('hidden');
            
            // Update active nav item
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('bg-primary', 'text-white');
                item.classList.add('text-gray-700');
            });
            event.currentTarget.classList.add('bg-primary', 'text-white');
            event.currentTarget.classList.remove('text-gray-700');
            
            // Update page title
            const titles = {
                'profil': { title: 'Edit Profil', subtitle: 'Kelola informasi profil Anda' },
                'pesanan': { title: 'Pesanan Saya', subtitle: 'Lihat dan kelola pesanan Anda' },
                'notifikasi': { title: 'Notifikasi & Promo', subtitle: 'Lihat semua notifikasi dan promo terbaru' },
                'transaksi': { title: 'Riwayat Transaksi', subtitle: 'Lihat semua transaksi Anda' },
                'helpdesk': { title: 'Help Desk', subtitle: 'Hubungi kami untuk bantuan' }
            };
            
            document.getElementById('page-title').textContent = titles[section].title;
            document.getElementById('page-subtitle').textContent = titles[section].subtitle;
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        function logout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                window.location.href = "{{ route('logout') }}";
            }
        }

        // Mobile responsive
        if (window.innerWidth < 1024) {
            document.getElementById('sidebar').classList.add('-translate-x-full');
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                document.getElementById('sidebar').classList.remove('-translate-x-full');
            }
        });
    </script>
</body>
</html>