@extends('layouts.app')

@section('title', 'خانه - فروشگاه آنلاین')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-white py-5 mb-5">
        <div class="container text-center py-4">
            <h1 class="display-4 fw-bold mb-3">خوش آمدید به فروشگاه آنلاین</h1>
            <p class="lead mb-4">بهترین محصولات با بهترین قیمت‌ها</p>
            <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-5">
                <i class="bi bi-bag-heart me-2"></i>مشاهده محصولات
            </a>
        </div>
    </section>

    <div class="container">
        <!-- Categories -->
        @if($categories->isNotEmpty())
            <section class="mb-5">
                <h2 class="mb-4 fw-bold">دسته‌بندی‌ها</h2>
                <div class="row g-3">
                    @foreach($categories as $category)
                        <div class="col-6 col-md-4 col-lg-2">
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                               class="card text-center text-decoration-none h-100 border-0 shadow-sm">
                                <div class="card-body py-3">
                                    <i class="bi bi-tags fs-2 text-primary mb-2 d-block"></i>
                                    <span class="fw-semibold text-dark">{{ $category->name }}</span>
                                    <small class="text-muted d-block">({{ $category->products_count }} محصول)</small>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Featured Products -->
        @if($featuredProducts->isNotEmpty())
            <section class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">محصولات ویژه</h2>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                        مشاهده همه <i class="bi bi-arrow-left ms-1"></i>
                    </a>
                </div>
                <div class="row g-4">
                    @foreach($featuredProducts as $product)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            @include('products._card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </section>
        @else
            <div class="text-center py-5">
                <i class="bi bi-shop fs-1 text-muted"></i>
                <p class="text-muted mt-3">هنوز محصولی اضافه نشده است.</p>
            </div>
        @endif
    </div>
@endsection
