<!-- FOOTER SECTION -->
<footer class="relative mt-32 pt-20 pb-10 overflow-hidden"
    style="background-color: var(--primary-color); color: var(--surface-color); font-family: 'Outfit', sans-serif;">

    <!-- 1. TEXTURE OVERLAY (Adds depth/premium feel) -->
    <div class="absolute inset-0 opacity-[0.05] pointer-events-none mix-blend-overlay"
         style="background-image: url('https://grainy-gradients.vercel.app/noise.svg');"></div>

    <!-- 2. DECORATIVE GLOWS -->
    <div class="absolute top-[-20%] right-[-10%] w-[600px] h-[600px] bg-[var(--secondary-color)]/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-20%] left-[-10%] w-[500px] h-[500px] bg-[var(--accent-color)]/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="container mx-auto px-6 relative z-10">
        
        <!-- TOP SECTION: CTA & NEWSLETTER -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-12 mb-20 border-b border-white/10 pb-16">
            <div class="max-w-2xl">
                <h3 class="text-4xl md:text-5xl font-light leading-tight mb-6">
                    Elevate your living space.<br>
                    <span class="font-bold text-[var(--secondary-color)]">Join the exclusive list.</span>
                </h3>
                <p class="text-white/60 text-lg font-light">
                    Get early access to new collections and interior design tips.
                </p>
            </div>

            <!-- Modern Input Field -->
            <div class="w-full lg:w-auto min-w-[350px]">
                <form class="relative group">
                    <input type="email" placeholder="Email Address" 
                           class="w-full bg-transparent border-b border-white/20 py-4 pr-12 text-lg text-white placeholder-white/30 focus:outline-none focus:border-[var(--secondary-color)] transition-colors duration-300">
                    <button type="submit" 
                            class="absolute right-0 top-1/2 -translate-y-1/2 text-[var(--secondary-color)] opacity-70 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- MIDDLE SECTION: LINKS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-24">
            
            <!-- Brand Info -->
            <div class="md:col-span-4 space-y-6">
                <a href="/" class="text-3xl font-bold tracking-tighter text-white">
                    HOME<span class="text-[var(--secondary-color)]">.</span>
                </a>
                <p class="text-white/50 leading-relaxed max-w-sm">
                    Crafting premium home experiences with sustainable materials and timeless design. Comfort meets luxury in every detail.
                </p>
                <div class="flex gap-4 pt-4">
                    <!-- Social Icons (Hover Effect) -->
                    @foreach(['facebook', 'instagram', 'twitter', 'linkedin'] as $social)
                    <a href="#" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-white/60 hover:text-[var(--text-on-secondary)] hover:bg-[var(--secondary-color)] hover:border-[var(--secondary-color)] transition-all duration-300">
                        <img src="https://simpleicons.org/icons/{{$social}}.svg" class="w-4 h-4 invert opacity-80" alt="{{$social}}">
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Links Column 1 -->
            <div class="md:col-span-2 md:col-start-6">
                <h4 class="text-[var(--secondary-color)] font-medium tracking-widest text-sm uppercase mb-6">Shop</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">New Arrivals</a></li>
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">Best Sellers</a></li>
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">Furniture</a></li>
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">Decor</a></li>
                </ul>
            </div>

            <!-- Links Column 2 -->
            <div class="md:col-span-2">
                <h4 class="text-[var(--secondary-color)] font-medium tracking-widest text-sm uppercase mb-6">Company</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">Our Story</a></li>
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">Sustainability</a></li>
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">Careers</a></li>
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">Journal</a></li>
                </ul>
            </div>

            <!-- Links Column 3 -->
            <div class="md:col-span-2">
                <h4 class="text-[var(--secondary-color)] font-medium tracking-widest text-sm uppercase mb-6">Support</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">Shipping</a></li>
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">Returns</a></li>
                    <li><a href="#" class="footer-link inline-block text-white/70 hover:text-white transition-colors">Contact Us</a></li>
                </ul>
            </div>
        </div>

        <!-- BOTTOM: MASSIVE TYPOGRAPHY -->
        <div class="relative w-full border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-white/40 text-sm">© {{ date('Y') }} Home Collection. All rights reserved.</p>
            
            <div class="flex gap-8 text-sm text-white/40">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>

        <!-- THE "BIG TEXT" EFFECT (Common in high-end design) -->
        <div class="w-full text-center mt-12 select-none pointer-events-none opacity-[0.03]">
            <h1 class="text-[12vw] leading-none font-black tracking-tighter text-white mix-blend-overlay">
                COLLECTION
            </h1>
        </div>

    </div>
</footer>

<style>
    /* Custom Hover Animation for Links */
    .footer-link {
        position: relative;
    }
    .footer-link::before {
        content: '';
        position: absolute;
        left: -15px;
        top: 50%;
        transform: translateY(-50%);
        width: 6px;
        height: 6px;
        background-color: var(--secondary-color);
        border-radius: 50%;
        opacity: 0;
        transition: all 0.3s ease;
    }
    .footer-link:hover {
        transform: translateX(10px);
        color: var(--secondary-color);
    }
    .footer-link:hover::before {
        opacity: 1;
        left: -12px;
    }
</style>