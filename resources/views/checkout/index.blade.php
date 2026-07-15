@extends('layouts.app')

@section('title', 'تکمیل خرید')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>تکمیل خرید</h2>

    <div class="row g-4">
        <!-- Shipping Form -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white fw-semibold">
                    <i class="bi bi-geo-alt me-2"></i>اطلاعات ارسال
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.place') }}" method="POST" id="checkoutForm">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">نام و نام خانوادگی</label>
                                <input type="text" name="shipping_name" class="form-control"
                                       value="{{ old('shipping_name', auth()->user()->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">ایمیل</label>
                                <input type="email" name="shipping_email" class="form-control"
                                       value="{{ old('shipping_email', auth()->user()->email) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">شماره تماس</label>
                                <input type="tel" name="shipping_phone" class="form-control"
                                       value="{{ old('shipping_phone', auth()->user()->phone) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">شهر</label>
                                <input type="text" name="shipping_city" class="form-control"
                                       value="{{ old('shipping_city') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">آدرس کامل</label>
                                <textarea name="shipping_address" class="form-control" rows="3" required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">کد پستی</label>
                                <input type="text" name="shipping_postal_code" class="form-control"
                                       value="{{ old('shipping_postal_code') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">یادداشت (اختیاری)</label>
                                <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white fw-semibold">
                    <i class="bi bi-receipt me-2"></i>خلاصه سفارش
                </div>
                <div class="card-body p-0">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr class="border-bottom">
                                    <td class="py-2 px-3">
                                        <span class="fw-semibold">{{ $item->product->name }}</span>
                                        <small class="text-muted d-block">× {{ $item->quantity }}</small>
                                    </td>
                                    <td class="py-2 px-3 text-end align-middle">
                                        {{ number_format($item->subtotal) }} تومان
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td class="py-3 px-3 fw-bold fs-5">مجموع:</td>
                                <td class="py-3 px-3 text-end fw-bold text-primary fs-5">
                                    {{ number_format($total) }} تومان
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer bg-white border-0 pb-3">
                    <button type="submit" form="checkoutForm" class="btn btn-success btn-lg w-100">
                        <i class="bi bi-check-circle me-2"></i>ثبت سفارش
                    </button>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        <i class="bi bi-arrow-right me-2"></i>بازگشت به سبد خرید
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
