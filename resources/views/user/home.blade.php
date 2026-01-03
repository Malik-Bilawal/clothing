@extends("user.layouts.master-layouts.plain")

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<title>Home Collection | Premium Home Essentials</title>

@push("style")
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
    --surface-light: #FFFCF9;
}

* {
    font-family: 'Inter', sans-serif;
}

h1, h2, h3, h4, h5, h6 {
    font-family: 'Playfair Display', serif;
}

/* Modern Scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: var(--background-color);
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 5px;
}

/* Custom Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(10deg);
    }
}

@keyframes shimmer {
    0% {
        background-position: -1000px 0;
    }
    100% {
        background-position: 1000px 0;
    }
}

@keyframes marquee {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
}

.animate-marquee {
    animation: marquee 30s linear infinite;
}

/* Premium Glass Effect */
.glass-effect {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.premium-gradient {
    background: linear-gradient(135deg, 
        rgba(107, 66, 38, 0.1) 0%,
        rgba(200, 161, 101, 0.1) 50%,
        rgba(140, 94, 60, 0.1) 100%);
}

.premium-text-gradient {
    background: linear-gradient(135deg, 
        var(--primary-color) 0%,
        var(--secondary-color) 50%,
        var(--accent-color) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Premium Card Hover Effects */
.premium-card {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    background: var(--surface-light);
    position: relative;
    overflow: hidden;
}

.premium-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.4), 
        transparent);
    transition: left 0.7s;
}

.premium-card:hover::before {
    left: 100%;
}

.premium-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(107, 66, 38, 0.15),
                0 5px 15px rgba(200, 161, 101, 0.1);
}

/* Modern Button Styles */
.btn-modern {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, 
        var(--primary-color) 0%,
        var(--accent-color) 100%);
    color: white;
    border: none;
    padding: 14px 32px;
    border-radius: 50px;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.4s ease;
    isolation: isolate;
}

.btn-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.3), 
        transparent);
    transition: left 0.6s;
}

.btn-modern:hover::before {
    left: 100%;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(107, 66, 38, 0.3);
}

.btn-modern-outline {
    background: transparent;
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    padding: 12px 30px;
}

.btn-modern-outline:hover {
    background: var(--primary-color);
    color: white;
}


/* Premium Trust Cards */
.trust-card-modern {
    background: white;
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
    border: 1px solid var(--border-color);
    transition: all 0.4s ease;
}

.trust-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, 
        var(--primary-color),
        var(--secondary-color),
        var(--accent-color));
    opacity: 0;
    transition: opacity 0.4s;
}

.trust-card-modern:hover::before {
    opacity: 1;
}

.trust-card-modern:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(107, 66, 38, 0.1);
}

/* Modern Testimonial Card */
.modern-testimonial-card {
    background: white;
    border-radius: 24px;
    padding: 40px;
    position: relative;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--border-color);
}

.modern-testimonial-card::before {
    content: '"';
    position: absolute;
    top: 20px;
    left: 40px;
    font-size: 120px;
    font-family: 'Playfair Display', serif;
    color: var(--secondary-color);
    opacity: 0.1;
}

/* Custom Utility Classes */
.text-balance {
    text-wrap: balance;
}

.perspective-1000 {
    perspective: 1000px;
}

.hover-lift {
    transition: transform 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
}

/* Loading Skeleton */
.skeleton {
    background: linear-gradient(90deg, 
        rgba(248, 245, 242, 1) 0%, 
        rgba(255, 255, 255, 0.8) 50%, 
        rgba(248, 245, 242, 1) 100%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
}

/* Parallax Sections */
.parallax-section {
    position: relative;
    overflow: hidden;
}

.parallax-bg {
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background-size: cover;
    background-position: center;
    transform: translateZ(0);
    will-change: transform;
}

/* Modern Navigation Effects */
.nav-link-modern {
    position: relative;
    padding: 10px 0;
}

.nav-link-modern::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--secondary-color);
    transition: width 0.3s ease;
}

.nav-link-modern:hover::after {
    width: 100%;
}

/* Premium Badge */
.premium-badge {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 1px;
    display: inline-block;
    position: relative;
    overflow: hidden;
}

.premium-badge::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.4), 
        transparent);
    transition: left 0.5s;
}

.premium-badge:hover::before {
    left: 100%;
}

/* Modern Input Fields */
.input-modern {
    background: rgba(255, 255, 255, 0.9);
    border: 2px solid var(--border-color);
    border-radius: 12px;
    padding: 15px 20px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.input-modern:focus {
    outline: none;
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 3px rgba(200, 161, 101, 0.2);
}
</style>
@endpush

@section("content")
<!-- Modern Hero Banner with Parallax -->
<section class="relative h-screen w-full overflow-hidden bg-[var(--primary-color)] text-[var(--text-on-primary)]" 
         x-data="{ 
            activeSlide: 0, 
            slides: {{ $banners->count() }},
            timer: null,
            startTimer() {
                this.timer = setInterval(() => {
                    this.activeSlide = (this.activeSlide === this.slides - 1) ? 0 : this.activeSlide + 1;
                }, 6000);
            }
         }" 
         x-init="startTimer()"
         @mouseenter="clearInterval(timer)" 
         @mouseleave="startTimer()">

    <div class="absolute inset-0 z-20 pointer-events-none opacity-[0.08]" 
         style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.7%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22 opacity=%221%22/%3E%3C/svg%3E');">
    </div>

    <div class="absolute inset-0 z-10 pointer-events-none container mx-auto border-x border-white/5">
        <div class="h-full w-full grid grid-cols-4 lg:grid-cols-12">
            <div class="hidden lg:block col-span-3 border-r border-white/5 h-full"></div>
            <div class="hidden lg:block col-span-6 border-r border-white/5 h-full"></div>
        </div>
    </div>

    @foreach($banners as $index => $banner)
        <div x-show="activeSlide === {{ $index }}" 
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-1000"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 z-0">
            
            <div class="relative w-full h-full overflow-hidden">
                @if($banner->type === 'video' && $banner->video)
                    <video autoplay loop muted playsinline 
                           class="absolute inset-0 w-full h-full object-cover transform scale-105 transition-transform duration-[10s] ease-linear"
                           :class="{ 'scale-110': activeSlide === {{ $index }}, 'scale-100': activeSlide !== {{ $index }} }">
                        <source src="{{ asset($banner->video) }}" type="video/mp4">
                    </video>
                @else
                    <div class="absolute inset-0 bg-cover bg-center transform transition-transform duration-[10s] ease-linear"
                         :class="{ 'scale-110': activeSlide === {{ $index }}, 'scale-100': activeSlide !== {{ $index }} }"
                         style="background-image: url('{{ asset('storage/' . $banner->image) }}')">
                    </div>
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/20 to-transparent mix-blend-multiply"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
            </div>

            <div class="absolute inset-0 flex items-center z-30">
                <div class="container mx-auto px-6 md:px-12">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                        
                        <div class="lg:col-span-9 flex flex-col items-start">
                            
                            <div class="overflow-hidden mb-6">
                                <span class="block text-xs font-mono uppercase tracking-[0.3em] text-[var(--secondary-color)] transform transition-transform duration-700 delay-300 translate-y-full"
                                      :class="{ '!translate-y-0': activeSlide === {{ $index }} }">
                                     {{ $banner->badge }}
                                </span>
                            </div>

                            <div class="overflow-hidden mb-8">
                                <h1 class="text-6xl md:text-8xl lg:text-9xl font-serif font-medium leading-[0.85] tracking-tight transform transition-transform duration-1000 delay-300 translate-y-full"
                                    :class="{ '!translate-y-0': activeSlide === {{ $index }} }">
                                    {{ $banner->title }}
                                </h1>
                            </div>

                            <div class="flex items-start gap-6 max-w-xl transform transition-all duration-1000 delay-500 opacity-0 translate-y-10"
                                 :class="{ '!opacity-100 !translate-y-0': activeSlide === {{ $index }} }">
                                <div class="w-12 h-px bg-[var(--secondary-color)] mt-4 hidden md:block"></div>
                                <p class="text-lg md:text-xl font-light text-white/80 leading-relaxed">
                                    {{ $banner->description }}
                                </p>
                            </div>

                          

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="absolute bottom-0 left-0 w-full z-40 border-t border-white/10 bg-black/20 backdrop-blur-sm">
        <div class="container mx-auto px-6 md:px-12 flex flex-col md:flex-row items-center justify-between h-20">
            
            <div class="flex items-center gap-6">
                <span class="text-sm font-mono text-white/50">01</span>
                
                <div class="flex gap-0">
                    @foreach($banners as $index => $banner)
                        <button @click="activeSlide = {{ $index }}" 
                                class="relative w-12 h-12 flex items-center justify-center group focus:outline-none">
                            <span class="absolute inset-0 border-t-2 transition-all duration-500"
                                  :class="{ 'border-[var(--secondary-color)] w-full': activeSlide === {{ $index }}, 'border-white/20 w-full group-hover:border-white/50': activeSlide !== {{ $index }} }"></span>
                        </button>
                    @endforeach
                </div>
                
                <span class="text-sm font-mono text-white/50">0{{ $banners->count() }}</span>
            </div>

            <div class="hidden md:flex flex-1 justify-end overflow-hidden ml-12">
                <div class="animate-marquee whitespace-nowrap flex gap-8 opacity-60">
                    <span class="text-xs font-mono uppercase tracking-[0.3em] text-white/70">World Wide Shipping</span>
                    <span class="text-xs font-mono text-[var(--secondary-color)]">•</span>
                    <span class="text-xs font-mono uppercase tracking-[0.3em] text-white/70">New Season 2024</span>
                    <span class="text-xs font-mono text-[var(--secondary-color)]">•</span>
                    <span class="text-xs font-mono uppercase tracking-[0.3em] text-white/70">Limited Editions</span>
                </div>
            </div>

        </div>
    </div>

    <div class="absolute top-1/2 left-6 md:left-12 transform -translate-y-1/2 -rotate-90 origin-left hidden lg:block z-40 mix-blend-difference">
        <span class="text-xs font-mono uppercase tracking-[0.5em] text-white/60">
            Scroll to Explore
        </span>
    </div>

</section>

<style>
/* Ken Burns Effect Logic */
.scale-110 { transform: scale(1.1); }
.scale-100 { transform: scale(1); }
</style>

<!-- Premium Categories Section -->
<section class="py-24 bg-[var(--background-color)] relative overflow-hidden">
    
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-full bg-[var(--border-color)] opacity-50"></div>

    <div class="container relative mx-auto px-6 md:px-12">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 border-b border-[var(--border-color)] pb-8">
            <div class="max-w-xl">
                <span class="block text-xs font-mono uppercase tracking-[0.25em] text-[var(--secondary-color)] mb-4">
                    // The Collections
                </span>
                <h2 class="text-5xl md:text-7xl font-serif text-[var(--primary-color)] leading-[0.9]">
                    Curated <br> <span class="italic text-[var(--secondary-color)]">Essentials</span>
                </h2>
            </div>
            <div class="hidden md:block mb-2">
                <a href="#" class="group inline-flex items-center text-sm font-mono uppercase tracking-widest text-[var(--primary-color)]">
                    <span class="border-b border-transparent group-hover:border-[var(--primary-color)] transition-all duration-300">View All Categories</span>
                    <svg class="w-4 h-4 ml-2 transform -rotate-45 group-hover:rotate-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-16 gap-x-8">
            @foreach($categories as $index => $category)
                <a href="{{ route('product', ['category_id' => $category->id]) }}" class="group block relative w-full cursor-pointer">
                    
                    <div class="relative w-full aspect-[3/4] overflow-hidden bg-[var(--primary-color)]">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60 z-10 transition-opacity duration-500 group-hover:opacity-40"></div>
                        
                        <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800' }}"
                             alt="{{ $category->name }}"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110 grayscale-[20%] group-hover:grayscale-0">
                             
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 opacity-0 group-hover:opacity-100 transition-all duration-500 transform scale-50 group-hover:scale-100">
                            <div class="w-24 h-24 rounded-full bg-white/10 backdrop-blur-md border border-white/30 flex items-center justify-center">
                                <span class="text-white text-xs font-mono uppercase tracking-widest">Explore</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-[var(--border-color)] pt-4 group-hover:border-[var(--secondary-color)] transition-colors duration-500">
                        <div class="flex justify-between items-start">
                            
                            <span class="text-xs font-mono text-[var(--secondary-color)] uppercase tracking-widest">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>

                            <div class="flex-1 text-right pl-8">
                                <h3 class="text-3xl font-serif text-[var(--primary-color)] group-hover:text-[var(--secondary-color)] transition-colors duration-300">
                                    {{ $category->name }}
                                </h3>
                                
                                <div class="overflow-hidden h-6 mt-2">
                                    <p class="text-sm text-[var(--primary-color)]/60 font-light transform translate-y-0 group-hover:-translate-y-full transition-transform duration-500">
                                        {{ Str::limit($category->description ?? 'Exclusive Collection', 40) }}
                                    </p>
                                    <p class="text-sm text-[var(--secondary-color)] font-mono uppercase tracking-widest transform translate-y-full group-hover:-translate-y-full transition-transform duration-500">
                                        Shop Now &rarr;
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
<section class="py-24 bg-[var(--background-color)]">
    <div class="container mx-auto px-6">
        
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 mb-6 text-[11px] font-bold tracking-[0.3em] uppercase text-[var(--secondary-color)] border border-[var(--border-color)] rounded-full">
                The Collection
            </span>
            <h2 class="text-4xl md:text-5xl font-serif font-light mb-6 text-[var(--primary-color)]">
                Editor's Selection
            </h2>
            <div class="w-16 h-px bg-[var(--secondary-color)] mx-auto mb-6"></div>
            <p class="text-neutral-600 max-w-xl mx-auto leading-relaxed">
                Handpicked pieces that define luxury living, curated for the discerning homeowner.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
        @foreach ($products as $product)
    @include('user.partials.home-product-cards', ['product' => $product])
@endforeach
        </div>

        <div class="mt-20 text-center" data-aos="fade-up">
            <a href="{{ route('product') }}" class="relative inline-flex items-center gap-4 group">
                <span class="text-sm font-bold uppercase tracking-[0.3em] text-[var(--primary-color)]">
                    Explore Entire Collection
                </span>
                <div class="w-12 h-px bg-[var(--primary-color)] transition-all group-hover:w-20"></div>
                <svg class="w-5 h-5 text-[var(--primary-color)] transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@if($activeSale = $sale->first())
<section class="relative min-h-[90vh] flex items-center bg-[var(--primary-color)] overflow-hidden py-20">

    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute inset-0" style="background: radial-gradient(circle at 70% 50%, rgba(200,161,101,0.12) 0%, transparent 70%);"></div>
        <div class="absolute inset-0 opacity-[0.05] mix-blend-overlay" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    </div>

    <div class="container relative z-10 mx-auto px-6 lg:px-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-20 items-center">
            
            <div class="lg:col-span-6" data-aos="fade-right">
                <div class="mb-10">
                    <span class="inline-block uppercase tracking-[0.6em] text-[10px] font-bold text-[var(--secondary-color)] mb-6 border-b border-[var(--secondary-color)] pb-2">
                        Private Invitation
                    </span>
                    <h2 class="text-7xl md:text-9xl font-serif text-white leading-[0.8] mb-8">
                        {{ $activeSale->name }}
                    </h2>
                    <div class="w-20 h-px bg-[var(--secondary-color)] my-10"></div>
                    <p class="text-white opacity-60 text-lg font-light leading-relaxed max-w-md italic">
                        "{{ $activeSale->description }}"
                    </p>
                </div>

                <a href="{{ route('product', ['sale' => $activeSale->id]) }}" 
                   class="group inline-flex items-center gap-6">
                    <div class="w-16 h-16 rounded-full border border-white/20 flex items-center justify-center group-hover:bg-[var(--secondary-color)] group-hover:border-[var(--secondary-color)] transition-all duration-500">
                        <svg class="w-5 h-5 text-white transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                    <span class="uppercase tracking-[0.4em] text-xs font-bold text-white group-hover:text-[var(--secondary-color)] transition-colors">
                        Enter the Event
                    </span>
                </a>
            </div>

            <div class="lg:col-span-6 flex justify-center lg:justify-end" data-aos="fade-left">
                <div class="relative w-full max-w-md">
                    <div class="absolute -inset-4 border border-[var(--secondary-color)]/20 pointer-events-none"></div>
                    
                    <div id="timer-container" class="relative bg-[var(--primary-color)] p-10 md:p-16 opacity-0 transition-opacity duration-1000">
                        
                        <div class="text-center mb-12">
                            <h4 class="text-[10px] uppercase tracking-[0.5em] text-[var(--secondary-color)]">Closing Soon</h4>
                        </div>

                        <div class="grid grid-cols-2 gap-y-12 gap-x-8">
                            <div class="flex flex-col items-center">
                                <span id="days" class="text-6xl md:text-7xl font-serif font-light text-white">00</span>
                                <span class="text-[9px] uppercase tracking-[0.3em] text-[var(--secondary-color)] mt-4">Days</span>
                            </div>
                            <div class="flex flex-col items-center border-l border-white/5">
                                <span id="hours" class="text-6xl md:text-7xl font-serif font-light text-white">00</span>
                                <span class="text-[9px] uppercase tracking-[0.3em] text-[var(--secondary-color)] mt-4">Hours</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <span id="minutes" class="text-6xl md:text-7xl font-serif font-light text-white">00</span>
                                <span class="text-[9px] uppercase tracking-[0.3em] text-[var(--secondary-color)] mt-4">Minutes</span>
                            </div>
                            <div class="flex flex-col items-center border-l border-white/5 relative">
                                <div class="absolute top-0 right-0 w-1 h-1 bg-[var(--secondary-color)] rounded-full animate-ping"></div>
                                <span id="seconds" class="text-6xl md:text-7xl font-serif font-light text-[var(--secondary-color)]">00</span>
                                <span class="text-[9px] uppercase tracking-[0.3em] text-white/40 mt-4">Seconds</span>
                            </div>
                        </div>

                        <div class="mt-16 text-center">
                            <p class="text-[10px] text-white/20 uppercase tracking-[0.2em]">Limited Collection Access</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    (function() {
        const countDownDate = {{ \Carbon\Carbon::parse($activeSale->ends_at)->timestamp * 1000 }};
        const timerContainer = document.getElementById("timer-container");
        const daysEl = document.getElementById("days");
        const hoursEl = document.getElementById("hours");
        const minutesEl = document.getElementById("minutes");
        const secondsEl = document.getElementById("seconds");

        function updateTimer() {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            if (distance < 0) {
                clearInterval(interval);
                timerContainer.innerHTML = "<div class='py-20 text-center text-[var(--secondary-color)] text-xl font-serif tracking-[0.3em] uppercase'>The Event has Concluded</div>";
                timerContainer.classList.remove('opacity-0');
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const pad = (n) => n < 10 ? '0' + n : n;

            if (daysEl) {
                daysEl.innerText = pad(days);
                hoursEl.innerText = pad(hours);
                minutesEl.innerText = pad(minutes);
                secondsEl.innerText = pad(seconds);
            }
            timerContainer.classList.remove('opacity-0');
        }
        updateTimer();
        const interval = setInterval(updateTimer, 1000);
    })();
</script>
@endif
<section class="py-32 bg-white border-y border-[var(--border-color)]">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row justify-between items-end mb-20 gap-8">
            <div class="max-w-2xl" data-aos="fade-right">
                <span class="text-[11px] font-bold tracking-[0.4em] text-[var(--secondary-color)] uppercase block mb-4">Our Philosophy</span>
                <h2 class="text-5xl md:text-7xl font-serif text-[var(--primary-color)] leading-tight">
                    The Art of <br><span class="italic text-[var(--secondary-color)]">Refined</span> Living
                </h2>
            </div>
            <div class="lg:w-1/3" data-aos="fade-left">
                <p class="text-neutral-500 leading-relaxed border-l-2 border-[var(--secondary-color)] pl-6">
                    We don't just manufacture; we curate. Every piece is a testament to the dialogue between raw materials and human precision.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 border-t border-l border-[var(--border-color)]">
            @foreach([
                ['num' => '01', 'title' => 'Ethical Sourcing', 'desc' => 'Hand-selected timber and fabrics from sustainable, certified forests.'],
                ['num' => '02', 'title' => 'Master Craft', 'desc' => 'Assembled by artisans with over two decades of experience in joinery.'],
                ['num' => '03', 'title' => 'Global White-Glove', 'desc' => 'Complimentary premium delivery including room-of-choice setup.'],
                ['num' => '04', 'title' => 'Lifetime Promise', 'desc' => 'A testament to quality: our frames carry a lifetime structural warranty.']
            ] as $trust)
            <div class="p-10 border-r border-b border-[var(--border-color)] group hover:bg-[var(--background-color)] transition-colors duration-500">
                <span class="text-sm font-serif italic text-[var(--secondary-color)] mb-8 block">{{ $trust['num'] }}</span>
                <h3 class="text-lg font-bold text-[var(--primary-color)] mb-4 tracking-tight uppercase">{{ $trust['title'] }}</h3>
                <p class="text-neutral-500 text-sm leading-relaxed">{{ $trust['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-32 bg-[var(--background-color)]">
    <div class="container mx-auto px-6">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                
                <div class="hidden lg:block lg:col-span-1 text-8xl font-serif text-[var(--secondary-color)] opacity-30">
                    “
                </div>

                <div class="lg:col-span-11">
                    <div class="space-y-12">
                        @foreach([
                            ['name' => 'Sarah Johnson', 'role' => 'Interior Architect', 'text' => 'The silhouettes are timeless. It is rare to find a brand that balances modern structural integrity with such warm, organic aesthetics.'],
                        ] as $testimonial)
                        <div class="space-y-8" data-aos="fade-up">
                            <p class="text-3xl md:text-4xl font-serif italic text-[var(--primary-color)] leading-snug">
                                {{ $testimonial['text'] }}
                            </p>
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-px bg-[var(--secondary-color)]"></div>
                                <div>
                                    <h4 class="font-bold text-[var(--primary-color)] uppercase tracking-widest text-xs">{{ $testimonial['name'] }}</h4>
                                    <p class="text-[var(--secondary-color)] text-[10px] uppercase tracking-widest mt-1">{{ $testimonial['role'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push("script")
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<script>
// Initialize AOS
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100,
        easing: 'ease-out-cubic'
    });

    // Initialize GSAP ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);

    // Parallax effect for hero background
    gsap.to('.parallax-bg', {
        yPercent: 30,
        ease: "none",
        scrollTrigger: {
            trigger: '.hero-section',
            start: "top top",
            end: "bottom top",
            scrub: true
        }
    });

    // Stagger animations for product cards
    gsap.from('.modern-product-card', {
        scrollTrigger: {
            trigger: '.modern-product-card:first-child',
            start: "top 80%",
            toggleActions: "play none none reverse"
        },
        y: 50,
        opacity: 0,
        stagger: 0.1,
        duration: 0.8,
        ease: "power2.out"
    });

    // Sale countdown timer
    @if($activeSale = $sale->first())
    const endDate = new Date("{{ $activeSale->ends_at->toIso8601String() }}").getTime();
    
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = endDate - now;
        
        if (distance <= 0) {
            document.querySelector('.modern-sale-timer').innerHTML = `
                <div class="text-3xl font-bold text-white text-center py-8">
                    Sale Ended
                </div>
            `;
            return;
        }
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        document.getElementById('days').textContent = String(days).padStart(2, '0');
        document.getElementById('hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
    }
    
    setInterval(updateCountdown, 1000);
    updateCountdown();
    @endif

    // Hover tilt effect for cards
    const cards = document.querySelectorAll('.premium-card');
    cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateY = (x - centerX) / 25;
            const rotateX = (centerY - y) / 25;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(-10px)';
        });
    });

    // Product image zoom on hover
    const productImages = document.querySelectorAll('.product-image img');
    productImages.forEach(img => {
        img.parentElement.addEventListener('mouseenter', () => {
            img.style.transform = 'scale(1.1)';
        });
        
        img.parentElement.addEventListener('mouseleave', () => {
            img.style.transform = 'scale(1)';
        });
    });

    // Add to cart animation
    document.querySelectorAll('.modern-product-card button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const originalText = this.innerHTML;
            
            // Animation
            gsap.to(this, {
                scale: 0.95,
                duration: 0.1,
                yoyo: true,
                repeat: 1,
                onComplete: () => {
                    this.innerHTML = '<svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 1500);
                }
            });
            
            // Show notification
            showNotification('Product added to cart!');
        });
    });

    // Wishlist functionality
    document.querySelectorAll('.product-actions button:first-child').forEach(btn => {
        btn.addEventListener('click', function() {
            const icon = this.querySelector('svg');
            const isActive = icon.style.fill === 'currentColor';
            
            gsap.to(this, {
                scale: 1.2,
                duration: 0.2,
                yoyo: true,
                repeat: 1
            });
            
            if (isActive) {
                icon.style.fill = 'none';
                showNotification('Removed from wishlist');
            } else {
                icon.style.fill = 'currentColor';
                showNotification('Added to wishlist');
            }
        });
    });

    // Notification function
    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'fixed top-6 right-6 bg-white shadow-xl rounded-xl p-4 border-l-4 border-[var(--secondary-color)] z-50';
        notification.innerHTML = `
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-[var(--secondary-color)]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-800 font-medium">${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        gsap.from(notification, {
            x: 100,
            opacity: 0,
            duration: 0.3
        });
        
        // Remove after 3 seconds
        setTimeout(() => {
            gsap.to(notification, {
                x: 100,
                opacity: 0,
                duration: 0.3,
                onComplete: () => notification.remove()
            });
        }, 3000);
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                gsap.to(window, {
                    duration: 1,
                    scrollTo: target,
                    ease: "power2.inOut"
                });
            }
        });
    });

    // Animate floating elements
    gsap.to('.animate-float', {
        y: -20,
        duration: 2,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
    });
});

// Mouse move spotlight effect
document.addEventListener('mousemove', (e) => {
    const spotlight = document.createElement('div');
    spotlight.style.cssText = `
        position: fixed;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle at ${e.clientX}px ${e.clientY}px, 
            rgba(200, 161, 101, 0.1) 0%, 
            transparent 50%);
        pointer-events: none;
        z-index: 9999;
        top: 0;
        left: 0;
        mix-blend-mode: screen;
    `;
    document.body.appendChild(spotlight);
    
    // Remove old spotlights
    const oldSpotlights = document.querySelectorAll('body > div[style*="radial-gradient"]');
    if (oldSpotlights.length > 3) {
        oldSpotlights[0].remove();
    }
    
    setTimeout(() => spotlight.remove(), 1000);
});
</script>
@endpush