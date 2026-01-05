@php
    $defaultImage = $product->images->firstWhere('is_default', true);
    $defaultImagePath = $defaultImage ? $defaultImage->image_path : ($product->images->first()->image_path ?? 'path/to/your/placeholder.jpg');
    $defaultColorId = $product->colors->first()->id ?? '';
    $defaultSizeId = $product->sizes->first()->id ?? '';
@endphp

<div class="product-card-container bg-[var(--surface-color)] rounded-lg shadow-xl overflow-hidden flex flex-col md:flex-row w-[90vw] sm:w-[500px] md:w-[700px] lg:w-[800px] flex-shrink-0"
     data-aos="fade-up"
     data-product-id="{{ $product->id }}"
     data-product-price="{{ $product->price }}"
     data-selected-color-id="{{ $defaultColorId }}"
     data-selected-size-id="{{ $defaultSizeId }}">
    
    <div class="w-full md:w-2/5 p-5 flex items-center justify-center bg-[var(--background-color)]">
        <img id="product-image-{{ $product->id }}"
             src="{{ asset('storage/app/public/'. $defaultImagePath) }}"
             alt="{{ $product->name }}"
             class="w-full h-64 object-contain rounded-md transition-all duration-300">
    </div>

    <div class="w-full md:w-3/5 p-6 flex flex-col justify-between">
                        
        <div>
            <span class="text-xs text-[var(--secondary-color)] tracking-wider uppercase">Model: {{ $product->sku ?? 'N/A' }}</span>
            <h2 class="text-2xl font-bold text-[var(--primary-color)] mt-1 mb-2 hover:text-[var(--primary-hover)] transition-colors duration-200">
                <a href="#">{{ $product->name }}</a>
            </h2>

            <div class="mb-5">
                <span class="product-price-display text-3xl font-extrabold text-[var(--accent-color)]">${{ number_format($product->price, 2) }}</span>
            </div>

            {{-- Colors --}}
            @if($product->colors && $product->colors->isNotEmpty())
            <div class="mb-4">
                <h4 class="text-sm font-medium text-[var(--primary-color)] mb-2">Choose your color:</h4>
                <div class="flex gap-2">
                    @foreach($product->colors as $index => $color)
                        @php
                            $colorImagePath = $color->images->first()->image_path ?? $defaultImagePath;
                        @endphp
                        <button
                            type="button"
                            class="color-swatch w-8 h-8 rounded-full border-2 border-[var(--border-color)] transition-all duration-200
                                    {{ $index == 0 ? 'ring-2 ring-[var(--primary-color)] ring-offset-2' : '' }}
                                    hover:scale-110"
                            style="background-color: {{ $color->hex_code }};"
                            title="{{ $color->name }}"
                            data-image-src="{{ asset('storage/app/public/'. $colorImagePath) }}"
                            data-target-image="product-image-{{ $product->id }}"
                            data-product-id="{{ $product->id }}"
                            data-color-id="{{ $color->id }}">
                        </button>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Sizes --}}
            @if($product->sizes && $product->sizes->isNotEmpty())
            <div class="mb-5">
                <h4 class="text-sm font-medium text-[var(--primary-color)] mb-2">Select size:</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach($product->sizes as $index => $size)
                        <button type="button" class="size-swatch text-sm font-semibold px-4 py-2 border rounded-md transition-all
                                                        {{ $index == 0 ? 'bg-[var(--primary-color)] text-[var(--text-on-primary)] border-[var(--primary-color)]' : 'border-[var(--border-color)] hover:border-[var(--primary-color)] hover:bg-[var(--background-color)]' }}"
                                data-size-id="{{ $size->id }}"
                                data-size-price="{{ $size->price ?? '' }}">
                            {{ $size->name }}
                        </button>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="mt-auto grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center justify-between border border-[var(--border-color)] rounded-md px-3">
                <label class="text-sm font-medium text-[var(--primary-color)]">Quantity:</label>
                <div class="flex items-center">
                    <button class="quantity-btn down p-2 text-[var(--secondary-color)] hover:text-[var(--primary-color)] disabled:opacity-50" disabled>&minus;</button>
                    <input type="text" class="quantity-input w-10 text-center border-none focus:ring-0 p-0" value="1" min="1" readonly>
                    <button class="quantity-btn up p-2 text-[var(--secondary-color)] hover:text-[var(--primary-color)]">&plus;</button>
                </div>
            </div>
            
            <button class="add-to-cart-btn w-full bg-[var(--primary-color)] text-[var(--text-on-primary)] font-semibold py-3 px-4 rounded-md hover:bg-[var(--primary-hover)] transition-all duration-300 shadow-lg hover:shadow-[var(--primary-color)]/50">
                <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
            </button>
        </div>
    </div>
</div>
