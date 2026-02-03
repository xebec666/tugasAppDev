<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - Healthy Store</title>
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
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
                <p class="text-gray-600 mt-2">Selesaikan pesanan Anda</p>
            </div>
            <a href="{{ route('home') }}" class="text-primary hover:text-primary-dark font-medium">Kembali ke Beranda</a>
        </div>

        <form id="checkoutForm" action="{{ route('user.transactions.store') }}" method="POST" onsubmit="prepareCheckout(event)">
            @csrf
            <!-- Hidden input to store cart data -->
            <input type="hidden" name="cart_data" id="cartDataInput">

            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Produk yang Dibeli -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Produk dalam Keranjang</h2>
                        <div id="checkoutCartItems" class="space-y-4">
                            <!-- Items will be injected by JS -->
                        </div>
                    </div>

                    <!-- Alamat Pengiriman -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Pengiriman</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                                <input type="text" name="receiver_name" value="{{ Auth::user()->name }}" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="tel" name="receiver_phone" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                <textarea name="shipping_address" rows="3" required
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Ringkasan Pesanan (Sidebar) -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm p-6 sticky top-4">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pembayaran</h2>
                        
                        <div class="space-y-3 border-b border-gray-100 pb-4 mb-4">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span id="summarySubtotal">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Pajak (11%)</span>
                                <span id="summaryTax">Rp 0</span>
                            </div>
                        </div>

                        <div class="flex justify-between text-xl font-bold text-gray-900 mb-6">
                            <span>Total</span>
                            <span id="summaryTotal" class="text-primary">Rp 0</span>
                        </div>

                        <button type="submit" 
                                class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-4 px-6 rounded-xl transition shadow-lg hover:shadow-xl transform active:scale-95">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Load cart from localStorage
        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        function renderCheckoutItems() {
            const container = document.getElementById('checkoutCartItems');
            const subtotalEl = document.getElementById('summarySubtotal');
            const taxEl = document.getElementById('summaryTax');
            const totalEl = document.getElementById('summaryTotal');

            if (cart.length === 0) {
                container.innerHTML = '<p class="text-gray-500 text-center py-4">Keranjang kosong. Silakan belanja terlebih dahulu.</p>';
                // Optional: redirect back to home
                return;
            }

            let subtotal = 0;
            container.innerHTML = cart.map(item => {
                subtotal += item.price * item.quantity;
                return `
                <div class="flex items-center gap-4 p-4 border border-gray-100 rounded-lg bg-gray-50">
                    <div class="w-20 h-20 bg-white rounded-md flex items-center justify-center overflow-hidden border border-gray-200">
                        ${item.image ? `<img src="${item.image}" class="w-full h-full object-cover">` : 
                        `<svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>`}
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">${item.name}</h3>
                        <p class="text-sm text-gray-600">Jumlah: ${item.quantity}</p>
                        <p class="text-primary font-bold">Rp ${item.price.toLocaleString('id-ID')}</p>
                    </div>
                </div>
                `;
            }).join('');

            const tax = subtotal * 0.11;
            const total = subtotal + tax;

            subtotalEl.innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
            taxEl.innerText = 'Rp ' + tax.toLocaleString('id-ID');
            totalEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        function prepareCheckout(event) {
            if (cart.length === 0) {
                event.preventDefault();
                alert('Keranjang belanja kosong!');
                return;
            }
            // Put cart data into hidden input
            document.getElementById('cartDataInput').value = JSON.stringify(cart);
            
            // Allow form submission...
            // After submission, we might want to clear cart, but since PHP handles the redirect, 
            // we can clear it on the success page or here if we use AJAX. 
            // For standard form post, we can't easily clear it *after* success unless we utilize session flash checking on next page load.
            // For now, let's keep it simple.
            localStorage.removeItem('cart'); // Optimistic clear
        }

        document.addEventListener('DOMContentLoaded', renderCheckoutItems);
    </script>
</body>
</html>
