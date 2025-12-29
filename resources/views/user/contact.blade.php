<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleVault | Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/TextPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-on-secondary);
            overflow-x: hidden;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--text-on-primary);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(107, 66, 38, 0.2);
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: var(--text-on-secondary);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: var(--secondary-hover);
            transform: translateY(-2px);
        }

        .text-primary {
            color: var(--primary-color);
        }

        .bg-primary {
            background-color: var(--primary-color);
        }

        .bg-secondary {
            background-color: var(--secondary-color);
        }

        .bg-accent {
            background-color: var(--accent-color);
        }

        .bg-surface {
            background-color: var(--surface-color);
        }

        .border-custom {
            border-color: var(--border-color);
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, 15px); }
            100% { transform: translate(0, -0px); }
        }

        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .text-stroke {
            -webkit-text-stroke: 1px var(--primary-color);
            color: transparent;
        }

        .contact-card {
            transition: all 0.4s ease;
            transform-style: preserve-3d;
        }

        .contact-card:hover {
            transform: translateY(-10px) rotateX(5deg);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            position: relative;
            margin-bottom: 2rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--surface-color);
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(107, 66, 38, 0.1);
            outline: none;
        }

        .form-label {
            position: absolute;
            top: 1rem;
            left: 1rem;
            color: #999;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .form-input:focus + .form-label,
        .form-input:not(:placeholder-shown) + .form-label {
            top: -0.5rem;
            left: 0.8rem;
            font-size: 0.8rem;
            background: var(--surface-color);
            padding: 0 0.5rem;
            color: var(--primary-color);
        }

        .social-icon {
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-5px) scale(1.1);
        }

        .faq-item {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .faq-answer {
            max-height: 0;
            transition: max-height 0.5s ease;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(107, 66, 38, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(107, 66, 38, 0); }
            100% { box-shadow: 0 0 0 0 rgba(107, 66, 38, 0); }
        }

        .morph-shape {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            animation: morph 8s ease-in-out infinite;
        }

        @keyframes morph {
            0% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
            100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        }

        .scroll-indicator {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .stagger-item {
            opacity: 0;
            transform: translateY(20px);
        }
    </style>
</head>
<body class="overflow-x-hidden">
    <!-- Header -->
    <header class="fixed w-full z-50 bg-surface shadow-md py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                    <span class="text-white font-bold">SV</span>
                </div>
                <span class="text-xl font-bold text-primary">StyleVault</span>
            </div>
            <nav class="hidden md:flex space-x-8">
                <a href="#" class="font-medium hover:text-primary transition">Home</a>
                <a href="#" class="font-medium hover:text-primary transition">Collections</a>
                <a href="#" class="font-medium hover:text-primary transition">New Arrivals</a>
                <a href="#" class="font-medium hover:text-primary transition">About</a>
                <a href="#" class="font-medium text-primary border-b-2 border-primary">Contact</a>
            </nav>
            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-full hover:bg-gray-100 transition">
                    <i class="fas fa-search text-gray-600"></i>
                </button>
                <button class="p-2 rounded-full hover:bg-gray-100 transition">
                    <i class="fas fa-shopping-bag text-gray-600"></i>
                </button>
                <button class="md:hidden p-2 rounded-full hover:bg-gray-100 transition">
                    <i class="fas fa-bars text-gray-600"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 gradient-bg relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h1 class="text-5xl md:text-7xl font-bold mb-6" id="hero-title">Get In Touch</h1>
                <p class="text-xl md:text-2xl mb-10 opacity-90">We're here to help with any questions about our premium clothing collections</p>
                
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6 mb-16">
                    <a href="#contact-form" class="btn-primary px-8 py-4 rounded-full font-semibold text-lg inline-flex items-center justify-center">
                        <span>Send a Message</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <a href="#contact-info" class="bg-white text-primary px-8 py-4 rounded-full font-semibold text-lg inline-flex items-center justify-center">
                        <span>Contact Info</span>
                        <i class="fas fa-info-circle ml-2"></i>
                    </a>
                </div>
                
                <div class="scroll-indicator">
                    <a href="#contact-form" class="text-white opacity-70 hover:opacity-100 transition">
                        <i class="fas fa-chevron-down text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Floating elements -->
        <div class="absolute top-20 left-5 w-20 h-20 bg-white opacity-10 rounded-full floating"></div>
        <div class="absolute top-40 right-10 w-16 h-16 bg-secondary opacity-20 rounded-full floating" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-20 w-12 h-12 bg-accent opacity-30 rounded-full floating" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-40 right-20 w-14 h-14 bg-white opacity-15 rounded-full floating" style="animation-delay: 1.5s;"></div>
    </section>

    <!-- Contact Form & Info Section -->
    <section class="py-20 bg-surface" id="contact-form">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Contact Form -->
                <div class="bg-surface rounded-2xl p-8 shadow-xl contact-card" data-aos="fade-right">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-envelope text-white text-xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-primary">Send Us a Message</h2>
                    </div>
                    
                    <form id="contact-form" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <input type="text" name="first_name" id="first-name" class="form-input" placeholder=" " required>
                                <label for="first-name" class="form-label">First Name</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="last_name" id="last-name" class="form-input" placeholder=" " required>
                                <label for="last-name" class="form-label">Last Name</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-input" placeholder=" " required>
                            <label for="email" class="form-label">Email Address</label>
                        </div>
                        
                        <div class="form-group">
                            <input type="tel" name="phone" id="phone" class="form-input" placeholder=" ">
                            <label for="phone" class="form-label">Phone Number</label>
                        </div>
                        
                        <div class="form-group">
                            <select id="subject" name="subject" class="form-input">
                                <option value="" disabled selected> </option>
                                <option value="product-inquiry">Product Inquiry</option>
                                <option value="order-support">Order Support</option>
                                <option value="shipping">Shipping & Delivery</option>
                                <option value="returns">Returns & Exchanges</option>
                                <option value="wholesale">Wholesale Inquiry</option>
                                <option value="other">Other</option>
                            </select>
                            <label for="subject" class="form-label">Subject</label>
                        </div>
                        
                        <div class="form-group">
                            <textarea id="message" name="message" rows="6" class="form-input" placeholder=" " required></textarea>
                            <label for="message" class="form-label">Message</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" id="newsletter" class="h-5 w-5 text-primary focus:ring-primary border-gray-300 rounded">
                            <label for="newsletter" class="ml-3 block text-sm text-gray-700">
                                Subscribe to our newsletter for updates and promotions
                            </label>
                        </div>
                        
                        <button type="submit" class="btn-primary w-full py-4 rounded-xl font-semibold text-lg mt-6 pulse-animation">
                            Send Message
                            <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Contact Information -->
                <div id="contact-info">
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold text-primary mb-4">Contact Information</h2>
                        <p class="text-gray-600 text-lg">We're available to answer your questions and help you find the perfect clothing items. Reach out to us through any of the following channels.</p>
                    </div>
                    
                    <div class="space-y-8">
                        <!-- Contact Card 1 -->
                        <div class="contact-card bg-surface rounded-2xl p-6 flex items-start shadow-lg hover:shadow-xl transition">
                            <div class="bg-primary text-white p-4 rounded-xl mr-5">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-primary mb-2">Visit Our Store</h3>
                                <p class="text-gray-600">123 Fashion Street, Style City, SC 12345</p>
                                <p class="text-gray-600 mt-1">Open Monday - Saturday, 9AM - 8PM</p>
                            </div>
                        </div>
                        
                        <!-- Contact Card 2 -->
                        <div class="contact-card bg-surface rounded-2xl p-6 flex items-start shadow-lg hover:shadow-xl transition">
                            <div class="bg-primary text-white p-4 rounded-xl mr-5">
                                <i class="fas fa-phone text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-primary mb-2">Call Us</h3>
                                <p class="text-gray-600">+1 (555) 123-4567</p>
                                <p class="text-gray-600 mt-1">Customer Service: Mon-Fri, 8AM-6PM EST</p>
                            </div>
                        </div>
                        
                        <!-- Contact Card 3 -->
                        <div class="contact-card bg-surface rounded-2xl p-6 flex items-start shadow-lg hover:shadow-xl transition">
                            <div class="bg-primary text-white p-4 rounded-xl mr-5">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-primary mb-2">Email Us</h3>
                                <p class="text-gray-600">info@stylevault.com</p>
                                <p class="text-gray-600 mt-1">We typically respond within 24 hours</p>
                            </div>
                        </div>
                        
                        <!-- Contact Card 4 -->
                        <div class="contact-card bg-surface rounded-2xl p-6 flex items-start shadow-lg hover:shadow-xl transition">
                            <div class="bg-primary text-white p-4 rounded-xl mr-5">
                                <i class="fas fa-comments text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-primary mb-2">Live Chat</h3>
                                <p class="text-gray-600">Available during business hours</p>
                                <p class="text-gray-600 mt-1">Click the chat icon in the bottom right</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold text-primary mb-6">Follow Us</h3>
                        <div class="flex space-x-5">
                            <a href="#" class="social-icon h-14 w-14 bg-primary text-white rounded-full flex items-center justify-center hover:bg-primary-hover">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="#" class="social-icon h-14 w-14 bg-primary text-white rounded-full flex items-center justify-center hover:bg-primary-hover">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a href="#" class="social-icon h-14 w-14 bg-primary text-white rounded-full flex items-center justify-center hover:bg-primary-hover">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="social-icon h-14 w-14 bg-primary text-white rounded-full flex items-center justify-center hover:bg-primary-hover">
                                <i class="fab fa-pinterest text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-background-color">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Find quick answers to common questions about our products and services.</p>
            </div>
            
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- FAQ Item 1 -->
                <div class="faq-item bg-surface rounded-2xl shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left p-6 flex justify-between items-center focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">What is your return policy?</span>
                        <i class="faq-icon fas fa-chevron-down text-primary transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 pb-6">
                        <p class="text-gray-600">We offer a 30-day return policy for all items in original condition with tags attached. Custom and clearance items are final sale. Returns are free for store credit, or a refund to the original payment method minus a $7.99 restocking fee.</p>
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="faq-item bg-surface rounded-2xl shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left p-6 flex justify-between items-center focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">How long does shipping take?</span>
                        <i class="faq-icon fas fa-chevron-down text-primary transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 pb-6">
                        <p class="text-gray-600">Standard shipping takes 5-7 business days. Express shipping (2-3 business days) and overnight shipping are also available at checkout. Delivery times may vary during holiday seasons or due to unforeseen circumstances.</p>
                    </div>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="faq-item bg-surface rounded-2xl shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left p-6 flex justify-between items-center focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">Do you offer international shipping?</span>
                        <i class="faq-icon fas fa-chevron-down text-primary transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 pb-6">
                        <p class="text-gray-600">Yes, we ship to over 50 countries worldwide. International shipping costs and delivery times vary by location. Additional customs fees or import taxes may apply and are the responsibility of the customer.</p>
                    </div>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="faq-item bg-surface rounded-2xl shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left p-6 flex justify-between items-center focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">Can I track my order?</span>
                        <i class="faq-icon fas fa-chevron-down text-primary transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 pb-6">
                        <p class="text-gray-600">Yes, once your order ships, you'll receive a tracking number via email. You can also track your order by logging into your account on our website and viewing your order history.</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <p class="text-gray-600 mb-6 text-lg">Still have questions?</p>
                <a href="#contact-form" class="btn-primary px-8 py-4 rounded-full font-semibold text-lg inline-flex items-center">
                    <span>Contact Us</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-20 bg-surface">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Visit Our Store</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Come see our premium clothing collection in person at our flagship store.</p>
            </div>
            
            <div class="rounded-2xl overflow-hidden shadow-2xl mb-16">
                <!-- Embedded Google Map -->
                <div class="w-full h-96 bg-gray-200">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.9503398796587!2d-73.99104868459418!3d40.750322379327976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1629990000000!5m2!1sen!2sus" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="text-center">
                    <div class="bg-primary text-white h-20 w-20 rounded-full flex items-center justify-center mx-auto mb-6 pulse-animation">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Store Hours</h3>
                    <p class="text-gray-600">Monday - Saturday: 9AM - 8PM</p>
                    <p class="text-gray-600">Sunday: 11AM - 6PM</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-primary text-white h-20 w-20 rounded-full flex items-center justify-center mx-auto mb-6 pulse-animation" style="animation-delay: 0.5s;">
                        <i class="fas fa-parking text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Parking</h3>
                    <p class="text-gray-600">Complimentary valet parking available</p>
                    <p class="text-gray-600">Underground garage with 200+ spaces</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-primary text-white h-20 w-20 rounded-full flex items-center justify-center mx-auto mb-6 pulse-animation" style="animation-delay: 1s;">
                        <i class="fas fa-concierge-bell text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Services</h3>
                    <p class="text-gray-600">Personal styling consultations</p>
                    <p class="text-gray-600">Custom tailoring and alterations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                            <span class="text-primary font-bold">SV</span>
                        </div>
                        <span class="text-xl font-bold">StyleVault</span>
                    </div>
                    <p class="text-gray-300 mb-4">Premium clothing for the modern individual. Quality, style, and comfort in every piece.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Home</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">New Arrivals</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Collections</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Sale</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">About Us</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-6">Customer Care</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Size Guide</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Shipping Info</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Returns & Exchanges</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Contact Us</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-6">Newsletter</h3>
                    <p class="text-gray-300 mb-4">Subscribe to get special offers, free giveaways, and exclusive deals.</p>
                    <div class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-3 w-full rounded-l-lg text-gray-800 focus:outline-none">
                        <button class="bg-secondary text-gray-800 px-4 rounded-r-lg font-semibold hover:bg-secondary-hover transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2023 StyleVault. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Floating Action Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <button class="btn-primary h-14 w-14 rounded-full shadow-lg flex items-center justify-center pulse-animation">
            <i class="fas fa-comments text-xl"></i>
        </button>
    </div>

    <script>
        // Initialize GSAP and ScrollTrigger
        gsap.registerPlugin(ScrollTrigger, TextPlugin);

        // Hero section animation
        gsap.timeline()
            .fromTo("#hero-title", 
                { opacity: 0, y: 50 }, 
                { opacity: 1, y: 0, duration: 1, ease: "power3.out" }
            )
            .fromTo(".scroll-indicator", 
                { opacity: 0 }, 
                { opacity: 1, duration: 0.8 }, "-=0.5"
            );

        // Animate elements on scroll
        gsap.utils.toArray('.contact-card, .faq-item, .text-center').forEach(element => {
            gsap.fromTo(element, 
                { opacity: 0, y: 30 }, 
                { 
                    opacity: 1, 
                    y: 0, 
                    duration: 0.8, 
                    scrollTrigger: {
                        trigger: element,
                        start: "top 80%",
                        end: "bottom 20%",
                        toggleActions: "play none none reverse"
                    }
                }
            );
        });

        // Form submission with AJAX
        $(document).ready(function() {
            // Set up CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#contact-form').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                
                // Show loading state
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Sending...');
                submitBtn.prop('disabled', true);

                // Simulate AJAX request (replace with actual endpoint)
                setTimeout(() => {
                    // In a real implementation, you would use:
                    // $.ajax({
                    //     url: "{{ route('contact.store') }}",
                    //     method: "POST",
                    //     data: formData,
                    //     processData: false,
                    //     contentType: false,
                    //     success: function(response) {
                    //         // Success handling
                    //     },
                    //     error: function(xhr) {
                    //         // Error handling
                    //     }
                    // });

                    // For demo purposes, we'll just show a success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Message Sent!',
                        text: 'Your message has been sent successfully! We\'ll get back to you soon.',
                        confirmButtonColor: 'var(--primary-color)'
                    });
                    
                    // Reset form
                    $('#contact-form')[0].reset();
                    
                    // Reset button
                    submitBtn.html(originalText);
                    submitBtn.prop('disabled', false);
                }, 1500);
            });

            // FAQ toggle functionality
            $('.faq-question').on('click', function() {
                const faqItem = $(this).closest('.faq-item');
                const isActive = faqItem.hasClass('active');
                
                // Close all FAQ items
                $('.faq-item').removeClass('active');
                
                // If the clicked item wasn't active, open it
                if (!isActive) {
                    faqItem.addClass('active');
                }
            });

            // Form label animation
            $('.form-input').on('focus', function() {
                $(this).siblings('.form-label').addClass('active');
            });
            
            $('.form-input').on('blur', function() {
                if ($(this).val() === '') {
                    $(this).siblings('.form-label').removeClass('active');
                }
            });

            // Initialize form labels based on existing values
            $('.form-input').each(function() {
                if ($(this).val() !== '') {
                    $(this).siblings('.form-label').addClass('active');
                }
            });
        });

        // Parallax effect for hero section
        gsap.to(".gradient-bg", {
            backgroundPosition: "50% 100%",
            ease: "none",
            scrollTrigger: {
                trigger: ".gradient-bg",
                start: "top top",
                end: "bottom top",
                scrub: true
            }
        });

        // Animated counter for statistics (if needed)
        // This is a placeholder for any statistics you might want to add
    </script>
</body>
</html>