@extends("user.layouts.master-layouts.plain")

<title>Home Collection | Category </title>



@push("style")
<style>
body {
            font-family: 'Inter', sans-serif;
            color: var(--text-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
        }
        
        .text-primary {
            color: var(--primary-color);
        }
        
        .bg-primary {
            background-color: var(--primary-color);
        }
        
        .border-primary {
            border-color: var(--primary-color);
        }
        
        .bg-accent {
            background-color: var(--accent-color);
        }
        
        .categories-hero-bg {
            background: linear-gradient(135deg, rgba(75, 54, 33, 0.85) 0%, rgba(107, 79, 51, 0.8) 100%), url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
        }
        
        .color-picker {
            position: fixed;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background: white;
            padding: 10px;
            border-radius: 8px 0 0 8px;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
        .color-option {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            margin: 5px;
            cursor: pointer;
            border: 2px solid transparent;
        }
        
        .color-option.active {
            border-color: #333;
        }
        
        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .category-image {
            transition: transform 0.5s ease;
        }
        
        .category-card:hover .category-image {
            transform: scale(1.05);
        }
        
        .filter-btn {
            transition: all 0.3s ease;
        }
        
        .filter-btn.active {
            background-color: var(--primary-color);
            color: white;
        }
    </style>
@endpush


@section("content")
<section class="relative h-[80vh] md:h-[80vh] overflow-hidden flex items-center justify-center text-white">
  <!-- Animated Gradient Background -->
  <div class="absolute inset-0 bg-gradient-to-r from-[var(--primary-color)] via-[var(--accent-color)] to-[var(--secondary-color)] animate-gradient"></div>

  <!-- Floating Glow Orbs -->
  <div class="absolute -top-40 -left-20 w-[400px] h-[400px] bg-[var(--secondary-color)] opacity-25 rounded-full blur-[140px] animate-pulse"></div>
  <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-[var(--accent-color)] opacity-30 rounded-full blur-[180px] animate-bounce-slow"></div>

  <!-- Sparkle Canvas -->
  <canvas id="spark-canvas" class="absolute inset-0 z-10"></canvas>

  <!-- Content -->
  <div class="relative z-20 text-center max-w-3xl mx-auto px-8 py-10 backdrop-blur-xl bg-white/10 border border-white/20 rounded-3xl shadow-[0_0_40px_rgba(255,255,255,0.1)]" data-aos="fade-up">
    <h1 class="text-5xl md:text-6xl font-extrabold mb-5 leading-tight tracking-tight drop-shadow-lg">
      Our <span class="text-[var(--secondary-color)]">Collections</span>
    </h1>
    <p class="text-lg md:text-xl text-gray-200 mb-10">
      Discover our premium home collection curated for modern living — stylish, comfortable, and timeless.
    </p>
    <div class="flex justify-center gap-6">
      <a href="#categories" 
         class="px-8 py-3 rounded-full bg-[var(--primary-color)] hover:bg-[var(--primary-hover)] font-semibold text-[var(--text-on-primary)] shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
        Explore Collections
      </a>
      <a href="#products" 
         class="px-8 py-3 rounded-full border border-[var(--border-color)] hover:border-[var(--secondary-color)] text-white hover:bg-white/10 transition-all duration-300">
        Featured Items
      </a>
    </div>
  </div>

  <!-- Animated Double Wave Bottom Border -->
  <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
    <svg class="relative block w-full h-[180px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path fill="url(#grad1)" fill-opacity="0.6"
        d="M0,40 C150,120 350,0 600,60 C850,120 1050,20 1200,60 L1200,120 L0,120Z">
        <animate attributeName="d" dur="12s" repeatCount="indefinite"
          values="
            M0,40 C150,120 350,0 600,60 C850,120 1050,20 1200,60 L1200,120 L0,120Z;
            M0,60 C150,20 350,100 600,40 C850,-20 1050,80 1200,40 L1200,120 L0,120Z;
            M0,40 C150,120 350,0 600,60 C850,120 1050,20 1200,60 L1200,120 L0,120Z" />
      </path>

      <path fill="url(#grad2)" fill-opacity="0.4"
        d="M0,60 C200,100 400,20 600,80 C800,140 1000,40 1200,80 L1200,120 L0,120Z">
        <animate attributeName="d" dur="16s" repeatCount="indefinite"
          values="
            M0,60 C200,100 400,20 600,80 C800,140 1000,40 1200,80 L1200,120 L0,120Z;
            M0,80 C200,40 400,120 600,60 C800,0 1000,100 1200,60 L1200,120 L0,120Z;
            M0,60 C200,100 400,20 600,80 C800,140 1000,40 1200,80 L1200,120 L0,120Z" />
      </path>

      <defs>
        <linearGradient id="grad1" x1="0" x2="1" y1="0" y2="0">
          <stop offset="0%" stop-color="var(--primary-color)" />
          <stop offset="50%" stop-color="var(--accent-color)" />
          <stop offset="100%" stop-color="var(--secondary-color)" />
        </linearGradient>
        <linearGradient id="grad2" x1="0" x2="1" y1="0" y2="0">
          <stop offset="0%" stop-color="var(--secondary-color)" />
          <stop offset="50%" stop-color="var(--accent-color)" />
          <stop offset="100%" stop-color="var(--primary-color)" />
        </linearGradient>
      </defs>
    </svg>
  </div>

  <style>
    @keyframes gradient {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .animate-gradient {
      background-size: 200% 200%;
      animation: gradient 10s ease infinite;
    }
    .animate-bounce-slow {
      animation: bounce 6s infinite ease-in-out;
    }
    #spark-canvas {
      pointer-events: none;
      mix-blend-mode: screen;
    }

    /* Mobile Height */
    @media (max-width: 768px) {
      section.relative {
        height: 50vh !important;
      }
    }
  </style>

  <script>
    // Subtle Sparkle Particle Effect
    const canvas = document.getElementById('spark-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];

    function resize() {
      canvas.width = innerWidth;
      canvas.height = innerHeight;
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
  </script>
</section>



<!-- Categories Section -->
<section id="categories" class="relative py-24 overflow-hidden bg-[var(--background-color)] text-[var(--text-on-secondary)]">

  <!-- Floating Blobs -->
  <div class="absolute top-[-100px] left-[-100px] w-[30rem] h-[30rem] bg-[var(--secondary-color)] opacity-25 rounded-full blur-[100px] animate-float-slow"></div>
  <div class="absolute bottom-[-120px] right-[-120px] w-[34rem] h-[34rem] bg-[var(--accent-color)] opacity-20 rounded-full blur-[100px] animate-float-reverse"></div>

  <!-- Subtle Noise Overlay -->
  <div class="absolute inset-0 bg-[url('/images/noise.png')] opacity-[0.07] pointer-events-none"></div>

  <!-- Section Heading -->
  <div class="relative z-20 text-center mb-20" data-aos="fade-up">
    <h2 class="text-5xl md:text-6xl font-extrabold mb-4 text-[var(--primary-color)]">
      Our <span class="text-[var(--secondary-color)]">Luxury Collections</span>
    </h2>
    <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
      Handpicked categories crafted with elegance and timeless design.
    </p>
  </div>

  <!-- Category Cards -->
  <div class="relative z-20 container mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
    @foreach ($categories as $index => $category)
      <div 
        class="category-card group relative rounded-3xl overflow-hidden bg-white border border-[var(--border-color)] shadow-lg hover:shadow-[0_10px_30px_rgba(0,0,0,0.1)] transition-all duration-500 transform hover:-translate-y-3 hover:scale-[1.02]"
        data-aos="zoom-in"
        @if($index % 3 == 1) data-aos-delay="100" 
        @elseif($index % 3 == 2) data-aos-delay="200" 
        @endif
      >

        <!-- Image -->
        <div class="h-64 overflow-hidden relative">
          <img 
            src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/default-category.jpg') }}" 
            alt="{{ $category->name }}" 
            class="w-full h-full object-cover transform transition-transform duration-[900ms] group-hover:scale-110"
          >
          <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-700"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 p-6">
          <h3 class="text-2xl font-bold mb-2 text-[var(--primary-color)] group-hover:text-[var(--accent-color)] transition-colors duration-300">
            {{ $category->name }}
          </h3>
          <p class="text-gray-600 mb-5">{{ $category->description ?? 'Explore our finest picks in this category.' }}</p>

          <div class="flex justify-between items-center">
            <span class="text-lg font-semibold text-[var(--secondary-color)]">
              {{ $category->product->count() ?? '0' }}+ Products
            </span>
            <a href="{{ route('product', ['category_id' => $category->id]) }}" 
   class="px-5 py-2.5 rounded-full font-medium bg-[var(--secondary-color)] text-[var(--text-on-secondary)] hover:bg-[var(--secondary-hover)] shadow-[0_0_15px_rgba(200,161,101,0.3)] hover:shadow-[0_0_25px_rgba(200,161,101,0.5)] transition-all duration-500">
  Explore
</a>

          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Bottom Decorative Wave -->
  <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
    <svg class="w-full h-20 text-[var(--background-color)]" preserveAspectRatio="none" viewBox="0 0 1200 120">
      <path d="M0,0V46.29c47.28,22,98.51,39,158,39,110,0,219-50,329-50s219,50,329,50,219-50,329-50c59.49,0,110.72,17,158,39V0Z" fill="currentColor"></path>
    </svg>
  </div>

  <!-- Animations -->
  <style>
    @keyframes float-slow {
      0%, 100% { transform: translateY(0) translateX(0) scale(1); }
      50% { transform: translateY(-25px) translateX(20px) scale(1.05); }
    }
    .animate-float-slow {
      animation: float-slow 10s ease-in-out infinite;
    }

    @keyframes float-reverse {
      0%, 100% { transform: translateY(0) translateX(0) scale(1); }
      50% { transform: translateY(25px) translateX(-20px) scale(1.05); }
    }
    .animate-float-reverse {
      animation: float-reverse 12s ease-in-out infinite;
    }
  </style>
</section>



    <!-- Featured Products Section -->
    <section id="featured" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-primary mb-4">Featured Products</h2>
                <p class="text-text-color max-w-2xl mx-auto">Handpicked items from our collections</p>
            </div>
            
            <div class="w-full px-4 lg:px-8 mx-auto">
    <div class="products-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            @include('user.partials.home-product-cards', ['product' => $product])
        @endforeach
    </div>
</div>
            <div class="text-center mt-10" data-aos="fade-up">
                <a href="/shop" class="btn-primary px-8 py-3 rounded-lg font-medium text-lg">View All Products</a>
            </div>
        </div>
    </section>


@endsection


@push("script")

<script>
        // Initialize AOS (Animate On Scroll)
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
            
            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            // Category filtering functionality
            const filterButtons = document.querySelectorAll('.filter-btn');
            const categoryCards = document.querySelectorAll('.category-card');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Update active button
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    
                    const filterValue = button.getAttribute('data-filter');
                    
                    // Filter category cards
                    categoryCards.forEach(card => {
                        if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                            card.style.display = 'block';
                            // Add animation
                            card.style.animation = 'fadeIn 0.5s ease forwards';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
            
            // Theme color changer
            const colorOptions = document.querySelectorAll('.color-option');
            
            colorOptions.forEach(option => {
                option.addEventListener('click', () => {
                    // Update active color
                    colorOptions.forEach(opt => opt.classList.remove('active'));
                    option.classList.add('active');
                    
                    // Get the selected color
                    const newColor = option.getAttribute('data-color');
                    
                    // Update CSS variables
                    document.documentElement.style.setProperty('--primary-color', newColor);
                    
                    // Calculate secondary color (darker shade)
                    const secondaryColor = shadeColor(newColor, -20);
                    document.documentElement.style.setProperty('--secondary-color', secondaryColor);
                });
            });
            
            // Helper function to shade colors
            function shadeColor(color, percent) {
                let R = parseInt(color.substring(1, 3), 16);
                let G = parseInt(color.substring(3, 5), 16);
                let B = parseInt(color.substring(5, 7), 16);
                
                R = parseInt(R * (100 + percent) / 100);
                G = parseInt(G * (100 + percent) / 100);
                B = parseInt(B * (100 + percent) / 100);
                
                R = (R < 255) ? R : 255;
                G = (G < 255) ? G : 255;
                B = (B < 255) ? B : 255;
                
                const RR = ((R.toString(16).length == 1) ? "0" + R.toString(16) : R.toString(16));
                const GG = ((G.toString(16).length == 1) ? "0" + G.toString(16) : G.toString(16));
                const BB = ((B.toString(16).length == 1) ? "0" + B.toString(16) : B.toString(16));
                
                return "#" + RR + GG + BB;
            }
        });
    </script>
@endpush


