@extends('layouts.admin')

@section('title', 'جزئیات سفارش')
@section('page-title', 'سفارش: ' . $order->order_number)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-right me-2"></i>بازگشت
        </a>
        <!-- Update Status -->
        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-flex gap-2 align-items-center">
            @csrf
            @method('PATCH')
            <select name="status" class="form-select form-select-sm" style="width:180px">
                @foreach(['pending' => 'در انتظار', 'processing' => 'در حال پردازش', 'shipped' => 'ارسال شده', 'delivered' => 'تحویل داده شده', 'cancelled' => 'لغو شده'] as $val => $label)
                    <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-primary">به‌روزرسانی وضعیت</button>
        </form>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header fw-semibold">اطلاعات سفارش</div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-5">شماره:</dt>
                        <dd class="col-7">{{ $order->order_number }}</dd>
                        <dt class="col-5">تاریخ:</dt>
                        <dd class="col-7">{{ $order->created_at->format('Y/m/d H:i') }}</dd>
                        <dt class="col-5">مبلغ:</dt>
                        <dd class="col-7 fw-bold text-primary">{{ number_format($order->total_amount) }} تومان</dd>
                        <dt class="col-5">وضعیت:</dt>
                        <dd class="col-7">
                            <span class="badge bg-{{ $order->status_badge_class }}">{{ $order->status_label }}</span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header fw-semibold">اطلاعات مشتری و ارسال</div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-4">مشتری:</dt>
                        <dd class="col-8">{{ $order->user->name }}</dd>
                        <dt class="col-4">نام ارسال:</dt>
                        <dd class="col-8">{{ $order->shipping_name }}</dd>
                        <dt class="col-4">تلفن:</dt>
                        <dd class="col-8">{{ $order->shipping_phone }}</dd>
                        <dt class="col-4">شهر:</dt>
                        <dd class="col-8">{{ $order->shipping_city }}</dd>
                        <dt class="col-4">آدرس:</dt>
                        <dd class="col-8">{{ $order->shipping_address }}</dd>
                        @if($order->notes)
                            <dt class="col-4">یادداشت:</dt>
                            <dd class="col-8">{{ $order->notes }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header fw-semibold">اقلام سفارش</div>
        <div class="table-responsive">
            <table class="table table-borderless mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">محصول</th>
                        <th class="py-3 text-center">قیمت واحد</th>
                        <th class="py-3 text-center">تعداد</th>
                        <th class="py-3 text-center">جمع</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-top">
                            <td class="px-4 py-3">{{ $item->product_name }}</td>
                            <td class="py-3 text-center">{{ number_format($item->unit_price) }} تومان</td>
                            <td class="py-3 text-center">{{ $item->quantity }}</td>
                            <td class="py-3 text-center fw-semibold">{{ number_format($item->total_price) }} تومان</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="3" class="px-4 py-3 fw-bold">مجموع:</td>
                        <td class="py-3 text-center fw-bold text-primary">{{ number_format($order->total_amount) }} تومان</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
