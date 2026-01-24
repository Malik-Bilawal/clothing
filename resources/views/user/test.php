@extends("user.layouts.master-layouts.plain")

<title>Inhouse Textiles | Product Detail </title>



@push("style")
<style>
        :root {
            --primary-color: #680626;      /* Dark Maroon */
            --primary-hover: #52041E;
            --secondary-color: #B89A6B;    /* Warm Brown */
            --secondary-hover: #967B52;
            --accent-color: #D6CEC3;       /* Warm Greige */
            --accent-hover: #C8BFB3;
            --text-on-primary: #FFFFFF;
            --text-on-secondary: #2A2A2A;
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
                    <div class="flex flex-wrap gap-3" id="size-options"></div>
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

                <!-- Details -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Product Details</h3>
                    <ul id="product-details" class="list-disc pl-5 text-gray-700 space-y-2"></ul>
                </div>
            </div>
        </div>
    </div>
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
    console.log(' Product has been added to cart');
    
    Swal.fire({
        icon: 'success',
        title: 'Added to Cart!',
        text: 'Product successfully added to your cart.',
        timer: 1500,
        showConfirmButton: false
    }).then(() => {
        console.log('🛒 Redirecting to cart page...');
        window.location.href = '/cart'; // Better than window.open for UX
    });

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


