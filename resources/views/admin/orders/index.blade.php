@extends('layouts.admin')

@section('title', 'مدیریت سفارش‌ها')
@section('page-title', 'سفارش‌ها')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="px-4 py-3">شماره سفارش</th>
                        <th class="py-3">مشتری</th>
                        <th class="py-3">مبلغ</th>
                        <th class="py-3">وضعیت</th>
                        <th class="py-3">تاریخ</th>
                        <th class="py-3">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="px-4 py-3 fw-semibold">{{ $order->order_number }}</td>
                            <td class="py-3">
                                <span>{{ $order->user->name }}</span>
                                <small class="text-muted d-block">{{ $order->user->email }}</small>
                            </td>
                            <td class="py-3 fw-semibold">{{ number_format($order->total_amount) }} تومان</td>
                            <td class="py-3">
                                <span class="badge bg-{{ $order->status_badge_class }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="py-3">{{ $order->created_at->format('Y/m/d H:i') }}</td>
                            <td class="py-3">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i>جزئیات
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">هنوز سفارشی ثبت نشده</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection
