@extends('layouts.admin')

@section('title', 'مدیریت دسته‌بندی‌ها')
@section('page-title', 'دسته‌بندی‌ها')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span class="text-muted">{{ $categories->total() }} دسته‌بندی</span>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>افزودن دسته‌بندی
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="py-3">نام</th>
                        <th class="py-3">اسلاگ</th>
                        <th class="py-3">تعداد محصولات</th>
                        <th class="py-3">وضعیت</th>
                        <th class="py-3">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="px-4 py-3">{{ $category->id }}</td>
                            <td class="py-3 fw-semibold">{{ $category->name }}</td>
                            <td class="py-3"><code>{{ $category->slug }}</code></td>
                            <td class="py-3">{{ $category->products_count }}</td>
                            <td class="py-3">
                                <span class="badge bg-{{ $category->is_active ? 'success' : 'secondary' }}">
                                    {{ $category->is_active ? 'فعال' : 'غیرفعال' }}
                                </span>
                            </td>
                            <td class="py-3">
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
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
                            <td colspan="6" class="text-center py-5 text-muted">
                                هنوز دسته‌بندی اضافه نشده.
                                <a href="{{ route('admin.categories.create') }}">اولین دسته‌بندی را اضافه کنید.</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
@endsection
