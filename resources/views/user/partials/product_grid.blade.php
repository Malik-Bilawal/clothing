<div id="products-grid" class="{{ $gridClass }}">
    @forelse($products as $product)
        @include('user.partials.product_grid_item', [
            'product' => $product,
            'gridPreference' => $gridPreference
        ])
    @empty
        <!-- <div class="col-span-full text-center py-16">
            <div class="max-w-md mx-auto">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-2xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">No Products Found</h3>
                <p class="text-gray-500 mb-6">Try adjusting your search or filter criteria</p>
                <button id="reset-filters" class="px-6 py-2 bg-[var(--primary-color)] text-white rounded-lg hover:bg-[var(--primary-hover)] transition-colors">
                    Reset Filters
                </button>
            </div>
        </div> -->
    @endforelse
</div>

@if($products->hasPages())
    <div class="mt-12" id="pagination-container">
        {{ $products->links() }}
    </div>
@endif