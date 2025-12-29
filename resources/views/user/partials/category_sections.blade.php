@forelse($categories as $category)
    <div class="category-section relative overflow-hidden" 
         data-category-id="{{ $category->id }}"
         data-total-products="{{ $category->filtered_products_count }}"
         data-products-loaded="{{ $category->product->count() }}">
        
        <h2 class="text-4xl font-extrabold mb-6 tracking-wide text-[var(--primary-color)] hover:text-[var(--primary-hover)] transition-colors duration-300">
            {{ $category->name }}
        </h2>
        <p class="text-[var(--secondary-color)] text-base max-w-2xl">
            {{ $category->description }}
        </p>

        <button
            class="scroll-btn ... hidden text-[var(--primary-color)] hover:text-[var(--primary-hover)]"
            data-target="product-carousel-{{ $category->id }}" data-direction="left">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button
            class="scroll-btn ... hidden text-[var(--primary-color)] hover:text-[var(--primary-hover)]"
            data-target="product-carousel-{{ $category->id }}" data-direction="right">
            <i class="fas fa-chevron-right"></i>
        </button>

        <div id="product-carousel-{{ $category->id }}" class="flex overflow-visible gap-6 pb-6">
            
            @foreach($category->product as $product)
                @include('user.partials.product_cards', ['product' => $product])
            @endforeach
       
            @if($category->filtered_products_count > $category->product->count())
                <div class="load-more-card bg-[var(--surface-color)] rounded-lg shadow-xl overflow-hidden flex flex-col md:flex-row w-[90vw] sm:w-[500px] md:w-[700px] lg:w-[800px] flex-shrink-0 cursor-pointer hover:bg-[var(--background-color)] transition-all"
                     data-category-id="{{ $category->id }}">
                    
                    <div class="w-full md:w-2/5 p-5 flex items-center justify-center">
                        <div class="w-full h-64 flex items-center justify-center">
                            <i class="fas fa-plus text-6xl text-[var(--secondary-color)]"></i>
                        </div>
                    </div>

                    <div class="w-full md:w-3/5 p-6 flex flex-col justify-center items-center text-center">
                        <h3 class="text-2xl font-bold text-[var(--primary-color)]">Load More</h3>
                        <p class="text-[var(--secondary-color)]">
                            Show all {{ $category->filtered_products_count }} products
                        </p>
                        <div class="spinner hidden mt-4">
                            <i class="fas fa-spinner fa-spin text-3xl text-[var(--primary-color)]"></i>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <div class="progress-bar-container absolute bottom-10 left-1/2 -translate-x-1/2 w-64 h-2 bg-[var(--border-color)]/40 z-50 overflow-hidden rounded-full">
            <div class="progress-bar h-full bg-[var(--primary-color)] rounded-full" style="width: 0%"></div>
        </div>

    </div>
@empty
    <div class="text-center p-12">
        <h3 class="text-2xl font-semibold text-[var(--primary-color)]">No Products Found</h3>
        <p class="text-[var(--secondary-color)]">Try adjusting your filters.</p>
    </div>
@endforelse
