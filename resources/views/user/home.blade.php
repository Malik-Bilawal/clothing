@extends("user.layouts.master-layouts.plain")
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<title>Home Collection | Premium Home Essentials</title>

@push("style")
<style>


/* Smooth hover depth effect */
.group:hover img {
  transform: scale(1.08) rotate(1deg);
}

/* Custom shadow glow for premium feel */
.group:hover .bg-gradient-to-br {
  filter: drop-shadow(0 8px 20px rgba(200,161,101,0.3));
}


/* Floating animation */
@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(10deg);
    }
}

.animate-float {
    animation: float 8s ease-in-out infinite;
}

.animate-float-delay-2 {
    animation: float 8s ease-in-out 2s infinite;
}

.animate-float-delay-4 {
    animation: float 8s ease-in-out 4s infinite;
}

.animate-float-delay-6 {
    animation: float 8s ease-in-out 6s infinite;
}


.sale-gradient {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
}

.btn-gradient {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
}

.btn-gradient:hover {
    background: linear-gradient(135deg, var(--primary-hover) 0%, var(--accent-hover) 100%);
}

/* Pattern backgrounds */
.hero-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
    opacity: 0.3;
}

.sale-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.footer-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
    opacity: 0.3;
}

/* Custom transitions */
.transition-custom {
    transition: var(--transition);
}

/* Hide scrollbar for cleaner look */
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
</style>
@endpush

@section("content")
@if($banners->count() > 0)
    <section 
        x-data="{ 
            activeSlide: 0, 
            slides: {{ $banners->count() }},
            autoplayInterval: null,
            startAutoplay() {
                // LOGIC: Only start timer if we have more than 1 slide
                if(this.slides > 1) {
                    this.autoplayInterval = setInterval(() => {
                        this.activeSlide = (this.activeSlide + 1) % this.slides;
                    }, 5000); 
                }
            },
            stopAutoplay() {
                clearInterval(this.autoplayInterval);
            }
        }"
        x-init="startAutoplay()"
        @mouseenter="stopAutoplay()" 
        @mouseleave="startAutoplay()"
        class="relative min-h-[90vh] flex items-center justify-center rounded-3xl overflow-hidden mx-4 mt-4 bg-gray-900 shadow-2xl" 
    >
    
        @foreach($banners as $index => $banner)
            <div 
                x-show="activeSlide === {{ $index }}"
                
                {{-- Only apply transitions if there is more than 1 slide to avoid flicker on single video --}}
                @if($banners->count() > 1)
                    x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 transform scale-105"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-1000"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-105"
                @endif
                
                class="absolute inset-0 w-full h-full"
            >
                @if($banner->type === 'video' && $banner->video)
                    <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
                        <source src="{{ asset($banner->video) }}" type="video/mp4">
                    </video>
                @else
                    <div class="absolute inset-0 bg-cover bg-center z-0" 
                    style="background-image: url('{{ asset('storage/' . $banner->image) }}')">                @endif
    
                <div class="absolute inset-0 hero-gradient z-1"></div>
                <div class="absolute inset-0 hero-pattern opacity-30 z-1"></div>
                
                <div class="absolute w-32 h-32 rounded-full bg-white/5 top-10 left-5 animate-float z-1"></div>
                <div class="absolute w-20 h-20 rounded-full bg-white/5 bottom-15 right-10 animate-float-delay-2 z-1"></div>
    
                <div class="relative z-10 container mx-auto px-4 h-full flex items-center justify-center">
                    <div class="max-w-3xl w-full" data-aos="fade-right" data-aos-delay="100">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-tight mb-6 drop-shadow-lg">
                            {{ $banner->title }}
                        </h1>
                        
                        <p class="text-xl text-white/90 mb-8 max-w-2xl leading-relaxed drop-shadow-md">
                            {{ $banner->description }}
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            @if($banner->button_text && $banner->button_url)
                                <a href="{{ $banner->button_url }}" 
                                   class="btn-gradient text-white border-none py-4 px-10 rounded-full font-semibold transition-all duration-500 shadow-lg hover:shadow-xl hover:-translate-y-1 text-center">
                                    {{ $banner->button_text }}
                                </a>
                            @endif
    
                            <a href="{{ route('category') }}" 
                               class="bg-transparent text-white border-2 border-[var(--secondary-color)] py-4 px-10 rounded-full font-semibold transition-all duration-500 relative overflow-hidden group hover:text-[var(--text-on-secondary)] text-center">
                                <span class="relative z-10">Explore Categories</span>
                                <div class="absolute inset-0 bg-[var(--secondary-color)] opacity-0 group-hover:opacity-100 transition-all duration-500 -z-10"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if($banners->count() > 1)
            <div class="absolute bottom-8 left-0 right-0 z-20 flex justify-center space-x-3">
                @foreach($banners as $index => $banner)
                    <button 
                        @click="activeSlide = {{ $index }}" 
                        :class="{'bg-white w-8': activeSlide === {{ $index }}, 'bg-white/50 w-3': activeSlide !== {{ $index }}}"
                        class="h-3 rounded-full transition-all duration-300 shadow-sm"
                        aria-label="Go to slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>
        @endif
    
    </section>
@endif
<section class="relative bg-[var(--background-color)] overflow-hidden">
  <div id="blob-1" class="absolute -top-60 -left-40 w-[45rem] h-[45rem] rounded-full blur-[130px] opacity-70"></div>
  <div id="blob-2" class="absolute bottom-0 right-0 w-[50rem] h-[50rem] rounded-full blur-[130px] opacity-60"></div>

  <div class="container mx-auto px-6 py-28 relative z-10">
    <div class="text-center mb-20" data-aos="fade-up">
      <h2 class="text-6xl font-extrabold text-[var(--primary-color)] mb-6 tracking-tight leading-tight">
        Shop by Category
      </h2>
      <p class="text-lg text-[var(--accent-color)] max-w-2xl mx-auto leading-relaxed">
        Experience vibrant elegance — discover collections that flow with life, crafted to inspire every moment.
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 mb-32">
      @foreach($categories as $category)
      <div class="relative group perspective" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
        <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-[var(--secondary-color)]/30 via-transparent to-[var(--accent-color)]/30 opacity-0 group-hover:opacity-100 blur-2xl transition-all duration-700"></div>

        <div
          class="relative bg-white/60 backdrop-blur-2xl border border-white/20 rounded-3xl overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.15)] transition-transform duration-700 transform-gpu group-hover:-translate-y-4 group-hover:scale-[1.03]"
          onmousemove="tiltCard(event, this)"
          onmouseleave="resetTilt(this)"
        >
          <div class="relative h-72 overflow-hidden">
            <img
              src="{{ $category->image ? asset('storage/' . $category->image) : 'https://via.placeholder.com/800x500?text=No+Image' }}"
              alt="{{ $category->name }}"
              class="w-full h-full object-cover transition-transform duration-[1.8s] ease-[cubic-bezier(0.19,1,0.22,1)] group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-700"></div>

            <div class="absolute bottom-0 left-0 p-6 translate-y-10 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-700">
              <h3 class="text-2xl font-bold text-white mb-2 drop-shadow-xl">{{ $category->name }}</h3>
              <p class="text-white/80 text-sm">{{ $category->description ?? 'Explore our collection' }}</p>
            </div>
          </div>

          <div class="p-6 text-center">
            <h3 class="text-xl font-semibold text-[var(--primary-color)] mb-2">{{ $category->name }}</h3>
            <a href="{{ route('product',['category_id' => $category->id])}}"
              class="inline-flex items-center justify-center gap-2 text-[var(--secondary-color)] font-semibold mt-2 px-5 py-2.5 rounded-full border border-[var(--secondary-color)]/30 hover:bg-[var(--secondary-color)] hover:text-white transition-all duration-500 hover:shadow-[0_0_20px_var(--secondary-color)]">
              Explore
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    @php
    
    $activeSale = $sale->first();
    @endphp
    <!-- ================= FEATURED PRODUCTS ================= -->
    <div class="text-center mb-16" data-aos="fade-up">
      <h2 class="text-5xl md:text-6xl font-extrabold text-[var(--primary-color)] mb-6 tracking-tight leading-tight">
        Featured Products
      </h2>
      <p class="text-lg text-[var(--accent-color)] max-w-2xl mx-auto leading-relaxed">
        Discover our most loved products hand-picked for you.
      </p>
    </div>

    <div class="w-full px-4 lg:px-8 mx-auto">
    <div class="products-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            @include('user.partials.home-product-cards', ['product' => $product])
        @endforeach
    </div>
</div>


    <div class="text-center mt-16" data-aos="fade-up">
      <a
        href="{{ route('product') }}"
        class="inline-block bg-[var(--primary-color)] text-[var(--text-on-primary)] font-semibold py-3 px-10 rounded-full shadow-lg hover:bg-[var(--primary-hover)] hover:-translate-y-1 transition-all duration-300"
      >
        View All Products
      </a>
    </div>
  </div>
</section>

<!-- =================== Scripts & Styles =================== -->
<script src="https://unpkg.com/gsap@3.12.2/dist/gsap.min.js"></script>
<style>
.perspective { perspective: 1000px; }

#blob-1, #blob-2 {
  background: radial-gradient(circle, var(--secondary-color), var(--accent-color));
  animation: blobMove 14s ease-in-out infinite;
}
#blob-2 { animation-delay: 4s; }

@keyframes blobMove {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(25px, -25px) scale(1.05); }
  66% { transform: translate(-25px, 25px) scale(0.95); }
}
</style>

<script>
function tiltCard(e, card) {
  const rect = card.getBoundingClientRect();
  const x = e.clientX - rect.left;
  const y = e.clientY - rect.top;
  const rotateX = ((y - rect.height / 2) / rect.height) * 10;
  const rotateY = ((x - rect.width / 2) / rect.width) * -10;

  gsap.to(card, {
    rotationX: rotateX,
    rotationY: rotateY,
    scale: 1.03,
    transformPerspective: 1000,
    ease: "power2.out",
    duration: 0.4
  });
}

function resetTilt(card) {
  gsap.to(card, {
    rotationX: 0,
    rotationY: 0,
    scale: 1,
    ease: "elastic.out(1, 0.3)",
    duration: 1.2
  });
}

// 🌊 Floating Blob Movement
gsap.to("#blob-1", { x: 60, y: -40, duration: 12, repeat: -1, yoyo: true, ease: "sine.inOut" });
gsap.to("#blob-2", { x: -60, y: 50, duration: 14, repeat: -1, yoyo: true, ease: "sine.inOut" });
</script>

<style>
  #blob-left, #blob-right {
    will-change: transform;
    isolation: isolate;
  }
  #sale-countdown, h2, p, a {
    transform: translateZ(0);
    position: relative;
    z-index: 20;
  }
  #spark-canvas {
    position: absolute;
    inset: 0;
    z-index: 0;
    transform: translateZ(0);
  }
</style>

@if($activeSale)
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;500;800&display=swap" rel="stylesheet">

<section id="premium-sale-card" 
    class="relative isolate overflow-hidden my-24 mx-4 md:mx-auto max-w-7xl rounded-[2.5rem] border border-white/10 shadow-2xl group"
    style="font-family: 'Outfit', sans-serif; background-color: #050505;">

    <div class="absolute inset-0 opacity-[0.07] z-0 pointer-events-none" 
         style="background-image: url('https://grainy-gradients.vercel.app/noise.svg');"></div>

    <div id="spotlight" 
         class="absolute -inset-px bg-[radial-gradient(600px_circle_at_var(--x,50%)_var(--y,50%),rgba(255,255,255,0.1),transparent_40%)] opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-0 pointer-events-none"></div>

    <div class="absolute top-[-20%] left-[-10%] w-[500px] h-[500px] bg-[var(--primary-color,#ec4899)]/30 rounded-full blur-[120px] mix-blend-screen animate-pulse-slow"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] bg-[var(--secondary-color,#3b82f6)]/30 rounded-full blur-[120px] mix-blend-screen animate-pulse-slow" style="animation-delay: 2s;"></div>

    <div class="relative z-10 flex flex-col items-center justify-center py-24 px-6 text-center">
        
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 bg-white/5 backdrop-blur-md mb-8 shadow-lg ring-1 ring-white/10">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
            </span>
            <span class="text-xs font-medium tracking-widest uppercase text-white/90">Limited Time Offer</span>
        </div>

        <h2 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-white tracking-tight mb-6 drop-shadow-2xl">
            <span class="bg-clip-text text-transparent bg-gradient-to-b from-white via-white to-white/60">
                {{ $activeSale->name }}
            </span>
        </h2>

        <p class="text-lg md:text-xl text-gray-400 max-w-2xl mb-12 leading-relaxed font-light">
            {{ $activeSale->description }}
        </p>

        <div id="sale-countdown" class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-14">
            @foreach (['Days' => 'days', 'Hours' => 'hours', 'Minutes' => 'minutes', 'Seconds' => 'seconds'] as $label => $id)
            <div class="relative group/card">
                <div class="w-32 h-36 md:w-40 md:h-44 flex flex-col items-center justify-center rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl shadow-xl transition-all duration-500 group-hover/card:-translate-y-2 group-hover/card:bg-white/10">
                    
                    <span id="{{ $id }}" class="text-5xl md:text-6xl font-bold text-white mb-1 tabular-nums tracking-tight">00</span>
                    
                    <span class="text-xs font-medium uppercase tracking-[0.2em] text-white/50 group-hover/card:text-white/80 transition-colors">
                        {{ $label }}
                    </span>

                    <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-white/10 group-hover/card:ring-white/30 transition-all"></div>
                </div>
            </div>
            @endforeach
        </div>

        <a href="{{ route('product', ['sale' => $activeSale->id]) }}" 
           class="group relative inline-flex items-center justify-center px-10 py-5 font-bold text-white transition-all duration-200 focus:outline-none">
            
            <div class="absolute inset-0 rounded-full bg-gradient-to-r from-[var(--primary-color,#ec4899)] to-[var(--secondary-color,#8b5cf6)] blur opacity-40 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="absolute inset-0 rounded-full bg-gradient-to-r from-[var(--primary-color,#ec4899)] to-[var(--secondary-color,#8b5cf6)]"></div>
            
            <span class="relative flex items-center gap-3">
                Shop Collection
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </span>
        </a>

    </div>
</section>

<script>
    // 1. COUNTDOWN LOGIC (Optimized)
    document.addEventListener('DOMContentLoaded', function () {
        const endDate = new Date("{{ $activeSale->ends_at->toIso8601String() }}").getTime();
        const elements = {
            days: document.getElementById('days'),
            hours: document.getElementById('hours'),
            minutes: document.getElementById('minutes'),
            seconds: document.getElementById('seconds')
        };

        const updateCountdown = () => {
            const now = new Date().getTime();
            const distance = endDate - now;

            if (distance <= 0) {
                document.getElementById("sale-countdown").innerHTML = "<div class='col-span-4 text-2xl text-white font-bold'>Sale Ended</div>";
                return;
            }

            const values = {
                days: Math.floor(distance / (1000 * 60 * 60 * 24)),
                hours: Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
                minutes: Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
                seconds: Math.floor((distance % (1000 * 60)) / 1000)
            };

            for (const [key, el] of Object.entries(elements)) {
                if (el) {
                    const strVal = String(values[key]).padStart(2, '0');
                    if (el.textContent !== strVal) el.textContent = strVal;
                }
            }
        };

        setInterval(updateCountdown, 1000);
        updateCountdown();

        // 2. MOUSE SPOTLIGHT LOGIC
        const card = document.getElementById('premium-sale-card');
        const spotlight = document.getElementById('spotlight');

        if(card && spotlight) {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                spotlight.style.setProperty('--x', `${x}px`);
                spotlight.style.setProperty('--y', `${y}px`);
            });
        }
    });
</script>

<style>
    /* Custom Animation for Background Blobs */
    @keyframes pulse-slow {
        0%, 100% { transform: scale(1) translate(0, 0); opacity: 0.3; }
        50% { transform: scale(1.1) translate(20px, -20px); opacity: 0.5; }
    }
    .animate-pulse-slow {
        animation: pulse-slow 8s infinite ease-in-out;
    }
</style>
@endif
 🌟 Premium Trust & Testimonials Section
<section class="relative overflow-hidden py-28 my-24 rounded-[3rem] bg-gradient-to-br from-gray-50 via-white to-gray-100 shadow-[0_0_80px_rgba(0,0,0,0.08)]">
    <!-- Floating gradient blobs -->
    <div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-gradient-to-br from-[var(--primary-color)]/30 to-[var(--accent-color)]/30 blur-[140px] rounded-full animate-pulse"></div>
    <div class="absolute -bottom-40 -right-40 w-[600px] h-[600px] bg-gradient-to-tr from-[var(--secondary-color)]/30 to-[var(--accent-color)]/20 blur-[180px] rounded-full animate-pulse"></div>

    <div class="container relative z-10 mx-auto px-6 text-center">
        <!-- Heading -->
        <h2 class="text-5xl md:text-6xl font-extrabold mb-6 bg-gradient-to-r from-[var(--primary-color)] via-[var(--accent-color)] to-[var(--secondary-color)] bg-clip-text text-transparent tracking-tight">
            Why Choose Us
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-16">
            We’re redefining the art of comfort and trust in home living.
        </p>

        <!-- Trust Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ([
                ['icon' => 'fa-shield-alt', 'title' => 'Premium Quality', 'desc' => 'Crafted with the finest materials and unmatched attention to detail.'],
                ['icon' => 'fa-truck', 'title' => 'Free Shipping', 'desc' => 'Enjoy fast, free delivery on all premium orders.'],
                ['icon' => 'fa-undo-alt', 'title' => 'Easy Returns', 'desc' => '30-day hassle-free returns, no questions asked.'],
                ['icon' => 'fa-headset', 'title' => '24/7 Support', 'desc' => 'We’re always here to help, anytime, anywhere.']
            ] as $trust)
            <div class="group relative p-10 rounded-3xl bg-white/30 backdrop-blur-xl border border-white/40 
                        shadow-[0_0_40px_rgba(0,0,0,0.05)] hover:shadow-[0_0_80px_rgba(0,0,0,0.1)]
                        transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-t from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10 flex flex-col items-center text-center space-y-4">
                    <div class="text-5xl text-[var(--primary-color)] group-hover:text-[var(--secondary-color)] transition-colors duration-500">
                        <i class="fas {{ $trust['icon'] }}"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $trust['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $trust['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
<!-- 
    <div class="relative mt-32">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-8 bg-gradient-to-r from-[var(--primary-color)] via-[var(--accent-color)] to-[var(--secondary-color)] bg-clip-text text-transparent">
                What Our Customers Say
            </h2>
            <p class="text-lg text-gray-600 mb-16 max-w-2xl mx-auto">Trusted by thousands of happy customers across the globe.</p>

            <div class="relative max-w-5xl mx-auto overflow-hidden">
                <div id="testimonialsTrack" class="flex transition-transform duration-700 ease-in-out">
                    <div class="testimonial-card min-w-full px-8">
                        <div class="p-10 rounded-3xl bg-white/40 backdrop-blur-xl border border-white/40 shadow-[0_0_50px_rgba(0,0,0,0.08)]">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah Johnson" class="w-20 h-20 rounded-full mx-auto mb-6 shadow-md">
                            <p class="text-gray-700 italic mb-4">“The quality exceeded my expectations. Delivery was quick, and setup was seamless!”</p>
                            <h4 class="font-semibold text-gray-900">Sarah Johnson</h4>
                            <p class="text-sm text-gray-500">Interior Designer</p>
                        </div>
                    </div>

                    <div class="testimonial-card min-w-full px-8">
                        <div class="p-10 rounded-3xl bg-white/40 backdrop-blur-xl border border-white/40 shadow-[0_0_50px_rgba(0,0,0,0.08)]">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen" class="w-20 h-20 rounded-full mx-auto mb-6 shadow-md">
                            <p class="text-gray-700 italic mb-4">“I was hesitant to buy online, but the quality and service are top-notch!”</p>
                            <h4 class="font-semibold text-gray-900">Michael Chen</h4>
                            <p class="text-sm text-gray-500">Architect</p>
                        </div>
                    </div>

                    <div class="testimonial-card min-w-full px-8">
                        <div class="p-10 rounded-3xl bg-white/40 backdrop-blur-xl border border-white/40 shadow-[0_0_50px_rgba(0,0,0,0.08)]">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emma Rodriguez" class="w-20 h-20 rounded-full mx-auto mb-6 shadow-md">
                            <p class="text-gray-700 italic mb-4">“Exceptional customer service and design help — made my dream living room!”</p>
                            <h4 class="font-semibold text-gray-900">Emma Rodriguez</h4>
                            <p class="text-sm text-gray-500">Home Stager</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-10 space-x-3">
                    <div class="dot w-3 h-3 rounded-full bg-gray-400 cursor-pointer" data-index="0"></div>
                    <div class="dot w-3 h-3 rounded-full bg-gray-300 cursor-pointer" data-index="1"></div>
                    <div class="dot w-3 h-3 rounded-full bg-gray-300 cursor-pointer" data-index="2"></div>
                </div>
            </div>
        </div>
    </div> -->
</section>

<!-- GSAP + Slider Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    gsap.from(".trust-card, .testimonial-card", {
        opacity: 0,
        y: 80,
        duration: 1.2,
        stagger: 0.2,
        ease: "power3.out"
    });

    // Auto slider
    const track = document.getElementById("testimonialsTrack");
    const dots = document.querySelectorAll(".dot");
    let current = 0;
    function showSlide(i) {
        track.style.transform = `translateX(-${i * 100}%)`;
        dots.forEach(d => d.classList.remove("bg-gray-400"));
        dots[i].classList.add("bg-gray-400");
        current = i;
    }
    dots.forEach((dot, i) => dot.addEventListener("click", () => showSlide(i)));
    setInterval(() => showSlide((current + 1) % 3), 5000);
});
</script>

  
@endsection

@push("script")
<script>
    // Initialize AOS (Animate On Scroll)
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
        
        // Quick view button functionality
        document.querySelectorAll('.quick-view-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Quick view feature would open a modal with product details');
            });
        });
        
        // Wishlist button functionality
        document.querySelectorAll('.wishlist-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const icon = this.querySelector('svg');
                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas', 'text-red-500');
                } else {
                    icon.classList.remove('fas', 'text-red-500');
                    icon.classList.add('far');
                }
            });
        });
        
        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const originalContent = this.innerHTML;
                this.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                
                setTimeout(() => {
                    this.innerHTML = originalContent;
                }, 1500);
            });
        });
    });
</script>
@endpush