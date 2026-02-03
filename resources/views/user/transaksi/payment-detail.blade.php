<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran - Healthy Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10B981',
                        'primary-dark': '#059669',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Pembayaran</h1>
                <p class="text-gray-600 mt-2">Selesaikan pembayaran untuk Transaksi #{{ $transaction->id }}</p>
            </div>
            <a href="{{ route('user.transactions.show', $transaction->id) }}" class="text-primary hover:text-primary-dark font-medium">Kembali</a>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Produk yang Dibeli -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Produk</h2>
                    <div class="space-y-4">
                        @foreach($transaction->items as $item)
                        <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg">
                            <div class="w-20 h-20 bg-gray-100 rounded flex items-center justify-center overflow-hidden">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Metode Pembayaran</h2>
                    
                    <div class="space-y-3">
                        <!-- Bank Transfer -->
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary transition duration-200">
                            <input type="radio" name="paymentMethod" value="bank" onchange="selectPaymentMethod('bank')" class="w-5 h-5 text-primary focus:ring-primary">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-900">Transfer Bank</p>
                                        <p class="text-sm text-gray-500">BCA, Mandiri, BNI, BRI</p>
                                    </div>
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                            </div>
                        </label>

                        <!-- COD -->
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary transition duration-200">
                            <input type="radio" name="paymentMethod" value="cod" onchange="selectPaymentMethod('cod')" class="w-5 h-5 text-primary focus:ring-primary">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-900">COD (Bayar di Tempat)</p>
                                        <p class="text-sm text-gray-500">Bayar saat barang diterima</p>
                                    </div>
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </label>

                        <!-- QRIS -->
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary transition duration-200">
                            <input type="radio" name="paymentMethod" value="qris" onchange="selectPaymentMethod('qris')" class="w-5 h-5 text-primary focus:ring-primary">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-900">QRIS</p>
                                        <p class="text-sm text-gray-500">Scan QR untuk bayar</p>
                                    </div>
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Kode Diskon -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Kode Diskon</h2>
                    <div class="flex gap-2">
                        <input type="text" id="discountCode" 
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Masukkan kode diskon">
                        <button onclick="applyDiscount()" 
                                class="bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                            Terapkan
                        </button>
                    </div>
                    <div id="discountMessage" class="mt-2 text-sm hidden"></div>
                </div>

            </div>

            <!-- Ringkasan Pesanan (Sidebar) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pembayaran</h2>
                    
                    <div class="space-y-3 border-b border-gray-200 pb-4 mb-4">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Transaksi</span>
                            <span>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div id="discountRow" class="hidden flex justify-between text-primary">
                            <span>Diskon (<span id="discountPercentage">0</span>%)</span>
                            <span id="summaryDiscount">- Rp 0</span>
                        </div>
                    </div>

                    <div class="flex justify-between text-lg font-bold text-gray-900 mb-6">
                        <span>Total Bayar</span>
                            <!-- Convert PHP total to JS variable for dynamic discount calc -->
                        <span id="summaryTotal" class="text-primary" data-original="{{ $transaction->total_price }}">
                            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                        </span>
                    </div>

                    <button onclick="processPayment()" 
                            class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-lg transition duration-200 shadow-lg">
                        Konfirmasi Pembayaran
                    </button>

                    <div class="mt-4 flex items-center justify-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                        Pembayaran Aman
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedPaymentMethod = null;
        let discountPercentage = 0;
        const originalTotal = {{ $transaction->total_price }};

        // Valid discount codes
        const discountCodes = {
            'DISKON10': 10,
            'DISKON20': 20,
            'PROMO50': 50
        };

        // Select payment method
        function selectPaymentMethod(method) {
            selectedPaymentMethod = method;
        }

        // Apply discount
        function applyDiscount() {
            const code = document.getElementById('discountCode').value.trim().toUpperCase();
            const messageDiv = document.getElementById('discountMessage');
            
            if (discountCodes[code]) {
                discountPercentage = discountCodes[code];
                messageDiv.className = 'mt-2 text-sm text-primary';
                messageDiv.textContent = `✓ Diskon ${discountPercentage}% berhasil diterapkan!`;
                messageDiv.classList.remove('hidden');
            } else if (code === '') {
                messageDiv.className = 'mt-2 text-sm text-gray-500';
                messageDiv.textContent = 'Masukkan kode diskon';
                messageDiv.classList.remove('hidden');
                discountPercentage = 0;
            } else {
                messageDiv.className = 'mt-2 text-sm text-red-600';
                messageDiv.textContent = '✗ Kode diskon tidak valid';
                messageDiv.classList.remove('hidden');
                discountPercentage = 0;
            }
            
            updateSummary();
        }

        // Update summary
        function updateSummary() {
            const discount = Math.floor(originalTotal * (discountPercentage / 100));
            const total = originalTotal - discount;

            document.getElementById('summaryTotal').textContent = `Rp ${total.toLocaleString('id-ID')}`;

            const discountRow = document.getElementById('discountRow');
            if (discountPercentage > 0) {
                discountRow.classList.remove('hidden');
                document.getElementById('discountPercentage').textContent = discountPercentage;
                document.getElementById('summaryDiscount').textContent = `- Rp ${discount.toLocaleString('id-ID')}`;
            } else {
                discountRow.classList.add('hidden');
            }
        }

        // Process Payment
        function processPayment() {
            if (!selectedPaymentMethod) {
                alert('Silakan pilih metode pembayaran terlebih dahulu!');
                return;
            }

            const totalEl = document.getElementById('summaryTotal').textContent;
            
            // Show confirmation
            const confirmation = confirm(
                `Konfirmasi Pembayaran\n\n` +
                `Total Bayar: ${totalEl}\n` +
                `Metode: ${selectedPaymentMethod.toUpperCase()}\n\n` +
                `Lanjutkan?`
            );

            if (confirmation) {
                alert('Pembayaran Berhasil! Terima kasih.');
                window.location.href = "{{ route('user.transactions.index') }}";
            }
        }
    </script>
</body>
</html>