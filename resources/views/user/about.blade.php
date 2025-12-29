@extends("user.layouts.master-layouts.plain")

<title>Home Collection | About </title>



@push("style")
<style>
 
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-color);
        }
        
        .about-hero {
            background: linear-gradient(135deg, rgba(75, 54, 33, 0.85) 0%, rgba(107, 79, 51, 0.8) 100%), url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
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
        
        .stats-card {
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-10px);
        }
        
        .team-card {
            transition: transform 0.3s ease;
        }
        
        .team-card:hover {
            transform: translateY(-8px);
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
        
        .timeline-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 40px;
        }
        
        .timeline-item:before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary-color);
        }
        
        .timeline-item:after {
            content: '';
            position: absolute;
            left: 5px;
            top: 20px;
            width: 2px;
            height: calc(100% + 20px);
            background: var(--accent-color);
        }
        
        .timeline-item:last-child:after {
            display: none;
        }
        
        .value-card {
            transition: all 0.3s ease;
        }
        
        .value-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endpush


@section("content")
   <!-- About Hero Section -->
   <section class="about-hero text-white py-20 md:py-32">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Our Story</h1>
                <p class="text-xl md:text-2xl mb-8">Crafting premium home experiences since 2010</p>
                <div class="flex justify-center space-x-4">
                    <a href="/shop" class="btn-primary px-6 py-3 rounded-lg font-medium text-lg">Shop Now</a>
                    <a href="#contact" class="bg-white text-primary px-6 py-3 rounded-lg font-medium text-lg">Contact Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-primary mb-6">Who We Are</h2>
                    <p class="text-lg mb-6">HomeStyle was founded in 2010 with a simple mission: to bring premium quality home essentials to every household. We believe that your home should be a sanctuary—a place of comfort, style, and personal expression.</p>
                    <p class="text-lg mb-6">Our journey began with a small collection of handcrafted bedsheets and has since grown to include a wide range of home textiles, decorative items, and lifestyle products. Each item in our collection is carefully selected for its quality, design, and ability to transform living spaces.</p>
                    <p class="text-lg">Today, we serve customers across the country, staying true to our founding principles of quality, sustainability, and exceptional customer service.</p>
                </div>
                <div class="rounded-xl overflow-hidden shadow-lg" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" alt="Our Team" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-accent">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="stats-card bg-white rounded-xl p-6 text-center shadow-md" data-aos="fade-up" data-aos-delay="0">
                    <div class="text-4xl font-bold text-primary mb-2">13+</div>
                    <div class="text-lg">Years Experience</div>
                </div>
                <div class="stats-card bg-white rounded-xl p-6 text-center shadow-md" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-4xl font-bold text-primary mb-2">50K+</div>
                    <div class="text-lg">Happy Customers</div>
                </div>
                <div class="stats-card bg-white rounded-xl p-6 text-center shadow-md" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl font-bold text-primary mb-2">500+</div>
                    <div class="text-lg">Products</div>
                </div>
                <div class="stats-card bg-white rounded-xl p-6 text-center shadow-md" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl font-bold text-primary mb-2">25+</div>
                    <div class="text-lg">Awards Won</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-primary mb-4">Our Values</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">The principles that guide everything we do at HomeStyle</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="value-card bg-gray-50 rounded-xl p-8 shadow-sm" data-aos="fade-up" data-aos-delay="0">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Quality Craftsmanship</h3>
                    <p class="text-gray-600">We source only the finest materials and work with skilled artisans to create products that stand the test of time.</p>
                </div>
                <div class="value-card bg-gray-50 rounded-xl p-8 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Sustainability</h3>
                    <p class="text-gray-600">We're committed to ethical sourcing and minimizing our environmental impact through responsible practices.</p>
                </div>
                <div class="value-card bg-gray-50 rounded-xl p-8 shadow-sm" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Customer Focus</h3>
                    <p class="text-gray-600">Your satisfaction is our priority. We go above and beyond to ensure you love every HomeStyle product.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Journey Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-primary mb-4">Our Journey</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Milestones in our growth and development</p>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <div class="timeline-item" data-aos="fade-right">
                    <h3 class="text-xl font-bold text-primary mb-2">2010 - Foundation</h3>
                    <p class="text-gray-600">HomeStyle was founded with a small collection of premium bedsheets and home textiles.</p>
                </div>
                <div class="timeline-item" data-aos="fade-right" data-aos-delay="100">
                    <h3 class="text-xl font-bold text-primary mb-2">2013 - First Retail Store</h3>
                    <p class="text-gray-600">Opened our first physical store, expanding our reach to local customers.</p>
                </div>
                <div class="timeline-item" data-aos="fade-right" data-aos-delay="200">
                    <h3 class="text-xl font-bold text-primary mb-2">2015 - E-commerce Launch</h3>
                    <p class="text-gray-600">Launched our online store, making HomeStyle products accessible nationwide.</p>
                </div>
                <div class="timeline-item" data-aos="fade-right" data-aos-delay="300">
                    <h3 class="text-xl font-bold text-primary mb-2">2018 - Product Expansion</h3>
                    <p class="text-gray-600">Expanded our collection to include decorative items, kitchen textiles, and lifestyle products.</p>
                </div>
                <div class="timeline-item" data-aos="fade-right" data-aos-delay="400">
                    <h3 class="text-xl font-bold text-primary mb-2">2021 - Sustainability Initiative</h3>
                    <p class="text-gray-600">Launched our sustainability program, committing to ethical sourcing and eco-friendly packaging.</p>
                </div>
                <div class="timeline-item" data-aos="fade-right" data-aos-delay="500">
                    <h3 class="text-xl font-bold text-primary mb-2">2023 - Present Day</h3>
                    <p class="text-gray-600">Serving over 50,000 customers with 500+ premium home products and growing.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-primary mb-4">Meet Our Team</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">The passionate people behind HomeStyle</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="team-card bg-gray-50 rounded-xl overflow-hidden shadow-md" data-aos="fade-up" data-aos-delay="0">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-1">Sarah Johnson</h3>
                        <p class="text-gray-600 mb-4">Founder & CEO</p>
                        <p class="text-gray-600">Sarah founded HomeStyle with a vision to transform homes into beautiful, comfortable spaces.</p>
                    </div>
                </div>
                <div class="team-card bg-gray-50 rounded-xl overflow-hidden shadow-md" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-1">Michael Chen</h3>
                        <p class="text-gray-600 mb-4">Head of Product Design</p>
                        <p class="text-gray-600">Michael ensures every HomeStyle product meets our high standards for quality and aesthetics.</p>
                    </div>
                </div>
                <div class="team-card bg-gray-50 rounded-xl overflow-hidden shadow-md" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-1">Elena Rodriguez</h3>
                        <p class="text-gray-600 mb-4">Customer Experience Director</p>
                        <p class="text-gray-600">Elena leads our customer service team, ensuring every interaction with HomeStyle is exceptional.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-primary text-white" id="contact">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center" data-aos="zoom-in">
                <h2 class="text-3xl font-bold mb-6">Ready to Transform Your Home?</h2>
                <p class="text-xl mb-8">Discover our premium collection and experience the HomeStyle difference.</p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="/shop" class="bg-white text-primary px-8 py-3 rounded-lg font-medium text-lg hover:bg-gray-100 transition">Shop Now</a>
                    <a href="/contact" class="border-2 border-white text-white px-8 py-3 rounded-lg font-medium text-lg hover:bg-white hover:text-primary transition">Contact Us</a>
                </div>
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
            
            // Theme color changer
            const colorOptions = document.querySelectorAll('.color-option');
            
            colorOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all options
                    colorOptions.forEach(opt => opt.classList.remove('active'));
                    
                    // Add active class to clicked option
                    this.classList.add('active');
                    
                    // Get the selected color
                    const primaryColor = this.getAttribute('data-color');
                    
                    // Calculate secondary color (darker version)
                    const hexToRgb = hex => {
                        const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                        return result ? {
                            r: parseInt(result[1], 16),
                            g: parseInt(result[2], 16),
                            b: parseInt(result[3], 16)
                        } : null;
                    };
                    
                    const rgb = hexToRgb(primaryColor);
                    const secondaryColor = `rgb(${Math.max(0, rgb.r - 30)}, ${Math.max(0, rgb.g - 30)}, ${Math.max(0, rgb.b - 30)})`;
                    
                    // Update CSS variables
                    document.documentElement.style.setProperty('--primary-color', primaryColor);
                    document.documentElement.style.setProperty('--secondary-color', secondaryColor);
                });
            });
        });
    </script>
@endpush


