@extends('layouts.admin')

@section('title', 'ویرایش دسته‌بندی')
@section('page-title', 'ویرایش: ' . $category->name)

@section('content')
    <div class="card border-0 shadow-sm" style="max-width:600px">
        <div class="card-body p-4">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">نام دسته‌بندی <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $category->name) }}" required autofocus>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">توضیحات</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">تصویر</label>
                    @if($category->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $category->image) }}"
                                 class="img-fluid rounded" style="max-height:120px" alt="{{ $category->name }}">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                           accept="image/*">
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active"
                               name="is_active" value="1"
                               {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">فعال</label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning px-4">
                        <i class="bi bi-check-lg me-2"></i>به‌روزرسانی
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                        انصراف
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
