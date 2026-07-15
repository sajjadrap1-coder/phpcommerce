@extends('layouts.admin')

@section('title', 'مدیریت محصولات')
@section('page-title', 'محصولات')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span class="text-muted">{{ $products->total() }} محصول</span>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>افزودن محصول
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="py-3">تصویر</th>
                        <th class="py-3">نام محصول</th>
                        <th class="py-3">دسته‌بندی</th>
                        <th class="py-3">قیمت</th>
                        <th class="py-3">موجودی</th>
                        <th class="py-3">وضعیت</th>
                        <th class="py-3">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="px-4 py-3">{{ $product->id }}</td>
                            <td class="py-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         width="50" height="50"
                                         class="rounded object-fit-cover" alt="{{ $product->name }}">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                         style="width:50px;height:50px">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold">{{ $product->name }}</span>
                                @if($product->is_featured)
                                    <span class="badge bg-warning text-dark ms-1">ویژه</span>
                                @endif
                            </td>
                            <td class="py-3">{{ $product->category->name }}</td>
                            <td class="py-3">
                                @if($product->isOnSale())
                                    <span class="text-decoration-line-through text-muted small">
                                        {{ number_format($product->price) }}
                                    </span>
                                    <br>
                                    <span class="text-danger fw-semibold">{{ number_format($product->sale_price) }} ت</span>
                                @else
                                    {{ number_format($product->price) }} ت
                                @endif
                            </td>
                            <td class="py-3">
                                <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">
                                    {{ $product->is_active ? 'فعال' : 'غیرفعال' }}
                                </span>
                            </td>
                            <td class="py-3">
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('آیا مطمئن هستید؟')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                هنوز محصولی اضافه نشده.
                                <a href="{{ route('admin.products.create') }}">اولین محصول را اضافه کنید.</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection
