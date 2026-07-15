<div class="card product-card h-100 border-0 shadow-sm position-relative">
    @if($product->isOnSale())
        <span class="badge bg-danger badge-sale">تخفیف</span>
    @endif
    @if($product->is_featured)
        <span class="badge bg-warning text-dark" style="position:absolute;top:10px;left:10px;">ویژه</span>
    @endif

    <a href="{{ route('products.show', $product->slug) }}">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 class="card-img-top product-img" alt="{{ $product->name }}">
        @else
            <div class="card-img-top product-img bg-light d-flex align-items-center justify-content-center">
                <i class="bi bi-image text-muted fs-1"></i>
            </div>
        @endif
    </a>

    <div class="card-body d-flex flex-column">
        <small class="text-muted mb-1">{{ $product->category->name }}</small>
        <h6 class="card-title fw-semibold mb-2">
            <a href="{{ route('products.show', $product->slug) }}"
               class="text-dark text-decoration-none">{{ $product->name }}</a>
        </h6>
        <div class="mt-auto">
            <div class="mb-2">
                @if($product->isOnSale())
                    <span class="price-old small">{{ number_format($product->price) }} تومان</span>
                    <br>
                    <span class="fw-bold text-danger">{{ number_format($product->sale_price) }} تومان</span>
                @else
                    <span class="fw-bold text-primary">{{ number_format($product->price) }} تومان</span>
                @endif
            </div>

            @if($product->stock > 0)
                @auth
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-cart-plus me-1"></i>افزودن به سبد
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm w-100">
                        <i class="bi bi-cart-plus me-1"></i>افزودن به سبد
                    </a>
                @endauth
            @else
                <button class="btn btn-secondary btn-sm w-100" disabled>
                    <i class="bi bi-x-circle me-1"></i>ناموجود
                </button>
            @endif
        </div>
    </div>
</div>
