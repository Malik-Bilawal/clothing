@extends("user.layouts.master-layouts.plain")
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Home Collection | Premium Products</title>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

<style>
:root {
    --primary-color: #6B4226;      
    --primary-hover: #593721;       
    --secondary-color: #C8A165;     
    --secondary-hover: #B58F54;     
    --accent-color: #8C5E3C;       
    --accent-hover: #734C30;        
    --text-on-primary: #FFFFFF;     
    --text-on-secondary: #1A1A1A;   
    --background-color: #F8F5F2;   
    --surface-color: #FFFFFF;      
    --border-color: #E5D5C3;
}

body {
  font-family: 'Inter', sans-serif;
  color: var(--text-on-secondary); 
  overflow-x: hidden;
  background-color: var(--background-color);
}

.filter-sidebar.active {
  left: 0;
}

.overlay.active {
  opacity: 1;
  visibility: visible;
}

.loading-spinner.active {
  display: block;
}

.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* --- SVG Wave Colors --- */
#grad1 stop[offset="0%"] { stop-color: var(--primary-color); }
#grad1 stop[offset="50%"] { stop-color: var(--secondary-color); }
#grad1 stop[offset="100%"] { stop-color: var(--accent-color); }

#grad2 stop[offset="0%"] { stop-color: var(--accent-color); }
#grad2 stop[offset="50%"] { stop-color: var(--secondary-color); }
#grad2 stop[offset="100%"] { stop-color: var(--primary-color); }
</style>

@section("content")

<section
  class="relative overflow-hidden flex items-center justify-center text-white min-h-[50vh] md:h-[80vh]">
  <div
    class="absolute inset-0 bg-gradient-to-r from-[var(--primary-color)] via-[var(--secondary-color)] to-[var(--accent-color)] animate-gradient [background-size:200%_200%]">
  </div>
  <div
    class="absolute -top-40 -left-20 w-[400px] h-[400px] bg-[var(--accent-color)] opacity-20 rounded-full blur-[140px] animate-pulse">
  </div>
  <div
    class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-[var(--secondary-color)] opacity-30 rounded-full blur-[180px] animate-bounce-slow">
  </div>
  <canvas id="spark-canvas" class="absolute inset-0 z-10 [mix-blend-mode:screen] pointer-events-none"></canvas>
  <div
    class="relative z-20 text-center max-w-3xl mx-auto px-10 py-12 backdrop-blur-2xl bg-white/10 border border-white/20 rounded-3xl shadow-[0_0_40px_rgba(255,255,255,0.1)]"
    data-aos="fade-up">
    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-5 tracking-tight drop-shadow-xl">
      Elevate Your <span class="text-[var(--secondary-color)]">Lifestyle</span>
    </h1>
    <p class="text-base md:text-xl text-gray-200 mb-10">
      Discover our premium collection of elegant home essentials designed for comfort and sophistication.
    </p>
    <div class="flex flex-col sm:flex-row justify-center gap-6">
      <a href="#products"
        class="px-10 py-3 rounded-full bg-[var(--primary-color)] hover:bg-[var(--primary-hover)] font-semibold text-white shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
        Explore Now
      </a>
      <a href="#about"
        class="px-10 py-3 rounded-full border border-white/30 hover:border-white text-white hover:bg-white/10 transition-all duration-300">
        Learn More
      </a>
    </div>
  </div>
  <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
    <svg class="relative block w-full h-[180px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path id="wave1" fill="url(#grad1)" fill-opacity="0.6"
        d="M0,40 C150,120 350,0 600,60 C850,120 1050,20 1200,60 L1200,120 L0,120Z">
        <animate attributeName="d" dur="12s" repeatCount="indefinite" values="
          M0,40 C150,120 350,0 600,60 C850,120 1050,20 1200,60 L1200,120 L0,120Z;
          M0,60 C150,20 350,100 600,40 C850,-20 1050,80 1200,40 L1200,120 L0,120Z;
          M0,40 C150,120 350,0 600,60 C850,120 1050,20 1200,60 L1200,120 L0,120Z
        " />
      </path>
      <path id="wave2" fill="url(#grad2)" fill-opacity="0.4"
        d="M0,60 C200,100 400,20 600,80 C800,140 1000,40 1200,80 L1200,120 L0,120Z">
        <animate attributeName="d" dur="16s" repeatCount="indefinite" values="
          M0,60 C200,100 400,20 600,80 C800,140 1000,40 1200,80 L1200,120 L0,120Z;
          M0,80 C200,40 400,120 600,60 C800,0 1000,100 1200,60 L1200,120 L0,120Z;
          M0,60 C200,100 400,20 600,80 C800,140 1000,40 1200,80 L1200,120 L0,120Z
        " />
      </path>
      <defs>
        <linearGradient id="grad1" x1="0" x2="1" y1="0" y2="0">
          <stop offset="0%" /> <stop offset="50%" /> <stop offset="100%" />
        </linearGradient>
        <linearGradient id="grad2" x1="0" x2="1" y1="0" y2="0">
          <stop offset="0%" /> <stop offset="50%" /> <stop offset="100%" />
        </linearGradient>
      </defs>
    </svg>
  </div>
  <script>
    (function() {
      const canvas = document.getElementById('spark-canvas');
      if (!canvas) return;
      const ctx = canvas.getContext('2d');
      let particles = [];
      function resize() {
        canvas.width = canvas.clientWidth;
        canvas.height = canvas.clientHeight;
      }
      window.addEventListener('resize', resize);
      resize();
      function createParticle() {
        return {
          x: Math.random() * canvas.width,
          y: Math.random() * canvas.height,
          r: Math.random() * 1.8,
          a: Math.random() * 0.5 + 0.3,
          s: Math.random() * 0.4 + 0.1,
        };
      }
      for (let i = 0; i < 90; i++) particles.push(createParticle());
      function draw() {
        if (!ctx) return;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach((p) => {
          ctx.beginPath();
          ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
          ctx.fillStyle = `rgba(255,255,255,${p.a})`;
          ctx.fill();
          p.y -= p.s;
          if (p.y < -5) {
            p.y = canvas.height + 5;
            p.x = Math.random() * canvas.width;
          }
        });
        requestAnimationFrame(draw);
      }
      draw();
    })();
  </script>
</section>

<section class="py-16 lg:py-24 bg-gray-50/50" id="products">
  <div class="container mx-auto px-4">
    <button class="filter-mobile-toggle lg:hidden flex items-center justify-center w-full px-5 py-3 mb-6 font-semibold text-white bg-[var(--primary-color)] rounded-lg shadow-lg">
      <i class="fas fa-filter mr-2"></i> Filter Products
    </button>

    <div class="flex flex-col lg:flex-row gap-8">
      
      <div class="lg:w-1/4 relative">
        <div class="overlay fixed inset-0 bg-black/50 z-[999] opacity-0 invisible transition-all duration-300 lg:hidden"></div>
        
        <div
          class="filter-sidebar fixed top-0 -left-full w-80 h-screen z-[1000] overflow-y-auto transition-all duration-400 ease-in-out bg-white p-6 shadow-lg lg:relative lg:left-auto lg:top-24 lg:w-full lg:h-auto lg:z-auto lg:rounded-2xl lg:shadow-xl lg:sticky lg:hover:shadow-2xl">
          
          <button class="close-filter lg:hidden absolute top-5 right-5 bg-transparent border-none text-2xl text-gray-600 cursor-pointer">
            <i class="fas fa-times"></i>
          </button>

          <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-[var(--primary-color)]">Filters</h3>
            <button class="text-sm text-[var(--primary-color)] hover:underline clear-filters">Clear All</button>
          </div>

          <div class="filter-section border-b border-gray-200 pb-5 mb-5">
            <div class="filter-title flex items-center justify-between font-bold text-[var(--primary-color)] mb-4 text-lg">
              <span><i class="fas fa-tags mr-2 text-[var(--secondary-color)]"></i>Categories</span>
            </div>
            <div class="space-y-1">
              @foreach($allCategories as $category)
              <label class="filter-option flex items-center py-2 px-2 rounded-lg transition duration-200 hover:bg-[var(--background-color)] hover:translate-x-1 cursor-pointer">
                <input type="checkbox"
                  class="filter-input form-checkbox w-5 h-5 rounded border-2 border-gray-300 text-[var(--primary-color)] focus:ring-[var(--primary-color)] mr-3 cursor-pointer"
                  name="category[]" value="{{ $category->id }}"
                  {{ request('category_id') == $category->id ? 'checked' : '' }}>
                <span class="text-gray-700">{{ $category->name }}</span>
              </label>
              @endforeach
            </div>
          </div>

          <div class="filter-section border-b border-gray-200 pb-5 mb-5">
            <div class="filter-title flex items-center justify-between font-bold text-[var(--primary-color)] mb-4 text-lg">
              <span><i class="fas fa-dollar-sign mr-2 text-[var(--secondary-color)]"></i>Price Range</span>
            </div>
            <input type="range" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ $defaultPrice }}"
              class="price-range form-range w-full h-2 rounded-lg bg-gray-200 accent-[var(--primary-color)] my-4"
              id="price-range">
            <div class="price-display flex justify-between text-sm text-gray-700 mt-2">
              <span>${{ $minPrice }}</span>
              <span class="current-price font-bold text-[var(--primary-color)]">Up to $<span id="current-price">{{ $defaultPrice }}</span></span>
              <span>${{ $maxPrice }}</span>
            </div>
          </div>

          <div class="filter-section border-b border-gray-200 pb-5 mb-5 last:border-b-0 last:mb-0">
            <div class="filter-title flex items-center justify-between font-bold text-[var(--primary-color)] mb-4 text-lg">
              <span><i class="fas fa-star mr-2 text-[var(--secondary-color)]"></i>Customer Rating</span>
            </div>
            <div class="space-y-1">
              @for($i = 5; $i >= 3; $i--)
              <label class="filter-option flex items-center py-2 px-2 rounded-lg transition duration-200 hover:bg-[var(--background-color)] hover:translate-x-1 cursor-pointer">
                <input type="checkbox" class="filter-input form-checkbox w-5 h-5 rounded border-2 border-gray-300 text-[var(--primary-color)] focus:ring-[var(--primary-color)] mr-3 cursor-pointer" name="rating[]" value="{{ $i }}">
                <div class="flex items-center">
                  <div class="stars flex text-[var(--secondary-color)]">
                    @for($j = 1; $j <= 5; $j++)
                      <i class="{{ $j <= $i ? 'fas' : 'far' }} fa-star"></i>
                    @endfor
                  </div>
                  <span class="ml-2 text-sm text-gray-600">& Up</span>
                </div>
              </label>
              @endfor
            </div>
          </div>

          <button
            class="btn-primary apply-filters bg-gradient-to-r from-[var(--primary-color)] to-[var(--accent-color)] text-white border-none transition duration-300 rounded-lg font-semibold shadow-lg px-6 py-3 block w-full text-center hover:transform hover:-translate-y-0.5 hover:shadow-xl hover:from-[var(--accent-color)] hover:to-[var(--primary-color)]">
            <i class="fas fa-check-circle mr-2"></i> Apply Filters
          </button>
        </div>
      </div>

      <div class="lg:w-3/4">
        
        <div class="loading-spinner hidden text-center p-5">
          <div class="spinner border-4 border-gray-200 border-l-[var(--primary-color)] rounded-full w-10 h-10 animate-spin mx-auto"></div>
          <p class="mt-4 text-gray-600">Loading products...</p>
        </div>

        <div id="category-sections-wrapper" class="space-y-12">
            @include('user.partials.category_sections', ['categories' => $categories])
        </div>
      </div>
      </div>
  </div>
</section>
@endsection

@push("script")
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    gsap.registerPlugin(ScrollTrigger);

    function setupHorizontalScroll() {
        const sections = document.querySelectorAll('.category-section');
        
        let triggers = ScrollTrigger.getAll();
        triggers.forEach(trigger => trigger.kill());

        if (window.matchMedia("(min-width: 768px)").matches) {
            sections.forEach(section => {
                section.classList.add('overflow-hidden'); 
                const carousel = section.querySelector('[id^="product-carousel-"]');
                const progressBar = section.querySelector('.progress-bar');
                
                if (carousel) {
                    carousel.classList.remove('overflow-x-auto', 'no-scrollbar', 'scroll-smooth');
                }
                
                if (!carousel) return; 

                const cards = carousel.querySelectorAll('.product-card-container, .load-more-card');

                if (cards.length <= 1) {
                     gsap.set(section, { pin: false }); 
                    return; 
                }

                const getValues = () => {
                    const scrollWidth = carousel.scrollWidth;
                    const cardWidth = cards[0] ? cards[0].offsetWidth : 0; 
                    const parentWidth = carousel.parentElement.offsetWidth;
                    
                    const viewportOffset = (parentWidth - cardWidth) / 2;
                    const totalScrollDistance = scrollWidth - parentWidth + (viewportOffset * 2);
                    const finalOffset = scrollWidth - parentWidth + viewportOffset;

                    if (totalScrollDistance <= 0) {
                        return { viewportOffset: 0, totalScrollDistance: 0, finalOffset: 0, noScroll: true };
                    }
                    return { viewportOffset, totalScrollDistance, finalOffset, noScroll: false };
                };
                
                const initialValues = getValues();
                if (initialValues.noScroll) {
                    gsap.set(section, { pin: false });
                    return;
                }

                gsap.set(carousel, { x: () => getValues().viewportOffset });

                gsap.to(carousel, {
                    x: () => -getValues().finalOffset,
                    ease: "none",
                    scrollTrigger: {
                        trigger: section,
                        start: "top top",
                        scrub: 1,
                        pin: true,
                        end: () => `+=${getValues().totalScrollDistance}`, 
                        invalidateOnRefresh: true 
                    }
                });

                if (progressBar) {
                    gsap.to(progressBar, {
                        width: "100%",
                        ease: "none",
                        scrollTrigger: {
                            trigger: section,
                            start: "top top",
                            scrub: 1,
                            end: () => `+=${getValues().totalScrollDistance}`
                        }
                    });
                }
            });

        } else {
            sections.forEach(section => {
                section.classList.remove('overflow-hidden'); 
                const carousel = section.querySelector('[id^="product-carousel-"]');
                if (carousel) {
                    carousel.classList.add('overflow-x-auto', 'no-scrollbar', 'scroll-smooth');
                    gsap.set(carousel, { clearProps: "all" });
                }
            });
        }
    }

    setupHorizontalScroll();

    let resizeTimer;
    window.addEventListener("resize", () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            setupHorizontalScroll();
        }, 250);
    });

    if (typeof AOS !== 'undefined') {
        AOS.init({ duration: 800, easing: 'ease-in-out', once: true });
    }
    
    const filterToggle = document.querySelector('.filter-mobile-toggle');
    const filterSidebar = document.querySelector('.filter-sidebar');
    const overlay = document.querySelector('.overlay');
    const closeFilter = document.querySelector('.close-filter');
    
    function closeMobileFilter() {
        if (filterSidebar) filterSidebar.classList.remove('active');
        if (overlay) overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (filterToggle) {
        filterToggle.addEventListener('click', function() {
            if (filterSidebar) filterSidebar.classList.add('active');
            if (overlay) overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }
    if (closeFilter) closeFilter.addEventListener('click', closeMobileFilter);
    if (overlay) overlay.addEventListener('click', closeMobileFilter);
    
    const priceRange = document.getElementById('price-range');
    const currentPrice = document.getElementById('current-price');
    
    if (priceRange && currentPrice) {
        currentPrice.textContent = priceRange.value; 
        priceRange.addEventListener('input', function() {
            currentPrice.textContent = this.value;
        });
    }
    
    const sectionsWrapper = document.getElementById('category-sections-wrapper');

    if (sectionsWrapper) {
        
        sectionsWrapper.addEventListener('click', async function(e) { 
            
            const swatch = e.target.closest('.color-swatch');
            const sizeSwatch = e.target.closest('.size-swatch');
            const qtyBtn = e.target.closest('.quantity-btn');
            const cartBtn = e.target.closest('.add-to-cart-btn');
            const loadMoreButton = e.target.closest('.load-more-card'); 

            if (swatch) {
                e.preventDefault();
                const card = swatch.closest('.product-card-container');
                if (!card) return;
                card.dataset.selectedColorId = swatch.dataset.colorId;
                const targetImageId = swatch.dataset.targetImage;
                const newImageSrc = swatch.dataset.imageSrc;
                const productId = swatch.dataset.productId;
                const targetImage = document.getElementById(targetImageId);
                if (targetImage) targetImage.src = newImageSrc;
                const productSwatches = document.querySelectorAll(`.color-swatch[data-product-id="${productId}"]`);
                productSwatches.forEach(s => s.classList.remove('ring-2', 'ring-[var(--primary-color)]', 'ring-offset-2'));
                swatch.classList.add('ring-2', 'ring-[var(--primary-color)]', 'ring-offset-2');
            }

            else if (sizeSwatch) {
                e.preventDefault();
                const card = sizeSwatch.closest('.product-card-container');
                if (!card) return;
                card.dataset.selectedSizeId = sizeSwatch.dataset.sizeId;
                const sizePrice = sizeSwatch.dataset.sizePrice;
                const priceDisplay = card.querySelector('.product-price-display');
                const basePrice = card.dataset.productPrice;
                if (priceDisplay) {
                    if (sizePrice && parseFloat(sizePrice) > 0) {
                        priceDisplay.textContent = `$${parseFloat(sizePrice).toFixed(2)}`;
                    } else {
                        priceDisplay.textContent = `$${parseFloat(basePrice).toFixed(2)}`;
                    }
                }
                const parentContainer = sizeSwatch.closest('.flex');
                if (!parentContainer) return;
                parentContainer.querySelectorAll('.size-swatch').forEach(s => {
                    s.classList.remove('bg-[var(--primary-color)]', 'text-white', 'border-[var(--primary-color)]');
                    s.classList.add('border-gray-300', 'hover:border-[var(--primary-color)]', 'hover:bg-[var(--background-color)]');
                });
                sizeSwatch.classList.add('bg-[var(--primary-color)]', 'text-white', 'border-[var(--primary-color)]');
                sizeSwatch.classList.remove('hover:border-[var(--primary-color)]', 'hover:bg-[var(--background-color)]');
            }

            else if (qtyBtn) {
                e.preventDefault();
                const input = qtyBtn.parentElement.querySelector('.quantity-input');
                const downBtn = qtyBtn.parentElement.querySelector('.quantity-btn.down');
                if (!input || !downBtn) return;
                let value = parseInt(input.value);
                if (qtyBtn.classList.contains('up')) {
                    value++;
                } else if (qtyBtn.classList.contains('down')) {
                    value--;
                }
                if (value < 1) value = 1; 
                input.value = value;
                downBtn.disabled = (value <= 1); 
            }

            else if (cartBtn) {
                e.preventDefault();
                const card = cartBtn.closest('.product-card-container');
                if (!card) return;
                const productId = card.dataset.productId;
                const selectedColorId = card.dataset.selectedColorId;
                const selectedSizeId = card.dataset.selectedSizeId;
                const quantity = card.querySelector('.quantity-input').value;
                const price = card.dataset.productPrice;

                if (!selectedColorId || selectedColorId === '') {
                    Swal.fire({ icon: 'warning', title: 'Select a Color', text: 'Please select a color before adding to cart.'});
                    return;
                }
                if (!selectedSizeId || selectedSizeId === '') {
                    Swal.fire({ icon: 'warning', title: 'Select a Size', text: 'Please select a size before adding to cart.'});
                    return;
                }

                let guestToken = localStorage.getItem('guest_token');
                if (!guestToken) {
                    guestToken = self.crypto.randomUUID();
                    localStorage.setItem('guest_token', guestToken);
                }
                const cartItem = { product_id: productId, color_id: selectedColorId, size_id: selectedSizeId, quantity: quantity, price: price, guest_token: guestToken, };
                try {
                    const response = await fetch('/add-to-cart', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                        body: JSON.stringify(cartItem)
                    });
                    const data = await response.json();
                    if (data.success) {
                        Swal.fire({ icon: 'success', title: 'Added to Cart!', text: 'Product successfully added to your cart.', timer: 1500, showConfirmButton: false });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Failed!', text: data.message || 'Something went wrong while adding to cart.'});
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire({ icon: 'error', title: 'Server Error', text: 'Could not add product to cart. Please try again.'});
                }
            }

            else if (loadMoreButton) {
                e.preventDefault();

                const categoryId = loadMoreButton.dataset.categoryId;
                const spinner = loadMoreButton.querySelector('.spinner');
                
                spinner.classList.remove('hidden');
                loadMoreButton.querySelector('h3').classList.add('hidden');
                loadMoreButton.querySelector('p').classList.add('hidden');
                loadMoreButton.style.pointerEvents = 'none';

                const currentQueryString = window.location.search;

                try {
                    const response = await fetch(`/products/load-more/${categoryId}${currentQueryString}`);
                    const data = await response.json();

                    if (data.html) {
                        loadMoreButton.insertAdjacentHTML('beforebegin', data.html);
                        if (typeof AOS !== 'undefined') {
                            AOS.refresh();
                        }
                    }

                    if (data.noMore) {
                        loadMoreButton.remove();
                    }

                    ScrollTrigger.refresh();

                } catch (error) {
                    console.error('Error loading more products:', error);
                    spinner.classList.add('hidden');
                    loadMoreButton.querySelector('h3').classList.remove('hidden');
                    loadMoreButton.querySelector('p').classList.remove('hidden');
                    loadMoreButton.style.pointerEvents = 'auto';
                }
            }
            
        }); 
    } 

    
    const applyFiltersBtn = document.querySelector('.apply-filters');
    const clearFiltersBtn = document.querySelector('.clear-filters');
    const loadingSpinner = document.querySelector('.loading-spinner');
    
    function applyFilters() {
        if (loadingSpinner) loadingSpinner.classList.add('active');
        if (sectionsWrapper) sectionsWrapper.innerHTML = ''; 
        
        let categories = Array.from(document.querySelectorAll('input[name="category[]"]:checked'))
                                .map(cb => cb.value);
        let price = document.querySelector('#price-range').value;
        let ratings = Array.from(document.querySelectorAll('input[name="rating[]"]:checked'))
                            .map(cb => cb.value);
        
        const params = new URLSearchParams();
        if (categories.length > 0) {
            params.append('categories', categories.join(','));
        }
        params.append('price', price); 
        if (ratings.length > 0) {
            params.append('ratings', ratings.join(','));
        }
        
        const query = params.toString();
        const fetchUrl = `{{ route('product') }}?${query}`;

        const newUrl = window.location.pathname + '?' + query;
        window.history.pushState({path: newUrl}, '', newUrl);

        fetch(fetchUrl, { 
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            if (sectionsWrapper) {
                sectionsWrapper.innerHTML = html;
                if (typeof AOS !== 'undefined') {
                    AOS.refresh();
                }
                setupHorizontalScroll(); 
            }
            if (loadingSpinner) loadingSpinner.classList.remove('active');
        })
        .catch(error => {
            console.error('Error:', error);
            if (loadingSpinner) loadingSpinner.classList.remove('active');
            if (sectionsWrapper) sectionsWrapper.innerHTML = '<p class="text-red-500">Error loading products.</p>';
        });

        closeMobileFilter();
    }
    
    if (applyFiltersBtn) {
        applyFiltersBtn.addEventListener('click', applyFilters);
    }
    
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', function() {
            document.querySelectorAll('.filter-input').forEach(input => {
                input.checked = false;
            });
            
            if (priceRange) {
                priceRange.value = priceRange.max;
                if(currentPrice) currentPrice.textContent = priceRange.max;
            }
            
            applyFilters();
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    const categoryId = urlParams.get('category_id');
 


    // 2. If a category_id exists, trigger the filter logic
    if (categoryId) {
        // Option A: If you have a specific function that fetches data, call it here.
        // Example: fetchProducts();

        // Option B: If you rely on the "Apply Filters" button, simulate a click.
        const applyBtn = document.querySelector('.apply-filters');
        if (applyBtn) {
            applyBtn.click();
        }
    }
});
</script>
@endpush