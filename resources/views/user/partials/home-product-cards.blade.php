@php
    $imagePath = $product->defaultImage 
        ? $product->defaultImage->image_path  // <-- your actual DB column here
        : null; // do not show default image if none exists
@endphp

{{-- Main Card Container --}}
<div class="product-card group relative flex flex-col w-full bg-white border border-gray-100/50 hover:shadow-xl hover:shadow-gray-200/40 transition-all duration-500 ease-out">
    
    {{-- Image Area (Aspect Ratio 3:4 for a fashion/editorial look) --}}
    <div class="relative w-full aspect-[3/4] overflow-hidden bg-gray-50">
        <a href="{{ route('product.show', $product->id) }}" class="block w-full h-full">
@if($product->defaultImage)
    <img 
        src="{{ asset('storage/' . $product->defaultImage->image_path) }}" 
        alt="{{ $product->name }}" 
        class="w-full h-full object-cover object-center transition-transform duration-700 ease-in-out group-hover:scale-105"
    >
@endif
 </a>

        <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out bg-gradient-to-t from-black/60 to-transparent">
            <a href="{{ route('product.show', $product->id) }}" 
               class="w-full block py-3 bg-white text-[var(--primary-color)] text-xs uppercase tracking-widest font-bold text-center hover:bg-[var(--primary-color)] hover:text-white transition-colors duration-300 backdrop-blur-sm">
                Add to Cart
            </a>
        </div>


    </div>

    {{-- Product Details (Clean & Centered) --}}
    <div class="p-5 text-center flex flex-col gap-2 relative bg-white z-10">
        
        {{-- SKU / Category (Small & Subtle) --}}
        <span class="text-[10px] uppercase tracking-[0.2em] text-gray-400">
            {{ $product->sku ?? 'Ref. 001' }}
        </span>

        {{-- Product Name --}}
        <h3 class="text-base font-medium text-gray-900 group-hover:text-[var(--primary-color)] transition-colors duration-300 font-serif">
            <a href="{{ route('product.show', $product->id) }}">
                {{ $product->name }}
            </a>
        </h3>

        {{-- Price --}}
        <div class="mt-1 flex justify-center items-center gap-3">
            <span class="text-sm font-semibold text-gray-900">
                ${{ number_format($product->price, 2) }}
            </span>
            
            @if($product->rating > 0)
                <div class="flex items-center gap-1 text-xs text-gray-400">
                    <i class="fas fa-star text-[10px]"></i>
                    <span>{{ $product->rating }}</span>
                </div>
            @endif
        </div>
    </div>
</div>