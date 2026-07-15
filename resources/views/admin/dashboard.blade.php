@extends('layouts.admin')

@section('title', 'داشبورد مدیریت')
@section('page-title', 'داشبورد')

@section('content')
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-box-seam text-primary fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small">محصولات</div>
                        <div class="fw-bold fs-4">{{ number_format($stats['total_products']) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-receipt text-success fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small">سفارش‌ها</div>
                        <div class="fw-bold fs-4">{{ number_format($stats['total_orders']) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-info bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-people text-info fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small">کاربران</div>
                        <div class="fw-bold fs-4">{{ number_format($stats['total_users']) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-cash-stack text-warning fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small">درآمد کل</div>
                        <div class="fw-bold fs-5">{{ number_format($stats['total_revenue']) }} ت</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card border-0 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold">آخرین سفارش‌ها</span>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">مشاهده همه</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
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
                    @forelse($recentOrders as $order)
                        <tr>
                            <td class="px-4 py-3 fw-semibold">{{ $order->order_number }}</td>
                            <td class="py-3">{{ $order->user->name }}</td>
                            <td class="py-3">{{ number_format($order->total_amount) }} تومان</td>
                            <td class="py-3">
                                <span class="badge bg-{{ $order->status_badge_class }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="py-3">{{ $order->created_at->format('Y/m/d') }}</td>
                            <td class="py-3">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">هنوز سفارشی ثبت نشده</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
