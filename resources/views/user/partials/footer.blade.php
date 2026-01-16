<footer class="relative mt-32 pt-24 pb-12 overflow-hidden bg-[var(--primary-color)] text-[var(--surface-color)]">

    <div class="absolute inset-0 opacity-[0.08] pointer-events-none mix-blend-overlay"
         style="background-image: url('https://www.transparenttextures.com/patterns/asfalt-light.png');"></div>

    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-24 bg-gradient-to-b from-[var(--secondary-color)] to-transparent"></div>

    <div class="container mx-auto px-6 relative z-10">
        
        <div class="flex flex-col lg:flex-row justify-between items-start gap-16 mb-24 pb-16 border-b border-white/5">
            <div class="max-w-xl">
                <span class="text-[var(--secondary-color)] uppercase tracking-[0.4em] text-xs font-bold mb-6 block">Stay Connected</span>
                <h3 class="text-4xl md:text-5xl font-serif italic leading-tight mb-8">
                    Join the inner circle for <br>
                    <span class="not-italic font-light opacity-90">curated inspirations.</span>
                </h3>
            </div>

            <div class="w-full lg:w-1/3">
                <form class="relative group">
                    <input type="email" placeholder="Your Distinguished Email" 
                           class="w-full bg-transparent border-b border-white/20 py-4 text-sm uppercase tracking-widest text-white placeholder-white/30 focus:outline-none focus:border-[var(--secondary-color)] transition-all duration-500">
                    <button type="submit" 
                            class="absolute right-0 bottom-4 text-[var(--secondary-color)] uppercase text-[10px] tracking-[0.2em] font-bold hover:text-white transition-colors">
                        Subscribe
                    </button>
                </form>
                <p class="mt-4 text-[10px] text-white/30 uppercase tracking-widest">Privacy is our ultimate luxury.</p>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 mb-20">
            
            <div class="col-span-2 lg:col-span-2 space-y-8">
                <a href="/" class="text-3xl font-serif tracking-widest text-white">
                    INHOUSE<span class="text-[var(--secondary-color)]"> TEXTILES</span>

                </a>
                <p class="text-white/50 font-light leading-relaxed max-w-xs text-sm">
                    Elevating the art of living through sustainable craftsmanship and timeless aesthetic. Your sanctuary, perfected.
                </p>
                <div class="flex gap-6 opacity-60">
                    <a href="#" class="hover:text-[var(--secondary-color)] hover:-translate-y-1 transition-all duration-300">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="hover:text-[var(--secondary-color)] hover:-translate-y-1 transition-all duration-300">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="hover:text-[var(--secondary-color)] hover:-translate-y-1 transition-all duration-300">
                        <i class="fab fa-pinterest-p text-xl"></i>
                    </a>
                </div>
            </div>
@php
use App\Models\Category;
$categories = Category::where('status', 1)->take('5')->orderBy('created_at', 'desc')->get();
@endphp
            <div>
                <h4 class="text-[var(--secondary-color)] font-bold tracking-[0.2em] text-[10px] uppercase mb-8">Collections</h4>
                <ul class="space-y-4">
                    @foreach($categories as $cat)
                    <li><a href="{{ route('product', ['category_id' => $cat->id]) }}" class="footer-link text-xs uppercase tracking-widest text-white/60">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-[var(--secondary-color)] font-bold tracking-[0.2em] text-[10px] uppercase mb-8">Heritage</h4>
                <ul class="space-y-4">
                <li><a href="{{ url('/') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Home</a></li>
                    <li><a href="{{ url('/product')  }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Product</a></li>
                    <li><a href="{{ url('/category') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Category</a></li>
                    <li><a href="{{ url('/about') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">About</a></li>
                    <li><a href="{{ url('/contact') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Contact</a></li>

                </ul>
            </div>

            <div>
                <h4 class="text-[var(--secondary-color)] font-bold tracking-[0.2em] text-[10px] uppercase mb-8">Services</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="footer-link text-xs uppercase tracking-widest text-white/60">Shipping</a></li>
                    <li><a href="#" class="footer-link text-xs uppercase tracking-widest text-white/60">Concierge</a></li>
                    <li><a href="#" class="footer-link text-xs uppercase tracking-widest text-white/60">Returns</a></li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-white/20 text-[10px] uppercase tracking-[0.2em]">© {{ date('Y') }} Home Collection. International.</p>
            
            <div class="absolute bottom-0 left-0 w-full overflow-hidden pointer-events-none opacity-[0.02]">
                <h2 class="text-[18vw] font-serif leading-none translate-y-1/2">SIGNATURE</h2>
            </div>

            <div class="flex gap-8 text-[10px] uppercase tracking-[0.2em] text-white/30">
                <a href="#" class="hover:text-[var(--secondary-color)] transition-colors">Privacy</a>
                <a href="#" class="hover:text-[var(--secondary-color)] transition-colors">Terms</a>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Premium Hover Animation */
    .footer-link {
        display: inline-block;
        transition: all 0.4s ease;
        position: relative;
    }
    .footer-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background-color: var(--secondary-color);
        transition: width 0.4s ease;
    }
    .footer-link:hover {
        color: white;
        letter-spacing: 0.2em;
    }
    .footer-link:hover::after {
        width: 100%;
    }
</style>