@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container my-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">خانه</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">محصولات</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}">
                    {{ $product->category->name }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Product Image -->
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="img-fluid rounded shadow" alt="{{ $product->name }}">
            @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                     style="height:400px">
                    <i class="bi bi-image text-muted" style="font-size:5rem"></i>
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="col-md-7">
            <span class="badge bg-secondary mb-2">{{ $product->category->name }}</span>
            <h1 class="fw-bold mb-3">{{ $product->name }}</h1>

            <!-- Price -->
            <div class="mb-4">
                @if($product->isOnSale())
                    <div class="price-old fs-5 mb-1">{{ number_format($product->price) }} تومان</div>
                    <div class="fs-3 fw-bold text-danger">{{ number_format($product->sale_price) }} تومان</div>
                    <span class="badge bg-danger">
                        {{ round((1 - $product->sale_price / $product->price) * 100) }}% تخفیف
                    </span>
                @else
                    <div class="fs-3 fw-bold text-primary">{{ number_format($product->price) }} تومان</div>
                @endif
            </div>

            <!-- Stock Status -->
            <div class="mb-4">
                @if($product->stock > 0)
                    <span class="badge bg-success">
                        <i class="bi bi-check-circle me-1"></i>موجود در انبار ({{ $product->stock }} عدد)
                    </span>
                @else
                    <span class="badge bg-danger">
                        <i class="bi bi-x-circle me-1"></i>ناموجود
                    </span>
                @endif
            </div>

            <!-- Description -->
            @if($product->description)
                <div class="mb-4">
                    <h5 class="fw-semibold">توضیحات:</h5>
                    <p class="text-secondary">{{ $product->description }}</p>
                </div>
            @endif

            <!-- Add to Cart -->
            @if($product->stock > 0)
                @auth
                    <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-3 align-items-center">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="input-group" style="width:130px">
                            <label class="input-group-text" for="quantity">تعداد</label>
                            <input type="number" class="form-control" id="quantity"
                                   name="quantity" value="1" min="1" max="{{ $product->stock }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="bi bi-cart-plus me-2"></i>افزودن به سبد خرید
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">
                        <i class="bi bi-cart-plus me-2"></i>برای خرید وارد شوید
                    </a>
                @endauth
            @else
                <button class="btn btn-secondary btn-lg px-4" disabled>
                    <i class="bi bi-x-circle me-2"></i>ناموجود
                </button>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    @if($related->isNotEmpty())
        <section class="mt-5 pt-4 border-top">
            <h4 class="fw-bold mb-4">محصولات مرتبط</h4>
            <div class="row g-4">
                @foreach($related as $rProduct)
                    <div class="col-sm-6 col-md-3">
                        @include('products._card', ['product' => $rProduct])
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
