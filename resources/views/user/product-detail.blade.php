@extends("user.layouts.master-layouts.plain")

<title>Home Collection | Product Deatil </title>

<meta name="csrf-token" content="{{ csrf_token() }}">

@push("style")
<style>
        :root {
            --primary-color: #8B5FBF;      /* Elegant purple */
            --primary-hover: #7A4DA6;
            --secondary-color: #D4AF37;    /* Gold accent */
            --secondary-hover: #C19B2E;
            --accent-color: #2E8B57;       /* Sea green */
            --accent-hover: #267349;
            --text-on-primary: #FFFFFF;
            --text-on-secondary: #000000;
        }

        body {
            background: #FAFAFA;
            font-family: 'Inter', sans-serif;
            color: #333;
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--text-on-primary);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 95, 191, 0.3);
        }

        .btn-secondary {
            background: var(--secondary-color);
            color: var(--text-on-secondary);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--secondary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }

        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .color-option {
            transition: all 0.3s ease;
        }

        .color-option:hover {
            transform: scale(1.1);
            border-color: var(--primary-color);
        }

        .size-option {
            transition: all 0.3s ease;
        }

        .size-option:hover {
            background-color: var(--primary-color);
            color: var(--text-on-primary);
        }

        #main-image {
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
        }

        #main-image:hover {
            transform: scale(1.02);
        }

        header {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush


@section("content")

    <!-- Product Section -->
    <div class="container mx-auto px-4 py-10">
        <div class="flex flex-col md:flex-row gap-10">
            <!-- Images -->
            <div class="md:w-1/2">
                <div class="bg-white rounded-xl overflow-hidden mb-6">
                    <img id="main-image" src="" alt="Product Image" class="w-full h-auto object-cover">
                </div>
                <div class="grid grid-cols-4 gap-3" id="thumbnails-container"></div>
            </div>

            <!-- Info -->
            <div class="md:w-1/2">
                <div class="mb-6">
                    <h1 id="product-name" class="text-4xl font-bold text-gray-900 mb-3"></h1>
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400" id="rating-stars"></div>
                        <span id="review-count" class="ml-2 text-gray-600 text-sm"></span>
                    </div>
                    <p id="product-price" class="text-3xl font-semibold text-[var(--primary-color)] mb-4"></p>
                    <p id="product-description" class="text-gray-700 leading-relaxed"></p>
                </div>

                <!-- Colors -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">
                        Color: <span id="selected-color" class="font-normal text-gray-600">Select a color</span>
                    </h3>
                    <div class="flex flex-wrap gap-3" id="color-options"></div>
                </div>

                <!-- Sizes -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Size:</h3>
                    <div class="flex flex-wrap gap-3" id="size-options">
                        
                    </div>
                </div>

                <!-- Quantity + Buttons -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <span class="mr-4 text-gray-800 font-medium">Quantity:</span>
                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                            <button class="px-3 py-2 hover:bg-gray-100" id="decrease-qty">-</button>
                            <span class="px-5 py-2 font-medium" id="quantity">1</span>
                            <button class="px-3 py-2 hover:bg-gray-100" id="increase-qty">+</button>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button id="add-to-cart" class="btn-primary py-3 px-6 rounded-md font-medium flex items-center justify-center w-full">
                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        </button>
                        <button id="buy-now" class="btn-secondary py-3 px-6 rounded-md font-medium w-full">
                            Buy Now
                        </button>
                    </div>
                </div>

    
            </div>
        </div>
    </div>

    <section id="reviews" class="py-24 border-t border-[var(--border-color)] bg-[var(--background-color)]">
    <div class="container mx-auto px-6 max-w-7xl">
        
        <div class="flex items-end gap-4 mb-12 border-b border-[var(--border-color)] pb-6">
            <h3 class="text-4xl font-['Outfit'] font-bold text-[var(--primary-color)]">
                Reviews
            </h3>
            <span class="text-xl text-[var(--accent-color)] font-medium mb-1">
                {{ $product->reviews->count() }} Verified Feedback
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            <div class="lg:col-span-7 space-y-8">
                @forelse($product->reviews as $review)
                    <div class="group relative bg-white p-8 rounded-3xl shadow-sm border border-[var(--border-color)] hover:shadow-md transition-all duration-300">
                        <div class="absolute top-0 right-0 bg-[var(--secondary-color)] text-white text-[10px] font-bold px-3 py-1 rounded-bl-xl rounded-tr-3xl uppercase tracking-widest">
                            Verified Owner
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-[var(--primary-color)] text-[var(--secondary-color)] flex items-center justify-center text-lg font-bold shadow-inner">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-2">
                                    <h5 class="font-bold text-lg text-[var(--primary-color)] font-['Outfit']">{{ $review->user->name }}</h5>
                                    <span class="text-xs text-gray-400 font-medium">{{ $review->created_at->format('M d, Y') }}</span>
                                </div>

                                <div class="flex text-[var(--secondary-color)] text-sm mb-3">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-gray-200' }}"></i>
                                    @endfor
                                </div>
                                
                                <p class="text-[var(--text-on-secondary)]/80 leading-relaxed text-base">
                                    "{{ $review->comment }}"
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white/50 rounded-3xl border-2 border-dashed border-[var(--border-color)]">
                        <p class="text-[var(--accent-color)] font-medium">No reviews yet. Be the first to verify quality.</p>
                    </div>
                @endforelse
            </div>

            <div class="lg:col-span-5">
                <div class="sticky top-24">
                    
                    @auth
                        @if($product->currentUserHasPurchased())
                            @if(!$product->currentUserHasReviewed())
                                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl border border-[var(--border-color)] relative overflow-hidden">
                                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[var(--primary-color)] to-[var(--secondary-color)]"></div>
                                    
                                    <h4 class="text-2xl font-bold text-[var(--primary-color)] mb-2 font-['Outfit']">Rate & Review</h4>
                                    <p class="text-sm text-gray-500 mb-8">How was your experience with this item?</p>

                                    <form action="{{ route('review.store', $product->id) }}" method="POST" x-data="{ rating: 0, hoverRating: 0 }">
                                        @csrf
                                        
                                        <div class="mb-8 text-center">
                                            <div class="inline-flex gap-2 cursor-pointer" @mouseleave="hoverRating = 0">
                                                <template x-for="i in 5">
                                                    <i class="fas fa-star text-3xl transition-transform duration-200"
                                                       :class="(hoverRating >= i || rating >= i) ? 'text-[var(--secondary-color)] scale-110 drop-shadow-sm' : 'text-gray-200'"
                                                       @mouseover="hoverRating = i"
                                                       @click="rating = i">
                                                    </i>
                                                </template>
                                            </div>
                                            <input type="hidden" name="rating" :value="rating" required>
                                            <p class="text-xs text-gray-400 mt-2 font-medium">Click to rate</p>
                                        </div>

                                        <div class="mb-6">
                                            <textarea name="comment" rows="4" required
                                                class="w-full bg-[var(--background-color)] border border-[var(--border-color)] rounded-xl p-4 focus:outline-none focus:border-[var(--secondary-color)] focus:ring-1 focus:ring-[var(--secondary-color)] transition-all resize-none text-[var(--primary-color)] placeholder-gray-400"
                                                placeholder="Write your thoughts here..."></textarea>
                                        </div>

                                        <button type="submit" 
                                            class="w-full py-4 bg-[var(--primary-color)] text-white rounded-xl font-bold tracking-wide hover:bg-[var(--primary-hover)] transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                                            PUBLISH REVIEW
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="bg-[#F0FDF4] p-8 rounded-[2rem] border border-green-200 text-center">
                                    <div class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4 text-green-600">
                                        <i class="fas fa-check text-2xl"></i>
                                    </div>
                                    <h4 class="text-xl font-bold text-green-800">Review Submitted</h4>
                                    <p class="text-green-600 mt-2">Thank you for sharing your feedback!</p>
                                </div>
                            @endif

                        @else
                            <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-200 text-center opacity-80">
                                <div class="w-16 h-16 mx-auto bg-gray-200 rounded-full flex items-center justify-center mb-4 text-gray-400">
                                    <i class="fas fa-lock text-2xl"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-800 mb-2">Verified Purchase Only</h4>
                                <p class="text-gray-500 text-sm">You must have this item delivered to your address to verify quality before reviewing.</p>
                            </div>
                        @endif

                    @else
                        <div class="bg-[var(--primary-color)] p-10 rounded-[2.5rem] shadow-2xl text-center relative overflow-hidden group">
                            <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                            
                            <div class="relative z-10">
                                <h4 class="text-2xl font-bold text-white mb-3 font-['Outfit']">Join the Conversation</h4>
                                <p class="text-white/70 text-sm mb-8 leading-relaxed">Login to verify your purchase and help others make the right choice.</p>
                                
                                <a href="{{ route('user.login') }}" class="block w-full py-4 bg-white text-[var(--primary-color)] rounded-xl font-bold hover:bg-[var(--secondary-color)] hover:text-white transition-all duration-300 shadow-lg">
                                    LOGIN TO REVIEW
                                </a>
                            </div>
                        </div>
                    @endauth

                </div>
            </div>

        </div>
    </div>
</section>



@endsection


@push("script")
<script>
    const product = @json($product);

    let selectedColor = null;
    let selectedSize = null;
    let quantity = 1;

    const BASE_URL = window.location.origin; // e.g. http://127.0.0.1:8000

    document.addEventListener('DOMContentLoaded', initializeProductPage);

    function initializeProductPage() {
        document.getElementById('product-name').textContent = product.name;
        document.getElementById('product-price').textContent = `${product.price} PKR`;
        document.getElementById('product-description').textContent = product.description || "No description available.";

        if (product.review_count) {
            document.getElementById('review-count').textContent = `(${product.review_count} reviews)`;
        }

        generateColorOptions();
        generateSizeOptions();
        updateProductImages();

        document.getElementById('add-to-cart').addEventListener('click', addToCart);
        document.getElementById('buy-now').addEventListener('click', buyNow);
        document.getElementById('increase-qty').addEventListener('click', increaseQuantity);
        document.getElementById('decrease-qty').addEventListener('click', decreaseQuantity);
    }

    function generateColorOptions() {
        const container = document.getElementById('color-options');
        if (!container) return;
        container.innerHTML = '';

        if (!product.colors.length) return;

        product.colors.forEach(color => {
            const colorDiv = document.createElement('div');
            colorDiv.className = `color-option w-10 h-10 rounded-full cursor-pointer border border-brown-300`;
            colorDiv.style.backgroundColor = color.hex_code || '#ccc';
            colorDiv.dataset.colorId = color.id;
            colorDiv.title = color.name;

            colorDiv.addEventListener('click', () => selectColor(color));
            container.appendChild(colorDiv);
        });

        selectedColor = null;
        document.getElementById('selected-color').textContent = 'Select a color';
    }

    function selectColor(color) {
        selectedColor = color;
        document.getElementById('selected-color').textContent = color.name;

        const colorOptions = document.querySelectorAll('.color-option');
        colorOptions.forEach(option => {
            option.classList.remove('border-2', 'border-brown-600');
            option.classList.add('border', 'border-brown-300');
        });

        const selectedOption = document.querySelector(`.color-option[data-color-id="${color.id}"]`);
        selectedOption.classList.remove('border', 'border-brown-300');
        selectedOption.classList.add('border-2', 'border-brown-600');

        updateProductImages();
    }

    function generateSizeOptions() {
        const container = document.getElementById('size-options');
        if (!container) return;
        container.innerHTML = '';

        if (!product.sizes.length) return;

        product.sizes.forEach(size => {
            const btn = document.createElement('button');
            btn.className = `size-option border px-4 py-2 rounded hover:border-brown-600 border-brown-300`;
            btn.textContent = size.name;
            btn.dataset.sizeId = size.id;

            btn.addEventListener('click', () => selectSize(size));
            container.appendChild(btn);
        });

        selectedSize = null;
    }

    function selectSize(size) {
    selectedSize = size;

    const sizeOptions = document.querySelectorAll('.size-option');
    sizeOptions.forEach(option => {
        option.classList.remove('border-brown-600', 'bg-brown-50');
        option.classList.add('border-brown-300');
    });

    const selectedOption = document.querySelector(`.size-option[data-size-id="${size.id}"]`);
    selectedOption.classList.remove('border-brown-300');
    selectedOption.classList.add('border-brown-600', 'bg-brown-50');

    const priceElement = document.getElementById('product-price');
    if (size.price) {
        priceElement.textContent = `${size.price} PKR`;
    } else {
        priceElement.textContent = `${product.price} PKR`;
    }
}


    // ---------------- IMAGES ----------------
    function updateProductImages() {
    const mainImage = document.getElementById('main-image');
    const thumbnailsContainer = document.getElementById('thumbnails-container');
    thumbnailsContainer.innerHTML = '';

    let imagesToShow = [];

    if (selectedColor?.images?.length) {
        imagesToShow = selectedColor.images;
    } else if (product.images?.length) {
        imagesToShow = product.images;
    } else {
        imagesToShow = ['/images/placeholder.png'];
    }

    const baseUrl = window.location.origin + (window.location.pathname.includes('/homeCollection') ? '/homeCollection' : '');
    imagesToShow = imagesToShow.map(imgObj => {
    let imgPath = typeof imgObj === 'string' ? imgObj : imgObj.image_path;

    if (!imgPath.startsWith('/storage')) {
        imgPath = '/storage/' + imgPath.replace(/^\/?products\//, 'products/');
    }

    return window.location.origin + imgPath;
});


    console.log('Loaded images:', imagesToShow);

    mainImage.src = imagesToShow[0];
    mainImage.alt = `${product.name}${selectedColor ? ` - ${selectedColor.name}` : ''}`;

    imagesToShow.forEach((img, index) => {
        const thumbDiv = document.createElement('div');
        thumbDiv.className = `border ${index === 0 ? 'border-2 border-brown-600' : 'border-brown-200'} rounded overflow-hidden`;

        const thumbImg = document.createElement('img');
        thumbImg.src = img;
        thumbImg.alt = `${product.name} image ${index + 1}`;
        thumbImg.className = 'w-full h-20 object-cover cursor-pointer';

        thumbImg.addEventListener('click', function() {
            changeMainImage(this.src);
            document.querySelectorAll('#thumbnails-container > div').forEach(div => {
                div.classList.remove('border-2', 'border-brown-600');
                div.classList.add('border', 'border-brown-200');
            });
            this.parentElement.classList.remove('border', 'border-brown-200');
            this.parentElement.classList.add('border-2', 'border-brown-600');
        });

        thumbDiv.appendChild(thumbImg);
        thumbnailsContainer.appendChild(thumbDiv);
    });
}

    function changeMainImage(src) {
        document.getElementById('main-image').src = src;
    }

    function increaseQuantity() {
        quantity++;
        document.getElementById('quantity').textContent = quantity;
    }

    function decreaseQuantity() {
        if (quantity > 1) {
            quantity--;
            document.getElementById('quantity').textContent = quantity;
        }
    }

    async function addToCart() {
    if (!selectedColor) {
        Swal.fire({
            icon: 'warning',
            title: 'Select a Color',
            text: 'Please select a color before adding to cart.',
        });
        return;
    }

    if (!selectedSize) {
        Swal.fire({
            icon: 'warning',
            title: 'Select a Size',
            text: 'Please select a size before adding to cart.',
        });
        return;
    }
    let guestToken = localStorage.getItem('guest_token');
    if (!guestToken) {
        guestToken = self.crypto.randomUUID();
        localStorage.setItem('guest_token', guestToken);
    }

    const cartItem = {
        product_id: product.id,
        color_id: selectedColor.id,
        size_id: selectedSize.id,
        quantity,
        price: product.price, 
        guest_token: guestToken,
    };

    try {
        const response = await fetch('/add-to-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(cartItem)
        });

        const data = await response.json();

        if (data.success) {
    console.log('Product has been added to cart');

    Swal.fire({
        icon: 'success',
        title: 'Added to Cart!',
        text: 'Click the button below to go to your cart.',
        confirmButtonText: 'Go to Cart',
        showCancelButton: true, // optional if you want a cancel button
        cancelButtonText: 'Continue Shopping'
    }).then((result) => {
        if (result.isConfirmed) {
            // User clicked "Go to Cart"
            window.location.href = '/cart';
        }
        // else user clicked cancel or closed the alert
    });
}


} else {
    Swal.fire({
        icon: 'error',
        title: 'Failed!',
        text: data.message || 'Something went wrong while adding to cart.',
    });
}

    } catch (error) {
        console.error(error);
        Swal.fire({
            icon: 'error',
            title: 'Server Error',
            text: 'Could not add product to cart. Please try again.',
        });
    }
}

async function buyNow() {
    if (!selectedColor) {
        Swal.fire('Oops!', 'Please select a color', 'warning');
        return;
    }
    if (!selectedSize) {
        Swal.fire('Oops!', 'Please select a size', 'warning');
        return;
    }

    const orderItem = {
        product_id: product.id,
        color_id: selectedColor.id,
        size_id: selectedSize.id,
        quantity: quantity,
        price: product.price // include price if needed
    };

    try {
        const response = await fetch('/buy-now', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(orderItem)
        });

        const data = await response.json();

        if (data.success) {

        // Redirect after alert closes
        window.location.href = '/checkout?source=buy_now';
} else {
    Swal.fire('Error', data.message || 'Something went wrong.', 'error');
}

    } catch (err) {
        console.error(err);
        Swal.fire('Server Error', 'Could not process your request.', 'error');
    }
}

</script>

@endpush


