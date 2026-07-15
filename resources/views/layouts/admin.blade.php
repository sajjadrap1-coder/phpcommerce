<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'پنل مدیریت')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #212529;
            position: fixed;
            top: 0;
            right: 0;
            z-index: 1000;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            margin: 2px 0;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #0d6efd;
            color: white;
        }
        .main-content {
            margin-right: 260px;
            padding: 20px;
        }
        .sidebar-brand {
            padding: 1.2rem;
            border-bottom: 1px solid #495057;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-light">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none fw-bold fs-5">
                <i class="bi bi-speedometer2 me-2"></i>پنل مدیریت
            </a>
        </div>
        <nav class="flex-grow-1 p-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house me-2"></i>داشبورد
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam me-2"></i>محصولات
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags me-2"></i>دسته‌بندی‌ها
            </a>
            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-receipt me-2"></i>سفارش‌ها
            </a>
            <hr class="border-secondary">
            <a href="{{ route('home') }}" class="nav-link">
                <i class="bi bi-shop me-2"></i>مشاهده فروشگاه
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link w-100 text-start text-danger bg-transparent border-0">
                    <i class="bi bi-box-arrow-right me-2"></i>خروج
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top bar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">@yield('page-title', 'داشبورد')</h4>
            <span class="text-muted">
                <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
            </span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
