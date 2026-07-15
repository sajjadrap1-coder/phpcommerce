@extends('layouts.app')

@section('title', 'جزئیات سفارش ' . $order->order_number)

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">جزئیات سفارش</h2>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-right me-2"></i>بازگشت به سفارش‌ها
        </a>
    </div>

    <div class="row g-4">
        <!-- Order Info -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-dark text-white fw-semibold">اطلاعات سفارش</div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">شماره سفارش:</dt>
                        <dd class="col-sm-7 fw-semibold">{{ $order->order_number }}</dd>

                        <dt class="col-sm-5">تاریخ:</dt>
                        <dd class="col-sm-7">{{ $order->created_at->format('Y/m/d H:i') }}</dd>

                        <dt class="col-sm-5">وضعیت:</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-{{ $order->status_badge_class }}">
                                {{ $order->status_label }}
                            </span>
                        </dd>

                        <dt class="col-sm-5">مبلغ کل:</dt>
                        <dd class="col-sm-7 fw-bold text-primary fs-5">
                            {{ number_format($order->total_amount) }} تومان
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Shipping Info -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-dark text-white fw-semibold">اطلاعات ارسال</div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">نام:</dt>
                        <dd class="col-sm-8">{{ $order->shipping_name }}</dd>

                        <dt class="col-sm-4">ایمیل:</dt>
                        <dd class="col-sm-8">{{ $order->shipping_email }}</dd>

                        <dt class="col-sm-4">تلفن:</dt>
                        <dd class="col-sm-8">{{ $order->shipping_phone }}</dd>

                        <dt class="col-sm-4">شهر:</dt>
                        <dd class="col-sm-8">{{ $order->shipping_city }}</dd>

                        <dt class="col-sm-4">آدرس:</dt>
                        <dd class="col-sm-8">{{ $order->shipping_address }}</dd>

                        <dt class="col-sm-4">کد پستی:</dt>
                        <dd class="col-sm-8">{{ $order->shipping_postal_code }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Notes -->
        @if($order->notes)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-dark text-white fw-semibold">یادداشت</div>
                    <div class="card-body">
                        <p class="mb-0">{{ $order->notes }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Order Items -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-dark text-white fw-semibold">
            <i class="bi bi-bag me-2"></i>اقلام سفارش
        </div>
        <div class="table-responsive">
            <table class="table table-borderless mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="py-3 px-4">محصول</th>
                        <th class="py-3 text-center">قیمت واحد</th>
                        <th class="py-3 text-center">تعداد</th>
                        <th class="py-3 text-center">جمع</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-top">
                            <td class="py-3 px-4 fw-semibold">{{ $item->product_name }}</td>
                            <td class="py-3 text-center">{{ number_format($item->unit_price) }} تومان</td>
                            <td class="py-3 text-center">{{ $item->quantity }}</td>
                            <td class="py-3 text-center fw-semibold text-primary">
                                {{ number_format($item->total_price) }} تومان
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="3" class="py-3 px-4 fw-bold fs-5">مجموع:</td>
                        <td class="py-3 text-center fw-bold text-primary fs-5">
                            {{ number_format($order->total_amount) }} تومان
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
