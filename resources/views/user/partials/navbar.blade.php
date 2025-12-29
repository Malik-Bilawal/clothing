<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeCollection - Premium Home Decor</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>



        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom scrollbar for search results */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s ease;
        }

        /* Overlay background */
        .overlay {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Custom animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        /* Custom gradient for buttons */
        .btn-gradient {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, var(--primary-hover) 0%, var(--primary-color) 100%);
        }

        /* Navbar hover effect */
        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: var(--secondary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Glass morphism effect for dropdown */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Mobile menu improvements */
        .mobile-menu-item {
            transition: all 0.2s ease;
            border-radius: 8px;
        }

        .mobile-menu-item:hover {
            background-color: rgba(139, 95, 191, 0.1);
        }

        /* Custom classes using root variables */
        .bg-primary {
            background-color: var(--primary-color);
        }
        
        .bg-primary-hover {
            background-color: var(--primary-hover);
        }
        
        .bg-secondary {
            background-color: var(--secondary-color);
        }
        
        .text-primary {
            color: var(--primary-color);
        }
        
        .text-secondary {
            color: var(--secondary-color);
        }
        
        .border-primary {
            border-color: var(--primary-color);
        }
        
        .hover\:bg-primary:hover {
            background-color: var(--primary-color);
        }
        
        .hover\:bg-primary-hover:hover {
            background-color: var(--primary-hover);
        }
        
        .hover\:text-primary:hover {
            color: var(--primary-color);
        }
        
        .hover\:text-secondary:hover {
            color: var(--secondary-color);
        }
        
        .focus\:ring-primary:focus {
            --tw-ring-color: var(--primary-color);
        }
        
        .bg-accent {
            background-color: var(--accent-color);
        }
        
        .hover\:bg-accent-hover:hover {
            background-color: var(--accent-hover);
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': 'var(--primary-color)',
                        'primary-hover': 'var(--primary-hover)',
                        'secondary': 'var(--secondary-color)',
                        'secondary-hover': 'var(--secondary-hover)',
                        'accent': 'var(--accent-color)',
                        'accent-hover': 'var(--accent-hover)',
                        'text-on-primary': 'var(--text-on-primary)',
                        'text-on-secondary': 'var(--text-on-secondary)',
                        'dark-gray': '#333333',
                        'light-gray': '#f8f9fa'
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif']
                    },
                    boxShadow: {
                        'smooth': '0 2px 20px rgba(0,0,0,0.08)',
                        'smooth-lg': '0 5px 30px rgba(0,0,0,0.1)'
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans bg-light-gray">
    <!-- Navigation Bar -->
    <nav class="bg-white text-dark-gray shadow-smooth sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="bg-primary p-2 rounded-xl">
                        <i class="fas fa-home text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-primary">HomeCollection</span>
                </div>

                <!-- Desktop Menu -->

<div class="hidden lg:flex space-x-8 font-[Poppins] text-[17px] tracking-wide">
  <a href="{{ route('home') }}" class="nav-link font-medium text-gray-700 hover:text-primary transition-all duration-300 relative after:content-[''] after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary hover:after:w-full after:transition-all after:duration-300">Home</a>
  <a href="{{ route('product') }}" class="nav-link font-medium text-gray-700 hover:text-primary transition-all duration-300 relative after:content-[''] after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary hover:after:w-full after:transition-all after:duration-300">Products</a>
  <a href="{{ route('category') }}" class="nav-link font-medium text-gray-700 hover:text-primary transition-all duration-300 relative after:content-[''] after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary hover:after:w-full after:transition-all after:duration-300">Category</a>
  <a href="{{ route('about') }}" class="nav-link font-medium text-gray-700 hover:text-primary transition-all duration-300 relative after:content-[''] after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary hover:after:w-full after:transition-all after:duration-300">About</a>
  <a href="{{ route('contact') }}" class="nav-link font-medium text-gray-700 hover:text-primary transition-all duration-300 relative after:content-[''] after:absolute after:w-0 after:h-[2px] after:left-0 after:-bottom-1 after:bg-primary hover:after:w-full after:transition-all after:duration-300">Contact</a>
</div>


                <!-- Icons -->
                <div class="flex items-center space-x-5">
                    <!-- Search Button -->
                    <button id="search-button" class="relative group">
                        <div class="p-2 rounded-full bg-light-gray group-hover:bg-primary group-hover:text-white transition-all">
                            <i class="fas fa-search text-lg"></i>
                        </div>
                        <span class="absolute -top-1 -right-1 bg-primary text-white text-xs w-5 h-5 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100 transition-opacity">?</span>
                    </button>

                 
                    <!-- Cart Button -->
                    <a href="{{ route('cart.index') }}" class="relative group">
    <div class="p-2 rounded-full bg-light-gray group-hover:bg-primary group-hover:text-white transition-all">
        <i class="fas fa-shopping-cart text-lg"></i>
    </div>

    @php
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\Session;
        use App\Models\Cart;

        $cartCount = 0;

        if (Auth::check()) {
            $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
        } else {
            $guestToken = Session::get('guest_token');

            if ($guestToken) {
                $cartCount = Cart::where('guest_token', $guestToken)->sum('quantity');
            } else {
                $sessionCart = session('cart', []);
                $cartCount = collect($sessionCart)->sum('quantity') ?: count($sessionCart);
            }
        }
    @endphp

    @if($cartCount > 0)
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
            {{ $cartCount }}
        </span>
    @endif
</a>


                    <!-- User Menu -->
                    <div class="relative inline-block text-left">
                        <!-- User Menu Button -->
                        <div class="relative">
                            <button class="group flex items-center" id="userMenuButton">
                                <div class="p-2 rounded-full bg-light-gray group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="fas fa-user text-lg"></i>
                                </div>
                            </button>

                            <!-- Dropdown -->
                            <div id="userMenuDropdown" class="hidden absolute right-0 mt-3 w-56 glass-effect shadow-smooth-lg rounded-xl overflow-hidden animate-fadeIn">
                                <div class="py-2">

                                    <!-- If Logged In -->
                                    @auth
                                        <div class="px-4 py-3 border-b border-gray-100">
                                            <p class="text-sm text-gray-500">Welcome back</p>
                                            <p class="font-medium text-dark-gray">{{ auth()->user()->name }}</p>
                                        </div>
                                        <div class="py-2">
                                           
                                        
                                        </div>
                                        <div class="border-t border-gray-100 mt-2 pt-2">
                                            <form action="" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-50 transition-all">
                                                    <i class="fas fa-sign-out-alt mr-3 text-primary"></i>Logout
                                                </button>
                                            </form>
                                        </div>
                                    @endauth

                                    <!-- If Not Logged In -->
                                    @guest
                                        <div class="guest-section">
                                            <a href="" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 transition-all">
                                                <i class="fas fa-sign-in-alt mr-3 text-primary"></i>Login
                                            </a>
                                            <a href="" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 transition-all">
                                                <i class="fas fa-user-plus mr-3 text-primary"></i>Register
                                            </a>
                                        </div>
                                    @endguest

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg bg-light-gray hover:bg-primary hover:text-white transition-all">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden mt-4 hidden bg-white rounded-xl shadow-smooth-lg p-4 animate-fadeIn">
                <div class="flex flex-col space-y-2">
                    <a href="" class="mobile-menu-item font-medium text-dark-gray hover:text-primary hover:bg-primary/5 py-3 px-4 transition-all rounded-lg">Home</a>
                    <a href="{{ route('product') }}" class="mobile-menu-item font-medium text-dark-gray hover:text-primary hover:bg-primary/5 py-3 px-4 transition-all rounded-lg">Products</a>
                    <a href="#featured" class="mobile-menu-item font-medium text-dark-gray hover:text-primary hover:bg-primary/5 py-3 px-4 transition-all rounded-lg">Furniture</a>
                    <a href="#offers" class="mobile-menu-item font-medium text-dark-gray hover:text-primary hover:bg-primary/5 py-3 px-4 transition-all rounded-lg">Decor</a>
                    <a href="#" class="mobile-menu-item font-medium text-dark-gray hover:text-primary hover:bg-primary/5 py-3 px-4 transition-all rounded-lg">Lighting</a>
                    
                    <div class="border-t border-gray-100 pt-4 mt-2">
                        <div class="flex space-x-4">
                            <a href="#" class="flex-1 text-center bg-primary text-white py-2 rounded-lg font-medium btn-gradient transition-all">
                                My Account
                            </a>
                            <a href="" class="flex-1 text-center bg-primary text-white py-2 rounded-lg font-medium btn-gradient transition-all">
                                Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Search Drawer -->
    <div id="search-drawer" class="fixed inset-y-0 right-0 w-full md:w-2/5 lg:w-1/3 bg-white shadow-smooth-lg transform translate-x-full z-50 transition-all duration-300">
        <div class="p-6 h-full flex flex-col">
            <!-- Header -->
            <div class="flex justify-between items-center pb-4 border-b">
                <div class="flex items-center space-x-3">
                    <div class="bg-primary p-2 rounded-lg">
                        <i class="fas fa-search text-white"></i>
                    </div>
                    <h2 class="text-xl font-bold text-dark-gray">Search Products</h2>
                </div>
                <button id="close-search" class="text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-100 transition-all">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Search Input -->
            <div class="py-6">
                <div class="relative">
                    <input
                        type="text"
                        id="search-input"
                        placeholder="Search for furniture, decor, lighting..."
                        class="w-full p-4 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- Popular Searches -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-dark-gray mb-3">Popular Searches</h3>
                @php
                use App\Models\Product;
                $product = Product::latest()->take(5)->get();
                $popularSearches = $product->pluck('name');
                    @endphp
                <div class="flex flex-wrap gap-2">
                  
                    @foreach($popularSearches as $search)
                        <span class="bg-light-gray text-dark-gray px-3 py-2 rounded-full text-sm cursor-pointer hover:bg-primary hover:text-white transition-all">{{ $search }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Search Results -->
            <div id="search-results" class="flex-1 overflow-y-auto custom-scrollbar hidden">
                <!-- Search results will be populated here -->
            </div>

            <!-- Default content when no search is active -->
            <div id="popular-recent" class="flex-1 overflow-y-auto custom-scrollbar">
                <h3 class="text-lg font-semibold text-dark-gray mb-3">Recent Searches</h3>
                <div class="space-y-2">
                    <div class="flex items-center p-3 hover:bg-light-gray rounded-xl cursor-pointer transition-all">
                        <i class="fas fa-history text-gray-400 mr-3"></i>
                        <span class="text-gray-700">Leather Sofa</span>
                        <button class="ml-auto text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-200 transition-all">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                    <div class="flex items-center p-3 hover:bg-light-gray rounded-xl cursor-pointer transition-all">
                        <i class="fas fa-history text-gray-400 mr-3"></i>
                        <span class="text-gray-700">Coffee Table</span>
                        <button class="ml-auto text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-200 transition-all">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                    <div class="flex items-center p-3 hover:bg-light-gray rounded-xl cursor-pointer transition-all">
                        <i class="fas fa-history text-gray-400 mr-3"></i>
                        <span class="text-gray-700">Bookshelf</span>
                        <button class="ml-auto text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-200 transition-all">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                </div>

                <!-- Suggested Categories -->
                <h3 class="text-lg font-semibold text-dark-gray mt-6 mb-3">Browse Categories</h3>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-light-gray p-4 rounded-xl text-center cursor-pointer hover:bg-primary hover:text-white transition-all group">
                        <i class="fas fa-couch text-xl mb-2 group-hover:text-white text-primary"></i>
                        <p class="text-sm font-medium">Furniture</p>
                    </div>
                    <div class="bg-light-gray p-4 rounded-xl text-center cursor-pointer hover:bg-primary hover:text-white transition-all group">
                        <i class="fas fa-palette text-xl mb-2 group-hover:text-white text-primary"></i>
                        <p class="text-sm font-medium">Decor</p>
                    </div>
                    <div class="bg-light-gray p-4 rounded-xl text-center cursor-pointer hover:bg-primary hover:text-white transition-all group">
                        <i class="fas fa-lightbulb text-xl mb-2 group-hover:text-white text-primary"></i>
                        <p class="text-sm font-medium">Lighting</p>
                    </div>
                    <div class="bg-light-gray p-4 rounded-xl text-center cursor-pointer hover:bg-primary hover:text-white transition-all group">
                        <i class="fas fa-blanket text-xl mb-2 group-hover:text-white text-primary"></i>
                        <p class="text-sm font-medium">Textiles</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-0 pointer-events-none z-40 transition-opacity duration-300"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function(){
            // User dropdown
            $('#userMenuButton').on('click', function(e){
                e.stopPropagation();
                $('#userMenuDropdown').toggleClass('hidden');
            });

            $(document).on('click', function(){
                $('#userMenuDropdown').addClass('hidden');
            });

            // Mobile menu
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Search drawer functionality
            const searchButton = document.getElementById('search-button');
            const searchDrawer = document.getElementById('search-drawer');
            const closeSearch = document.getElementById('close-search');
            const overlay = document.getElementById('overlay');

            function openSearchDrawer() {
                searchDrawer.classList.remove('translate-x-full');
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-50', 'pointer-events-auto');
                document.body.style.overflow = 'hidden';
            }

            function closeSearchDrawer() {
                searchDrawer.classList.add('translate-x-full');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                overlay.classList.remove('opacity-50', 'pointer-events-auto');
                document.body.style.overflow = '';
            }

            const searchInput = document.getElementById('search-input');
const searchResults = document.getElementById('search-results');
const popularRecent = document.getElementById('popular-recent');

// --- Load recent searches when drawer opens ---
document.addEventListener('DOMContentLoaded', showRecentSearches);

// --- Search input handler ---
searchInput.addEventListener('input', function () {
    const query = this.value.trim();

    if (query.length > 0) {
        popularRecent.classList.add('hidden');
        searchResults.classList.remove('hidden');

        // --- Save search query to localStorage ---
        saveSearchQuery(query);

        // --- AJAX search ---
        fetch(`/search-products?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                searchResults.innerHTML = '';

                if (data.length === 0) {
                    searchResults.innerHTML = `
                        <div class="flex flex-col items-center justify-center py-10">
                            <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg">No products found</p>
                            <p class="text-gray-400 text-sm mt-2">Try different keywords</p>
                        </div>
                    `;
                    return;
                }

                data.forEach(product => {
    // Calculate discount percentage if offer exists
    let discountBadge = '';
    if (product.offer_price) {
        const percent = Math.round(((product.price - product.offer_price) / product.price) * 100);
        discountBadge = `<span class="absolute top-0 left-0 bg-[var(--secondary-color)] text-white text-[10px] font-bold px-2 py-0.5 rounded-br-lg rounded-tl-lg shadow-sm z-10">-${percent}%</span>`;
    }

    searchResults.innerHTML += `
        <a href="/product/${product.id}" class="group block border-b border-[var(--border-color)] last:border-0">
            <div class="relative flex items-center gap-4 p-4 hover:bg-[var(--background-color)] transition-all duration-300 ease-out hover:pl-6">
                
                <div class="relative h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl border border-[var(--border-color)] shadow-sm group-hover:shadow-md transition-shadow">
                    ${discountBadge}
                    <img src="/storage/${product.image}" class="h-full w-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                </div>

                <div class="flex-1 min-w-0">
                    <h4 class="text-[var(--primary-color)] font-bold truncate group-hover:text-[var(--secondary-color)] transition-colors text-lg font-['Outfit']">
                        ${product.name}
                    </h4>
                    
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-[var(--accent-color)] font-bold">
                            $${product.offer_price ?? product.price}
                        </span>

                        ${product.offer_price ? `
                            <span class="text-gray-400 text-xs line-through decoration-[var(--primary-color)]/30">
                                $${product.price}
                            </span>
                        ` : ''}
                    </div>
                </div>

                <div class="opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                    <div class="h-10 w-10 flex items-center justify-center rounded-full bg-[var(--primary-color)] text-white shadow-lg hover:bg-[var(--secondary-color)] transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>

            </div>
        </a>
    `;

                });
            });
    } else {
        // --- show recent searches when input is cleared ---
        popularRecent.classList.remove('hidden');
        searchResults.classList.add('hidden');
        showRecentSearches();
    }
});

// --- Save search query ---
function saveSearchQuery(query) {
    let searches = JSON.parse(localStorage.getItem('recentSearches')) || [];

    // remove duplicates (case-insensitive)
    searches = searches.filter(item => item.toLowerCase() !== query.toLowerCase());

    // add latest at top
    searches.unshift(query);

    // keep only last 10
    if (searches.length > 10) searches.pop();

    localStorage.setItem('recentSearches', JSON.stringify(searches));
}

// --- Show recent searches dynamically ---
function showRecentSearches() {
    const searches = JSON.parse(localStorage.getItem('recentSearches')) || [];

    if (searches.length === 0) {
        popularRecent.innerHTML = `
            <h3 class="text-lg font-semibold text-dark-gray mb-3">Recent Searches</h3>
            <p class="text-gray-500 text-center py-4">No recent searches</p>`;
        return;
    }

    const listHTML = searches.map(query => `
        <div class="flex items-center p-3 hover:bg-light-gray rounded-xl cursor-pointer transition-all recent-item" data-query="${query}">
            <i class="fas fa-history text-gray-400 mr-3"></i>
            <span class="text-gray-700 flex-1">${query}</span>
            <button class="ml-auto text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-200 transition-all remove-btn" data-query="${query}">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
    `).join('');

    popularRecent.innerHTML = `
        <h3 class="text-lg font-semibold text-dark-gray mb-3">Recent Searches</h3>
        <div class="space-y-2">${listHTML}</div>
    `;

    // --- Click to re-search ---
    document.querySelectorAll('.recent-item').forEach(item => {
        item.addEventListener('click', function (e) {
            if (e.target.closest('.remove-btn')) return; // ignore delete clicks
            const query = this.dataset.query;
            searchInput.value = query;
            searchInput.dispatchEvent(new Event('input')); // trigger live search
        });
    });

    // --- Remove recent search ---
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            removeSearchQuery(this.dataset.query);
        });
    });
}

// --- Remove query from localStorage ---
function removeSearchQuery(query) {
    let searches = JSON.parse(localStorage.getItem('recentSearches')) || [];
    searches = searches.filter(item => item.toLowerCase() !== query.toLowerCase());
    localStorage.setItem('recentSearches', JSON.stringify(searches));
    showRecentSearches();
}

            searchButton.addEventListener('click', openSearchDrawer);
            closeSearch.addEventListener('click', closeSearchDrawer);
            overlay.addEventListener('click', closeSearchDrawer);

            // Close search drawer with Escape key
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeSearchDrawer();
                }
            });

            // Popular search tags click handler
            document.querySelectorAll('.bg-light-gray.text-dark-gray').forEach(tag => {
                tag.addEventListener('click', () => {
                    document.getElementById('search-input').value = tag.textContent.trim();
                    document.getElementById('search-input').focus();
                    // Trigger the input event to show results
                    const event = new Event('input', { bubbles: true });
                    document.getElementById('search-input').dispatchEvent(event);
                });
            });
        });

    </script>
</body>
</html>