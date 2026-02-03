<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
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
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="grid md:grid-cols-2 gap-8 p-8">
                <!-- Image Section -->
                <div class="space-y-4">
                    <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=600&fit=crop" 
                             alt="Produk" 
                             class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Product Info Section -->
                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Headphone Wireless Premium</h1>
                        <div class="flex items-center gap-2">
                            <div class="flex items-center" id="productRating">
                                <!-- Rating stars will be rendered here -->
                            </div>
                            <span class="text-gray-600 text-sm">(<span id="totalReviews">0</span> ulasan)</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi Produk</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Headphone wireless premium dengan kualitas suara Hi-Fi, dilengkapi dengan teknologi noise cancellation aktif. 
                            Baterai tahan hingga 30 jam, desain ergonomis yang nyaman dipakai seharian. 
                            Cocok untuk mendengarkan musik, gaming, atau conference call.
                        </p>
                    </div>

                    <!-- Price -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="text-sm text-gray-500 mb-1">Harga</div>
                        <div class="text-4xl font-bold text-primary">Rp 1.299.000</div>
                    </div>

                    <!-- Stock -->
                    <div class="flex items-center gap-2">
                        <span class="text-gray-700 font-medium">Stok:</span>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                            Tersedia (45 unit)
                        </span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button class="flex-1 bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                            Beli Sekarang
                        </button>
                        <button class="flex-1 border-2 border-primary text-primary hover:bg-primary hover:text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="border-t border-gray-200 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Ulasan Produk</h2>

                <!-- Add Review Form -->
                <div class="bg-gray-50 p-6 rounded-lg mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tulis Ulasan Anda</h3>
                    <form id="reviewForm" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                            <input type="text" 
                                   id="reviewerName" 
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="Masukkan nama Anda">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <div class="flex gap-2" id="ratingInput">
                                <span class="star cursor-pointer text-3xl text-gray-300 hover:text-yellow-400" data-rating="1">★</span>
                                <span class="star cursor-pointer text-3xl text-gray-300 hover:text-yellow-400" data-rating="2">★</span>
                                <span class="star cursor-pointer text-3xl text-gray-300 hover:text-yellow-400" data-rating="3">★</span>
                                <span class="star cursor-pointer text-3xl text-gray-300 hover:text-yellow-400" data-rating="4">★</span>
                                <span class="star cursor-pointer text-3xl text-gray-300 hover:text-yellow-400" data-rating="5">★</span>
                            </div>
                            <input type="hidden" id="selectedRating" value="0">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ulasan</label>
                            <textarea id="reviewText" 
                                      required
                                      rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                      placeholder="Ceritakan pengalaman Anda dengan produk ini..."></textarea>
                        </div>

                        <button type="submit" 
                                class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                            Kirim Ulasan
                        </button>
                    </form>
                </div>

                <!-- Reviews List -->
                <div class="space-y-4" id="reviewsList">
                    <!-- Reviews will be dynamically added here -->
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="text-center py-12 text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    <p class="text-lg">Belum ada ulasan untuk produk ini</p>
                    <p class="text-sm mt-2">Jadilah yang pertama memberikan ulasan!</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Review data storage
        let reviews = [];
        let selectedRating = 0;

        // Rating input functionality
        const stars = document.querySelectorAll('#ratingInput .star');
        stars.forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.rating);
                document.getElementById('selectedRating').value = selectedRating;
                updateStarDisplay(stars, selectedRating);
            });

            star.addEventListener('mouseenter', function() {
                const hoverRating = parseInt(this.dataset.rating);
                updateStarDisplay(stars, hoverRating);
            });
        });

        document.getElementById('ratingInput').addEventListener('mouseleave', function() {
            updateStarDisplay(stars, selectedRating);
        });

        function updateStarDisplay(starElements, rating) {
            starElements.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }

        // Render stars for display
        function renderStars(rating, size = 'text-base') {
            let starsHtml = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    starsHtml += `<span class="${size} text-yellow-400">★</span>`;
                } else {
                    starsHtml += `<span class="${size} text-gray-300">★</span>`;
                }
            }
            return starsHtml;
        }

        // Calculate average rating
        function calculateAverageRating() {
            if (reviews.length === 0) return 0;
            const sum = reviews.reduce((acc, review) => acc + review.rating, 0);
            return Math.round(sum / reviews.length);
        }

        // Update product rating display
        function updateProductRating() {
            const avgRating = calculateAverageRating();
            document.getElementById('productRating').innerHTML = renderStars(avgRating);
            document.getElementById('totalReviews').textContent = reviews.length;
        }

        // Render reviews
        function renderReviews() {
            const reviewsList = document.getElementById('reviewsList');
            const emptyState = document.getElementById('emptyState');

            if (reviews.length === 0) {
                emptyState.classList.remove('hidden');
                reviewsList.innerHTML = '';
                return;
            }

            emptyState.classList.add('hidden');
            
            reviewsList.innerHTML = reviews.map(review => `
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h4 class="font-semibold text-gray-900">${review.name}</h4>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex">${renderStars(review.rating, 'text-sm')}</div>
                                <span class="text-sm text-gray-500">${review.date}</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed">${review.text}</p>
                </div>
            `).join('');
        }

        // Handle form submission
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('reviewerName').value;
            const rating = parseInt(document.getElementById('selectedRating').value);
            const text = document.getElementById('reviewText').value;

            if (rating === 0) {
                alert('Silakan pilih rating terlebih dahulu!');
                return;
            }

            // Add review
            const review = {
                name: name,
                rating: rating,
                text: text,
                date: new Date().toLocaleDateString('id-ID', { 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                })
            };

            reviews.unshift(review);

            // Reset form
            this.reset();
            selectedRating = 0;
            updateStarDisplay(stars, 0);

            // Update UI
            renderReviews();
            updateProductRating();

            // Show success message
            alert('Terima kasih! Ulasan Anda telah ditambahkan.');
        });

        // Initialize
        updateProductRating();
        renderReviews();
    </script>
</body>
</html>