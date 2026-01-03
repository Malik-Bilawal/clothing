@extends("user.layouts.master-layouts.plain")

@section("title", "Home Collection | About Us")

@push("style")
<style>
    :root {
        --primary-color: #6B4226;
        --primary-hover: #593721;
        --secondary-color: #C8A165;
        --secondary-hover: #B58F54;
        --accent-color: #8C5E3C;
        --accent-hover: #734C30;
        --light-bg: #F8F5F2;
        --dark-text: #2C1810;
        --light-text: #8A7B6D;
        --white: #FFFFFF;
        --shadow-sm: 0 4px 6px -1px rgba(107, 66, 38, 0.1);
        --shadow-md: 0 10px 15px -3px rgba(107, 66, 38, 0.1);
        --shadow-lg: 0 20px 25px -5px rgba(107, 66, 38, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--white);
        color: var(--dark-text);
        overflow-x: hidden;
    }

    /* Modern Hero Section */
    .modern-hero {
        position: relative;
        min-height: 85vh;
        background: linear-gradient(135deg, 
            rgba(43, 28, 16, 0.95) 0%, 
            rgba(107, 66, 38, 0.85) 100%),
            url('https://images.unsplash.com/photo-1615529328331-f8917597711f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #E8D2B8 0%, #C8A165 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1.5rem;
        line-height: 1.1;
    }

    .hero-subtitle {
        font-size: 1.5rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 600px;
        margin-bottom: 2.5rem;
        font-weight: 300;
        letter-spacing: 0.5px;
    }

    /* Floating Elements Animation */
    .floating-element {
        position: absolute;
        background: rgba(200, 161, 101, 0.1);
        border: 1px solid rgba(200, 161, 101, 0.2);
        border-radius: 50%;
        backdrop-filter: blur(10px);
        animation: float 20s infinite linear;
    }

    .element-1 {
        width: 300px;
        height: 300px;
        top: 10%;
        right: 5%;
        animation-delay: 0s;
    }

    .element-2 {
        width: 200px;
        height: 200px;
        bottom: 15%;
        left: 10%;
        animation-delay: -5s;
        animation-duration: 25s;
    }

    .element-3 {
        width: 150px;
        height: 150px;
        top: 40%;
        left: 15%;
        animation-delay: -10s;
        animation-duration: 30s;
    }

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

    /* Modern Button */
    .modern-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 18px 36px;
        font-size: 1.1rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 50px;
        background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
        color: white;
        border: none;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(107, 66, 38, 0.3);
    }

    .modern-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(107, 66, 38, 0.4);
    }

    .modern-btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .modern-btn:hover:before {
        left: 100%;
    }

    /* Section Headers */
    .section-header {
        text-align: center;
        margin-bottom: 5rem;
    }

    .section-label {
        display: inline-block;
        padding: 8px 20px;
        background: linear-gradient(135deg, var(--light-bg), #F0E6D8);
        color: var(--accent-color);
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        border-radius: 50px;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--dark-text);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .section-subtitle {
        font-size: 1.25rem;
        color: var(--light-text);
        max-width: 700px;
        margin: 0 auto;
    }

    /* Modern Stats */
    .modern-stats {
        background: linear-gradient(135deg, var(--white), var(--light-bg));
        padding: 100px 0;
        position: relative;
    }

    .stat-card {
        background: var(--white);
        padding: 3rem 2rem;
        border-radius: 24px;
        box-shadow: var(--shadow-lg);
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(107, 66, 38, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-20px);
        box-shadow: 0 30px 60px rgba(107, 66, 38, 0.15);
    }

    .stat-number {
        font-size: 4rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-bottom: 1rem;
    }

    .stat-label {
        font-size: 1.1rem;
        color: var(--light-text);
        font-weight: 500;
    }

    .stat-icon {
        position: absolute;
        top: -20px;
        right: -20px;
        width: 80px;
        height: 80px;
        background: var(--light-bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-color);
        font-size: 2rem;
        opacity: 0.7;
    }

    /* Timeline */
    .modern-timeline {
        position: relative;
        padding: 100px 0;
        background: var(--white);
    }

    .timeline-container {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
    }

    .timeline-item {
        display: flex;
        align-items: center;
        margin-bottom: 80px;
        position: relative;
    }

    .timeline-item:nth-child(odd) {
        flex-direction: row-reverse;
    }

    .timeline-year {
        flex: 0 0 150px;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .year-badge {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 15px 30px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.2rem;
        display: inline-block;
        box-shadow: var(--shadow-md);
    }

    .timeline-content {
        flex: 1;
        background: var(--white);
        padding: 2.5rem;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(107, 66, 38, 0.1);
        position: relative;
        margin: 0 40px;
    }

    .timeline-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark-text);
        margin-bottom: 1rem;
    }

    .timeline-line {
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
        transform: translateX(-50%);
    }

    /* Values Section */
    .modern-values {
        padding: 100px 0;
        background: linear-gradient(135deg, #FCF9F5, #F5F0E9);
    }

    .value-card {
        background: var(--white);
        border-radius: 24px;
        padding: 3rem;
        box-shadow: var(--shadow-lg);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
        border: 1px solid transparent;
    }

    .value-card:hover {
        transform: translateY(-15px);
        border-color: var(--secondary-color);
        box-shadow: 0 25px 50px rgba(107, 66, 38, 0.15);
    }

    .value-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--light-bg), #F0E6D8);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        font-size: 2.5rem;
        color: var(--primary-color);
    }

    .value-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark-text);
        margin-bottom: 1rem;
    }

    /* Team Section */
    .modern-team {
        padding: 100px 0;
        background: var(--white);
    }

    .team-card {
        background: var(--white);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
    }

    .team-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(107, 66, 38, 0.15);
    }

    .team-image {
        height: 320px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .team-card:hover .team-image {
        transform: scale(1.05);
    }

    .team-info {
        padding: 2rem;
        position: relative;
        background: var(--white);
    }

    .team-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark-text);
        margin-bottom: 0.5rem;
    }

    .team-role {
        color: var(--accent-color);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .team-social {
        display: flex;
        gap: 15px;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .team-card:hover .team-social {
        opacity: 1;
        transform: translateY(0);
    }

    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--light-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-color);
        text-decoration: none;
        transition: all 0.3s;
    }

    .social-link:hover {
        background: var(--accent-color);
        color: white;
        transform: translateY(-3px);
    }

    /* CTA Section */
    .modern-cta {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }

    .cta-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .cta-text {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 600px;
        margin: 0 auto 3rem;
    }

    .cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .hero-title {
            font-size: 3.5rem;
        }
        
        .section-title {
            font-size: 2.5rem;
        }
        
        .timeline-item {
            flex-direction: column !important;
            text-align: center;
        }
        
        .timeline-year {
            margin-bottom: 30px;
        }
        
        .timeline-content {
            margin: 0;
        }
        
        .timeline-line {
            left: 50%;
            height: calc(100% - 60px);
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .modern-btn {
            padding: 15px 30px;
            font-size: 1rem;
        }
        
        .stat-number {
            font-size: 3rem;
        }
    }

    /* Scroll Animation */
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
<section class="modern-hero">
    <div class="container mx-auto px-4 relative">
        <div class="hero-content max-w-3xl">
            <h1 class="hero-title">
                Redefining Home<br>
                <span class="text-white">Experiences</span>
            </h1>
            <p class="hero-subtitle">
                We blend traditional craftsmanship with contemporary design to create 
                home essentials that tell stories of comfort, quality, and timeless elegance.
            </p>
            <div class="flex flex-wrap gap-6">
                <a href="/shop" class="modern-btn">
                    <i class="fas fa-shopping-bag"></i>
                    Explore Collection
                </a>
                <a href="#our-story" class="modern-btn bg-transparent border-2 border-white">
                    <i class="fas fa-play-circle"></i>
                    Our Story
                </a>
            </div>
        </div>
    </div>
    
    <!-- Floating Elements -->
    <div class="floating-element element-1"></div>
    <div class="floating-element element-2"></div>
    <div class="floating-element element-3"></div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
        <div class="animate-bounce">
            <i class="fas fa-chevron-down text-white text-2xl"></i>
        </div>
    </div>
</section>

<!-- Modern Stats -->
<section class="modern-stats">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="fade-in stat-card">
                <div class="stat-icon">
                    <i class="fas fa-award"></i>
                </div>
                <div class="stat-number">13+</div>
                <div class="stat-label">Years of Excellence</div>
                <p class="text-gray-600 mt-4">Dedicated to quality since 2010</p>
            </div>
            
            <div class="fade-in stat-card" style="transition-delay: 0.1s">
                <div class="stat-icon">
                    <i class="fas fa-smile"></i>
                </div>
                <div class="stat-number">50K+</div>
                <div class="stat-label">Happy Families</div>
                <p class="text-gray-600 mt-4">Transforming homes nationwide</p>
            </div>
            
            <div class="fade-in stat-card" style="transition-delay: 0.2s">
                <div class="stat-icon">
                    <i class="fas fa-gem"></i>
                </div>
                <div class="stat-number">500+</div>
                <div class="stat-label">Premium Products</div>
                <p class="text-gray-600 mt-4">Curated with meticulous care</p>
            </div>
            
            <div class="fade-in stat-card" style="transition-delay: 0.3s">
                <div class="stat-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="stat-number">100%</div>
                <div class="stat-label">Eco-Friendly</div>
                <p class="text-gray-600 mt-4">Sustainable sourcing & practices</p>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section id="our-story" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="section-header">
            <span class="section-label">Our Journey</span>
            <h2 class="section-title">The HomeStyle Story</h2>
            <p class="section-subtitle">
                From a small workshop to a national name, our journey is one of passion, 
                innovation, and unwavering commitment to quality.
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="fade-in">
                <div class="relative">
                    <div class="rounded-3xl overflow-hidden shadow-2xl">
                        <img 
                            src="https://images.unsplash.com/photo-1615529328331-f8917597711f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                            alt="Our Workshop" 
                            class="w-full h-[500px] object-cover"
                        >
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-gradient-to-br from-[var(--primary-color)] to-[var(--secondary-color)] rounded-3xl shadow-xl flex items-center justify-center">
                        <span class="text-white text-5xl font-bold">2010</span>
                    </div>
                </div>
            </div>
            
            <div class="fade-in" style="transition-delay: 0.2s">
                <h3 class="text-2xl font-bold text-[var(--dark-text)] mb-6">Crafting Excellence Since 2010</h3>
                <p class="text-lg text-gray-700 mb-6">
                    Founded with a vision to transform ordinary homes into extraordinary spaces, 
                    HomeStyle began as a small workshop dedicated to handcrafted excellence.
                </p>
                <p class="text-lg text-gray-700 mb-8">
                    Today, we combine traditional craftsmanship with modern design principles, 
                    creating products that are not just functional but tell a story of quality, 
                    sustainability, and timeless beauty.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-[var(--light-bg)] flex items-center justify-center">
                                <i class="fas fa-check text-[var(--accent-color)]"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-[var(--dark-text)]">Artisan Quality</h4>
                            <p class="text-gray-600">Every product is crafted with attention to detail and passion.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-[var(--light-bg)] flex items-center justify-center">
                                <i class="fas fa-check text-[var(--accent-color)]"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-[var(--dark-text)]">Sustainable Practices</h4>
                            <p class="text-gray-600">We prioritize eco-friendly materials and ethical production.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-[var(--light-bg)] flex items-center justify-center">
                                <i class="fas fa-check text-[var(--accent-color)]"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-[var(--dark-text)]">Modern Innovation</h4>
                            <p class="text-gray-600">Blending tradition with contemporary design sensibilities.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern Timeline -->
<section class="modern-timeline">
    <div class="container mx-auto px-4">
        <div class="section-header">
            <span class="section-label">Milestones</span>
            <h2 class="section-title">Our Evolution</h2>
            <p class="section-subtitle">Key moments that shaped our journey</p>
        </div>
        
        <div class="timeline-container">
            <div class="timeline-line"></div>
            
            <div class="timeline-item fade-in">
                <div class="timeline-year">
                    <span class="year-badge">2010</span>
                </div>
                <div class="timeline-content">
                    <h3 class="timeline-title">The Beginning</h3>
                    <p class="text-gray-600">
                        Founded as a small workshop specializing in handcrafted bedsheets and linens.
                        Our first collection featured 12 unique designs, all made by local artisans.
                    </p>
                </div>
            </div>
            
            <div class="timeline-item fade-in" style="transition-delay: 0.1s">
                <div class="timeline-year">
                    <span class="year-badge">2013</span>
                </div>
                <div class="timeline-content">
                    <h3 class="timeline-title">First Flagship Store</h3>
                    <p class="text-gray-600">
                        Opened our first physical store, creating a tangible experience 
                        for customers to feel the quality and craftsmanship firsthand.
                    </p>
                </div>
            </div>
            
            <div class="timeline-item fade-in" style="transition-delay: 0.2s">
                <div class="timeline-year">
                    <span class="year-badge">2016</span>
                </div>
                <div class="timeline-content">
                    <h3 class="timeline-title">Digital Transformation</h3>
                    <p class="text-gray-600">
                        Launched our e-commerce platform, expanding our reach nationwide 
                        while maintaining the personal touch of our in-store experience.
                    </p>
                </div>
            </div>
            
            <div class="timeline-item fade-in" style="transition-delay: 0.3s">
                <div class="timeline-year">
                    <span class="year-badge">2020</span>
                </div>
                <div class="timeline-content">
                    <h3 class="timeline-title">Sustainability Initiative</h3>
                    <p class="text-gray-600">
                        Implemented our Green Promise initiative, committing to 100% 
                        sustainable materials and carbon-neutral operations.
                    </p>
                </div>
            </div>
            
            <div class="timeline-item fade-in" style="transition-delay: 0.4s">
                <div class="timeline-year">
                    <span class="year-badge">2024</span>
                </div>
                <div class="timeline-content">
                    <h3 class="timeline-title">Global Recognition</h3>
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
<section class="modern-values">
    <div class="container mx-auto px-4">
        <div class="section-header">
            <span class="section-label">Our Philosophy</span>
            <h2 class="section-title">Core Values</h2>
            <p class="section-subtitle">Principles that guide every decision we make</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="fade-in value-card">
                <div class="value-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h3 class="value-title">Artisan Craftsmanship</h3>
                <p class="text-gray-600">
                    Every product is a testament to skilled craftsmanship, 
                    combining traditional techniques with modern innovation.
                </p>
            </div>
            
            <div class="fade-in value-card" style="transition-delay: 0.1s">
                <div class="value-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="value-title">Sustainable Luxury</h3>
                <p class="text-gray-600">
                    We believe luxury should be sustainable. From sourcing 
                    to packaging, every step prioritizes environmental responsibility.
                </p>
            </div>
            
            <div class="fade-in value-card" style="transition-delay: 0.2s">
                <div class="value-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="value-title">Customer-Centric</h3>
                <p class="text-gray-600">
                    Your satisfaction is our ultimate goal. We listen, adapt, 
                    and exceed expectations at every touchpoint.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Modern Team -->
<section class="modern-team">
    <div class="container mx-auto px-4">
        <div class="section-header">
            <span class="section-label">Leadership</span>
            <h2 class="section-title">Meet Our Visionaries</h2>
            <p class="section-subtitle">The passionate minds behind HomeStyle's success</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="fade-in team-card">
                <img 
                    src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                    alt="Sarah Johnson" 
                    class="team-image"
                >
                <div class="team-info">
                    <h3 class="team-name">Sarah Johnson</h3>
                    <p class="team-role">Founder & Creative Director</p>
                    <p class="text-gray-600 mb-4">
                        With a background in textile design, Sarah brings 
                        artistic vision and passion to every collection.
                    </p>
                    <div class="team-social">
                        <a href="#" class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="fade-in team-card" style="transition-delay: 0.1s">
                <img 
                    src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                    alt="Michael Chen" 
                    class="team-image"
                >
                <div class="team-info">
                    <h3 class="team-name">Michael Chen</h3>
                    <p class="team-role">Head of Product</p>
                    <p class="text-gray-600 mb-4">
                        Michael ensures every product meets our rigorous standards 
                        for quality, comfort, and sustainability.
                    </p>
                    <div class="team-social">
                        <a href="#" class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="fade-in team-card" style="transition-delay: 0.2s">
                <img 
                    src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                    alt="Elena Rodriguez" 
                    class="team-image"
                >
                <div class="team-info">
                    <h3 class="team-name">Elena Rodriguez</h3>
                    <p class="team-role">Customer Experience Director</p>
                    <p class="text-gray-600 mb-4">
                        Elena leads our commitment to exceptional service, 
                        ensuring every customer feels valued and heard.
                    </p>
                    <div class="team-social">
                        <a href="#" class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern CTA -->
<section class="modern-cta">
    <div class="container mx-auto px-4 text-center">
        <h2 class="cta-title fade-in">
            Ready to Transform<br>
            Your Home Experience?
        </h2>
        <p class="cta-text fade-in" style="transition-delay: 0.1s">
            Discover our curated collection of premium home essentials 
            and experience the difference of artisan craftsmanship.
        </p>
        <div class="cta-buttons fade-in" style="transition-delay: 0.2s">
            <a href="/shop" class="modern-btn bg-white text-[var(--primary-color)]">
                <i class="fas fa-shopping-cart"></i>
                Shop Collection
            </a>
            <a href="/contact" class="modern-btn bg-transparent border-2 border-white">
                <i class="fas fa-comment-alt"></i>
                Book Consultation
            </a>
        </div>
    </div>
    
    <!-- CTA Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10">
        <div class="absolute -top-20 -left-20 w-64 h-64 rounded-full bg-white"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full bg-white"></div>
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
        const parallax = document.querySelector('.modern-hero');
        if (parallax) {
            parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });

    // Animate stats on view
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumbers = entry.target.querySelectorAll('.stat-number');
                statNumbers.forEach(stat => {
                    const target = parseInt(stat.textContent.replace('+', ''));
                    const suffix = stat.textContent.includes('+') ? '+' : '';
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
    const statsSection = document.querySelector('.modern-stats');
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
</script>
@endpush