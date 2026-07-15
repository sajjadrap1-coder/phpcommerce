@extends('layouts.app')

@section('title', 'سبد خرید')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="bi bi-cart3 me-2"></i>سبد خرید</h2>

    @if($cartItems->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-cart-x fs-1 text-muted"></i>
            <p class="text-muted mt-3 fs-5">سبد خرید شما خالی است.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">
                <i class="bi bi-bag-heart me-2"></i>مشاهده محصولات
            </a>
        </div>
    @else
        <div class="row g-4">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <table class="table table-borderless mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3 px-4">محصول</th>
                                    <th class="py-3 text-center">قیمت واحد</th>
                                    <th class="py-3 text-center">تعداد</th>
                                    <th class="py-3 text-center">جمع</th>
                                    <th class="py-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr class="border-top">
                                        <td class="py-3 px-4">
                                            <div class="d-flex align-items-center gap-3">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                                         style="width:60px;height:60px;object-fit:cover"
                                                         class="rounded" alt="{{ $item->product->name }}">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                         style="width:60px;height:60px">
                                                        <i class="bi bi-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <a href="{{ route('products.show', $item->product->slug) }}"
                                                       class="text-dark text-decoration-none fw-semibold">
                                                        {{ $item->product->name }}
                                                    </a>
                                                    <br>
                                                    <small class="text-muted">{{ $item->product->category->name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 text-center align-middle">
                                            {{ number_format($item->product->effective_price) }} تومان
                                        </td>
                                        <td class="py-3 text-center align-middle">
                                            <form action="{{ route('cart.update', $item) }}" method="POST"
                                                  class="d-flex justify-content-center">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity"
                                                       value="{{ $item->quantity }}"
                                                       min="1" max="{{ $item->product->stock }}"
                                                       class="form-control form-control-sm text-center"
                                                       style="width:70px"
                                                       onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="py-3 text-center align-middle fw-semibold">
                                            {{ number_format($item->subtotal) }} تومان
                                        </td>
                                        <td class="py-3 text-center align-middle">
                                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('حذف شود؟')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-dark text-white fw-semibold">
                        خلاصه سفارش
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>جمع کل:</span>
                            <span class="fw-bold text-primary fs-5">{{ number_format($total) }} تومان</span>
                        </div>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">
                                <i class="bi bi-credit-card me-2"></i>ادامه و پرداخت
                            </a>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-right me-2"></i>ادامه خرید
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
