# phpcommerce
PHP Commerce - فروشگاه اینترنتی با Laravel و Bootstrap

## درباره پروژه

یک پلتفرم فروشگاه اینترنتی کامل ساخته شده با **Laravel 11** و **Bootstrap 5 RTL**.

### ویژگی‌ها

**فروشگاه (Frontend)**
- صفحه اصلی با محصولات ویژه و دسته‌بندی‌ها
- مرور محصولات با فیلتر دسته‌بندی، جستجو و مرتب‌سازی
- صفحه جزئیات محصول با محصولات مرتبط
- سبد خرید (افزودن، ویرایش تعداد، حذف)
- فرآیند تکمیل خرید با اطلاعات ارسال
- صفحه سفارش‌های کاربر
- ثبت‌نام و ورود کاربر

**پنل مدیریت (Admin)**
- داشبورد با آمار کلی (محصولات، سفارش‌ها، درآمد)
- مدیریت محصولات (CRUD + آپلود تصویر)
- مدیریت دسته‌بندی‌ها
- مدیریت سفارش‌ها و تغییر وضعیت

### پشته فناوری

- **Backend:** Laravel 11 (PHP 8.2+)
- **Frontend:** Bootstrap 5.3 RTL + Bootstrap Icons
- **Database:** SQLite (پیش‌فرض) یا MySQL/PostgreSQL
- **Authentication:** Laravel built-in auth

---

## نصب و راه‌اندازی

### پیش‌نیازها

- PHP >= 8.2
- Composer
- Node.js & npm (اختیاری برای assets)

### مراحل نصب

```bash
# ۱. کلون کردن پروژه
git clone https://github.com/sajjadrap1-coder/phpcommerce.git
cd phpcommerce

# ۲. نصب وابستگی‌های PHP
composer install

# ۳. کپی فایل محیط
cp .env.example .env

# ۴. ساخت کلید اپلیکیشن
php artisan key:generate

# ۵. پیکربندی دیتابیس در .env
# DB_CONNECTION=sqlite  (برای SQLite)
# یا تنظیمات MySQL

# ۶. ایجاد دیتابیس SQLite (اگر از SQLite استفاده می‌کنید)
touch database/database.sqlite

# ۷. اجرای مایگریشن‌ها
php artisan migrate

# ۸. ایجاد لینک storage
php artisan storage:link

# ۹. اجرای seeder (داده‌های نمونه)
php artisan db:seed

# ۱۰. اجرای سرور توسعه
php artisan serve
```

سپس به آدرس `http://localhost:8000` مراجعه کنید.

### حساب‌های پیش‌فرض (پس از seeder)

| نقش | ایمیل | رمز عبور |
|-----|-------|----------|
| مدیر | admin@phpcommerce.ir | password |
| کاربر | customer@phpcommerce.ir | password |

> ⚠️ رمز عبور پیش‌فرض را پس از نصب تغییر دهید!

---

## ساختار پروژه

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          ← کنترلرهای پنل مدیریت
│   │   ├── Auth/           ← کنترلرهای احراز هویت
│   │   ├── CartController.php
│   │   ├── CheckoutController.php
│   │   ├── HomeController.php
│   │   ├── OrderController.php
│   │   └── ProductController.php
│   └── Middleware/
│       └── AdminMiddleware.php
└── Models/
    ├── Category.php
    ├── CartItem.php
    ├── Order.php
    ├── OrderItem.php
    ├── Product.php
    └── User.php

database/
├── migrations/             ← مایگریشن‌های دیتابیس
└── seeders/                ← داده‌های نمونه

resources/views/
├── layouts/
│   ├── app.blade.php       ← لایوت اصلی با Bootstrap RTL
│   └── admin.blade.php     ← لایوت پنل مدیریت
├── home/
├── products/
├── cart/
├── checkout/
├── orders/
├── auth/
└── admin/
```

## مسیرها (Routes)

| مسیر | توضیح |
|------|-------|
| `/` | صفحه اصلی |
| `/products` | لیست محصولات |
| `/products/{slug}` | جزئیات محصول |
| `/login` | ورود |
| `/register` | ثبت‌نام |
| `/cart` | سبد خرید |
| `/checkout` | تکمیل خرید |
| `/orders` | سفارش‌های من |
| `/admin` | پنل مدیریت |
| `/admin/products` | مدیریت محصولات |
| `/admin/categories` | مدیریت دسته‌بندی‌ها |
| `/admin/orders` | مدیریت سفارش‌ها |

## لایسنس

MIT
