@extends('layouts.app')

@section('title', 'سفارش‌های من')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="bi bi-box-seam me-2"></i>سفارش‌های من</h2>

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <p class="text-muted mt-3 fs-5">هنوز سفارشی ثبت نکرده‌اید.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">
                <i class="bi bi-bag-heart me-2"></i>شروع خرید
            </a>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="py-3 px-4">شماره سفارش</th>
                            <th class="py-3">تاریخ</th>
                            <th class="py-3">مبلغ کل</th>
                            <th class="py-3">وضعیت</th>
                            <th class="py-3">جزئیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="py-3 px-4 fw-semibold">{{ $order->order_number }}</td>
                                <td class="py-3">{{ $order->created_at->format('Y/m/d') }}</td>
                                <td class="py-3 fw-semibold text-primary">
                                    {{ number_format($order->total_amount) }} تومان
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-{{ $order->status_badge_class }}">
                                        {{ $order->status_label }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <a href="{{ route('orders.show', $order) }}"
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye me-1"></i>مشاهده
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
