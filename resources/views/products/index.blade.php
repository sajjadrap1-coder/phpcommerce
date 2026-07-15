@extends('layouts.app')

@section('title', 'محصولات')

@section('content')
<div class="container my-5">
    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white fw-semibold">
                    <i class="bi bi-funnel me-2"></i>فیلتر محصولات
                </div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET" id="filterForm">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <h6 class="fw-semibold mb-2">دسته‌بندی</h6>
                        <div class="list-group list-group-flush mb-3">
                            <a href="{{ route('products.index', request()->except('category')) }}"
                               class="list-group-item list-group-item-action py-1 {{ !request('category') ? 'active' : '' }}">
                                همه دسته‌بندی‌ها
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('products.index', array_merge(request()->except('category'), ['category' => $cat->slug])) }}"
                                   class="list-group-item list-group-item-action py-1 {{ request('category') === $cat->slug ? 'active' : '' }}">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>

                        <h6 class="fw-semibold mb-2">مرتب‌سازی</h6>
                        <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>جدیدترین</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>ارزان‌ترین</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>گران‌ترین</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">
                    @if(request('search'))
                        نتایج جستجو برای: «{{ request('search') }}»
                    @elseif(request('category'))
                        دسته‌بندی: {{ $categories->firstWhere('slug', request('category'))?->name }}
                    @else
                        همه محصولات
                    @endif
                </h4>
                <small class="text-muted">{{ $products->total() }} محصول یافت شد</small>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-search fs-1 text-muted"></i>
                    <p class="text-muted mt-3">محصولی یافت نشد.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">مشاهده همه محصولات</a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-sm-6 col-lg-4">
                            @include('products._card', ['product' => $product])
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
