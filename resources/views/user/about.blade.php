@extends("user.layouts.master-layouts.plain")

@section("title", "Home Collection | About Us")

@push("style")
<style>
    /* Define CSS variables */
    :root {
        --primary-color: #680626;
        --primary-hover: #52041E;
        --secondary-color: #B89A6B;
        --secondary-hover: #967B52;
        --card-background: #FFFFFF;
        --accent-color: #D6CEC3;
        --accent-hover: #C8BFB3;
        --text-on-primary: #FFFFFF;
        --text-on-secondary: #2A2A2A;
        --background-color: #FBF7EE;
        --surface-color: #FFFFFF;
        --border-color: #E2DBD1;
    }

    /* Custom animations */
    @keyframes float {
        0% {
            transform: translate(0, 0) rotate(0deg);
        }
        33% {
            transform: translate(30px, -50px) rotate(120deg);
        }
        66% {
            transform: translate(-20px, 20px) rotate(240deg);
        }
        100% {
            transform: translate(0, 0) rotate(360deg);
        }
    }

    .animate-float {
        animation: float 20s infinite linear;
    }

    .animate-float-delay-5 {
        animation: float 25s infinite linear;
        animation-delay: -5s;
    }

    .animate-float-delay-10 {
        animation: float 30s infinite linear;
        animation-delay: -10s;
    }

    /* Button hover effect */
    .modern-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .modern-btn:hover::before {
        left: 100%;
    }

    /* Scroll animation */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endpush

@section("content")
<!-- Modern Hero Section -->
<section class="relative min-h-[85vh] bg-gradient-to-br from-[#680626] via-[#680626] to-[#52041E] bg-cover bg-center bg-fixed overflow-hidden"
         style="background-image: linear-gradient(135deg, rgba(104, 6, 38, 0.95) 0%, rgba(82, 4, 30, 0.85) 100%), url('https://images.unsplash.com/photo-1615529328331-f8917597711f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80')">
    
    <!-- Floating Elements -->
    <div class="absolute top-[10%] right-[5%] w-[300px] h-[300px] rounded-full bg-[rgba(184,154,107,0.1)] border border-[rgba(184,154,107,0.2)] backdrop-blur-sm animate-float"></div>
    <div class="absolute bottom-[15%] left-[10%] w-[200px] h-[200px] rounded-full bg-[rgba(184,154,107,0.1)] border border-[rgba(184,154,107,0.2)] backdrop-blur-sm animate-float-delay-5"></div>
    <div class="absolute top-[40%] left-[15%] w-[150px] h-[150px] rounded-full bg-[rgba(184,154,107,0.1)] border border-[rgba(184,154,107,0.2)] backdrop-blur-sm animate-float-delay-10"></div>
    
    <div class="container mx-auto px-4 relative z-10 flex items-center min-h-[85vh]">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight">
                <span class="bg-gradient-to-r from-[#D6CEC3] via-[#B89A6B] to-[#D6CEC3] bg-clip-text text-transparent">
                    Redefining Home<br>
                </span>
                <span class="text-white">Experiences</span>
            </h1>
            <p class="text-xl text-white/90 mb-10 max-w-2xl font-light leading-relaxed">
                We blend traditional craftsmanship with contemporary design to create 
                home essentials that tell stories of comfort, quality, and timeless elegance.
            </p>
            <div class="flex flex-wrap gap-6">
                <a href="/shop" class="relative modern-btn inline-flex items-center gap-3 px-9 py-5 text-lg font-semibold text-white rounded-full bg-gradient-to-r from-[#B89A6B] to-[#680626] shadow-lg shadow-[#680626]/30 transition-all duration-400 hover:shadow-xl hover:shadow-[#680626]/40 hover:-translate-y-1 overflow-hidden">
                    <i class="fas fa-shopping-bag"></i>
                    Explore Collection
                </a>
                <a href="#our-story" class="inline-flex items-center gap-3 px-9 py-5 text-lg font-semibold text-white rounded-full border-2 border-white transition-all duration-400 hover:bg-white/10">
                    <i class="fas fa-play-circle"></i>
                    Our Story
                </a>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
        <div class="animate-bounce">
            <i class="fas fa-chevron-down text-white text-2xl"></i>
        </div>
    </div>
</section>

<!-- Modern Stats -->
<section class="bg-gradient-to-br from-white to-[#FBF7EE] py-24">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-[#680626]/10 transition-all duration-400 hover:-translate-y-5 hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden">
                <div class="absolute -top-5 -right-5 w-20 h-20 bg-[#FBF7EE] rounded-full flex items-center justify-center text-[#680626] text-3xl opacity-70">
                    <i class="fas fa-award"></i>
                </div>
                <div class="text-6xl font-extrabold mb-4 bg-gradient-to-r from-[#680626] to-[#B89A6B] bg-clip-text text-transparent">
                    13+
                </div>
                <div class="text-lg font-medium text-[#2A2A2A]">Years of Excellence</div>
                <p class="text-gray-600 mt-4">Dedicated to quality since 2010</p>
            </div>
            
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-[#680626]/10 transition-all duration-400 hover:-translate-y-5 hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden" style="transition-delay: 0.1s">
                <div class="absolute -top-5 -right-5 w-20 h-20 bg-[#FBF7EE] rounded-full flex items-center justify-center text-[#680626] text-3xl opacity-70">
                    <i class="fas fa-smile"></i>
                </div>
                <div class="text-6xl font-extrabold mb-4 bg-gradient-to-r from-[#680626] to-[#B89A6B] bg-clip-text text-transparent">
                    50K+
                </div>
                <div class="text-lg font-medium text-[#2A2A2A]">Happy Families</div>
                <p class="text-gray-600 mt-4">Transforming homes nationwide</p>
            </div>
            
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-[#680626]/10 transition-all duration-400 hover:-translate-y-5 hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden" style="transition-delay: 0.2s">
                <div class="absolute -top-5 -right-5 w-20 h-20 bg-[#FBF7EE] rounded-full flex items-center justify-center text-[#680626] text-3xl opacity-70">
                    <i class="fas fa-gem"></i>
                </div>
                <div class="text-6xl font-extrabold mb-4 bg-gradient-to-r from-[#680626] to-[#B89A6B] bg-clip-text text-transparent">
                    500+
                </div>
                <div class="text-lg font-medium text-[#2A2A2A]">Premium Products</div>
                <p class="text-gray-600 mt-4">Curated with meticulous care</p>
            </div>
            
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-[#680626]/10 transition-all duration-400 hover:-translate-y-5 hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden" style="transition-delay: 0.3s">
                <div class="absolute -top-5 -right-5 w-20 h-20 bg-[#FBF7EE] rounded-full flex items-center justify-center text-[#680626] text-3xl opacity-70">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="text-6xl font-extrabold mb-4 bg-gradient-to-r from-[#680626] to-[#B89A6B] bg-clip-text text-transparent">
                    100%
                </div>
                <div class="text-lg font-medium text-[#2A2A2A]">Eco-Friendly</div>
                <p class="text-gray-600 mt-4">Sustainable sourcing & practices</p>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section id="our-story" class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-20">
            <span class="inline-block px-5 py-2 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] text-[#680626] text-sm font-semibold tracking-widest uppercase rounded-full mb-6">
                Our Journey
            </span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#2A2A2A] mb-6">The HomeStyle Story</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                From a small workshop to a national name, our journey is one of passion, 
                innovation, and unwavering commitment to quality.
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="fade-in">
                <div class="relative">
                    <div class="rounded-3xl overflow-hidden shadow-2xl">
                        <img 
                            src="https://images.unsplash.com/photo-1615529328331-f8917597711f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                            alt="Our Workshop" 
                            class="w-full h-[500px] object-cover"
                        >
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-gradient-to-br from-[#680626] to-[#B89A6B] rounded-3xl shadow-xl flex items-center justify-center">
                        <span class="text-white text-5xl font-bold">2010</span>
                    </div>
                </div>
            </div>
            
            <div class="fade-in" style="transition-delay: 0.2s">
                <h3 class="text-3xl font-bold text-[#2A2A2A] mb-8">Crafting Excellence Since 2010</h3>
                <p class="text-lg text-gray-700 mb-6">
                    Founded with a vision to transform ordinary homes into extraordinary spaces, 
                    HomeStyle began as a small workshop dedicated to handcrafted excellence.
                </p>
                <p class="text-lg text-gray-700 mb-10">
                    Today, we combine traditional craftsmanship with modern design principles, 
                    creating products that are not just functional but tell a story of quality, 
                    sustainability, and timeless beauty.
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-[#FBF7EE] flex items-center justify-center">
                                <i class="fas fa-check text-[#680626]"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-[#2A2A2A] text-lg">Artisan Quality</h4>
                            <p class="text-gray-600">Every product is crafted with attention to detail and passion.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-[#FBF7EE] flex items-center justify-center">
                                <i class="fas fa-check text-[#680626]"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-[#2A2A2A] text-lg">Sustainable Practices</h4>
                            <p class="text-gray-600">We prioritize eco-friendly materials and ethical production.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-[#FBF7EE] flex items-center justify-center">
                                <i class="fas fa-check text-[#680626]"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-[#2A2A2A] text-lg">Modern Innovation</h4>
                            <p class="text-gray-600">Blending tradition with contemporary design sensibilities.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern Timeline -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-20">
            <span class="inline-block px-5 py-2 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] text-[#680626] text-sm font-semibold tracking-widest uppercase rounded-full mb-6">
                Milestones
            </span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#2A2A2A] mb-6">Our Evolution</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Key moments that shaped our journey</p>
        </div>
        
        <div class="relative max-w-6xl mx-auto">
            <div class="absolute left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-[#680626] to-[#B89A6B] transform -translate-x-1/2"></div>
            
            <div class="fade-in timeline-item flex items-center mb-20">
                <div class="w-[150px] text-center relative z-10">
                    <span class="bg-gradient-to-r from-[#680626] to-[#B89A6B] text-white px-8 py-4 rounded-full font-bold text-lg inline-block shadow-lg">
                        2010
                    </span>
                </div>
                <div class="flex-1 bg-white p-10 rounded-2xl shadow-lg border border-[#E2DBD1] ml-10">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-4">The Beginning</h3>
                    <p class="text-gray-600">
                        Founded as a small workshop specializing in handcrafted bedsheets and linens.
                        Our first collection featured 12 unique designs, all made by local artisans.
                    </p>
                </div>
            </div>
            
            <div class="fade-in timeline-item flex items-center mb-20 flex-row-reverse" style="transition-delay: 0.1s">
                <div class="w-[150px] text-center relative z-10">
                    <span class="bg-gradient-to-r from-[#680626] to-[#B89A6B] text-white px-8 py-4 rounded-full font-bold text-lg inline-block shadow-lg">
                        2013
                    </span>
                </div>
                <div class="flex-1 bg-white p-10 rounded-2xl shadow-lg border border-[#E2DBD1] mr-10">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-4">First Flagship Store</h3>
                    <p class="text-gray-600">
                        Opened our first physical store, creating a tangible experience 
                        for customers to feel the quality and craftsmanship firsthand.
                    </p>
                </div>
            </div>
            
            <div class="fade-in timeline-item flex items-center mb-20" style="transition-delay: 0.2s">
                <div class="w-[150px] text-center relative z-10">
                    <span class="bg-gradient-to-r from-[#680626] to-[#B89A6B] text-white px-8 py-4 rounded-full font-bold text-lg inline-block shadow-lg">
                        2016
                    </span>
                </div>
                <div class="flex-1 bg-white p-10 rounded-2xl shadow-lg border border-[#E2DBD1] ml-10">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-4">Digital Transformation</h3>
                    <p class="text-gray-600">
                        Launched our e-commerce platform, expanding our reach nationwide 
                        while maintaining the personal touch of our in-store experience.
                    </p>
                </div>
            </div>
            
            <div class="fade-in timeline-item flex items-center mb-20 flex-row-reverse" style="transition-delay: 0.3s">
                <div class="w-[150px] text-center relative z-10">
                    <span class="bg-gradient-to-r from-[#680626] to-[#B89A6B] text-white px-8 py-4 rounded-full font-bold text-lg inline-block shadow-lg">
                        2020
                    </span>
                </div>
                <div class="flex-1 bg-white p-10 rounded-2xl shadow-lg border border-[#E2DBD1] mr-10">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-4">Sustainability Initiative</h3>
                    <p class="text-gray-600">
                        Implemented our Green Promise initiative, committing to 100% 
                        sustainable materials and carbon-neutral operations.
                    </p>
                </div>
            </div>
            
            <div class="fade-in timeline-item flex items-center" style="transition-delay: 0.4s">
                <div class="w-[150px] text-center relative z-10">
                    <span class="bg-gradient-to-r from-[#680626] to-[#B89A6B] text-white px-8 py-4 rounded-full font-bold text-lg inline-block shadow-lg">
                        2024
                    </span>
                </div>
                <div class="flex-1 bg-white p-10 rounded-2xl shadow-lg border border-[#E2DBD1] ml-10">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-4">Global Recognition</h3>
                    <p class="text-gray-600">
                        Received the International Home Design Award for excellence 
                        in sustainable luxury home products.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="py-24 bg-gradient-to-br from-[#FCF9F5] to-[#F5F0E9]">
    <div class="container mx-auto px-4">
        <div class="text-center mb-20">
            <span class="inline-block px-5 py-2 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] text-[#680626] text-sm font-semibold tracking-widest uppercase rounded-full mb-6">
                Our Philosophy
            </span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#2A2A2A] mb-6">Core Values</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Principles that guide every decision we make</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-transparent transition-all duration-400 hover:-translate-y-4 hover:border-[#B89A6B] hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden h-full">
                <div class="w-20 h-20 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] rounded-2xl flex items-center justify-center text-4xl text-[#680626] mb-10">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#2A2A2A] mb-6">Artisan Craftsmanship</h3>
                <p class="text-gray-600">
                    Every product is a testament to skilled craftsmanship, 
                    combining traditional techniques with modern innovation.
                </p>
            </div>
            
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-transparent transition-all duration-400 hover:-translate-y-4 hover:border-[#B89A6B] hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden h-full" style="transition-delay: 0.1s">
                <div class="w-20 h-20 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] rounded-2xl flex items-center justify-center text-4xl text-[#680626] mb-10">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#2A2A2A] mb-6">Sustainable Luxury</h3>
                <p class="text-gray-600">
                    We believe luxury should be sustainable. From sourcing 
                    to packaging, every step prioritizes environmental responsibility.
                </p>
            </div>
            
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-transparent transition-all duration-400 hover:-translate-y-4 hover:border-[#B89A6B] hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden h-full" style="transition-delay: 0.2s">
                <div class="w-20 h-20 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] rounded-2xl flex items-center justify-center text-4xl text-[#680626] mb-10">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#2A2A2A] mb-6">Customer-Centric</h3>
                <p class="text-gray-600">
                    Your satisfaction is our ultimate goal. We listen, adapt, 
                    and exceed expectations at every touchpoint.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Modern Team -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-20">
            <span class="inline-block px-5 py-2 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] text-[#680626] text-sm font-semibold tracking-widest uppercase rounded-full mb-6">
                Leadership
            </span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#2A2A2A] mb-6">Meet Our Visionaries</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">The passionate minds behind HomeStyle's success</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="fade-in bg-white rounded-3xl shadow-2xl shadow-[#680626]/10 overflow-hidden transition-all duration-400 hover:-translate-y-4 hover:shadow-3xl hover:shadow-[#680626]/15 h-full">
                <div class="overflow-hidden h-80">
                    <img 
                        src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                        alt="Sarah Johnson" 
                        class="w-full h-full object-cover transition-transform duration-600 hover:scale-105"
                    >
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-2">Sarah Johnson</h3>
                    <p class="text-[#680626] font-semibold mb-4">Founder & Creative Director</p>
                    <p class="text-gray-600 mb-6">
                        With a background in textile design, Sarah brings 
                        artistic vision and passion to every collection.
                    </p>
                    <div class="flex gap-4 opacity-0 translate-y-5 transition-all duration-400 group-hover:opacity-100 group-hover:translate-y-0">
                        <a href="#" class="w-10 h-10 rounded-full bg-[#FBF7EE] flex items-center justify-center text-[#680626] transition-all hover:bg-[#680626] hover:text-white hover:-translate-y-1">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-[#FBF7EE] flex items-center justify-center text-[#680626] transition-all hover:bg-[#680626] hover:text-white hover:-translate-y-1">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-[#FBF7EE] flex items-center justify-center text-[#680626] transition-all hover:bg-[#680626] hover:text-white hover:-translate-y-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="fade-in bg-white rounded-3xl shadow-2xl shadow-[#680626]/10 overflow-hidden transition-all duration-400 hover:-translate-y-4 hover:shadow-3xl hover:shadow-[#680626]/15 h-full" style="transition-delay: 0.1s">
                <div class="overflow-hidden h-80">
                    <img 
                        src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                        alt="Michael Chen" 
                        class="w-full h-full object-cover transition-transform duration-600 hover:scale-105"
                    >
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-2">Michael Chen</h3>
                    <p class="text-[#680626] font-semibold mb-4">Head of Product</p>
                    <p class="text-gray-600 mb-6">
                        Michael ensures every product meets our rigorous standards 
                        for quality, comfort, and sustainability.
                    </p>
                    <div class="flex gap-4 opacity-0 translate-y-5 transition-all duration-400 group-hover:opacity-100 group-hover:translate-y-0">
                        <a href="#" class="w-10 h-10 rounded-full bg-[#FBF7EE] flex items-center justify-center text-[#680626] transition-all hover:bg-[#680626] hover:text-white hover:-translate-y-1">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-[#FBF7EE] flex items-center justify-center text-[#680626] transition-all hover:bg-[#680626] hover:text-white hover:-translate-y-1">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-[#FBF7EE] flex items-center justify-center text-[#680626] transition-all hover:bg-[#680626] hover:text-white hover:-translate-y-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="fade-in bg-white rounded-3xl shadow-2xl shadow-[#680626]/10 overflow-hidden transition-all duration-400 hover:-translate-y-4 hover:shadow-3xl hover:shadow-[#680626]/15 h-full" style="transition-delay: 0.2s">
                <div class="overflow-hidden h-80">
                    <img 
                        src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                        alt="Elena Rodriguez" 
                        class="w-full h-full object-cover transition-transform duration-600 hover:scale-105"
                    >
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-2">Elena Rodriguez</h3>
                    <p class="text-[#680626] font-semibold mb-4">Customer Experience Director</p>
                    <p class="text-gray-600 mb-6">
                        Elena leads our commitment to exceptional service, 
                        ensuring every customer feels valued and heard.
                    </p>
                    <div class="flex gap-4 opacity-0 translate-y-5 transition-all duration-400 group-hover:opacity-100 group-hover:translate-y-0">
                        <a href="#" class="w-10 h-10 rounded-full bg-[#FBF7EE] flex items-center justify-center text-[#680626] transition-all hover:bg-[#680626] hover:text-white hover:-translate-y-1">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-[#FBF7EE] flex items-center justify-center text-[#680626] transition-all hover:bg-[#680626] hover:text-white hover:-translate-y-1">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-[#FBF7EE] flex items-center justify-center text-[#680626] transition-all hover:bg-[#680626] hover:text-white hover:-translate-y-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern CTA -->
<section class="relative py-24 bg-gradient-to-r from-[#680626] to-[#B89A6B] overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10">
        <div class="absolute -top-20 -left-20 w-64 h-64 rounded-full bg-white"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full bg-white"></div>
    </div>
    
    <div class="container mx-auto px-4 text-center relative z-10">
        <h2 class="fade-in text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-10 leading-tight">
            Ready to Transform<br>
            Your Home Experience?
        </h2>
        <p class="fade-in text-xl text-white/90 max-w-2xl mx-auto mb-12" style="transition-delay: 0.1s">
            Discover our curated collection of premium home essentials 
            and experience the difference of artisan craftsmanship.
        </p>
        <div class="fade-in flex flex-wrap gap-6 justify-center" style="transition-delay: 0.2s">
            <a href="/shop" class="relative modern-btn inline-flex items-center gap-3 px-9 py-5 text-lg font-semibold text-[#680626] rounded-full bg-white shadow-lg shadow-black/20 transition-all duration-400 hover:shadow-xl hover:shadow-black/30 hover:-translate-y-1 overflow-hidden">
                <i class="fas fa-shopping-cart"></i>
                Shop Collection
            </a>
            <a href="/contact" class="inline-flex items-center gap-3 px-9 py-5 text-lg font-semibold text-white rounded-full border-2 border-white transition-all duration-400 hover:bg-white/10">
                <i class="fas fa-comment-alt"></i>
                Book Consultation
            </a>
        </div>
    </div>
</section>
@endsection

@push("script")
<script>
    // Scroll Animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe all fade-in elements
    document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

    // Parallax effect for hero
    document.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('section[style*="background-image"]');
        if (parallax) {
            parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });

    // Animate stats on view
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumbers = entry.target.querySelectorAll('.text-6xl');
                statNumbers.forEach(stat => {
                    const text = stat.textContent;
                    const target = parseInt(text.replace('+', ''));
                    const suffix = text.includes('+') ? '+' : '';
                    let current = 0;
                    const increment = target / 50;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            stat.textContent = target + suffix;
                            clearInterval(timer);
                        } else {
                            stat.textContent = Math.floor(current) + suffix;
                        }
                    }, 30);
                });
            }
        });
    }, { threshold: 0.5 });

    // Observe stats section
    const statsSection = document.querySelector('section.bg-gradient-to-br.from-white');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Team card hover effect
    document.querySelectorAll('.group-hover\\:opacity-100').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('group');
        });
    });
</script>
@endpush