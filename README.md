# Todo App API

REST API لإدارة المهام والمشاريع (Task & Project Management)، مبني بـ Laravel، مع نظام تسجيل دخول محمي بالتوكنات (Sanctum) وصلاحيات كل مستخدم.

## المميزات

- 🔐 **Authentication** عبر Laravel Sanctum (تسجيل / دخول بتوكن)
- ✅ **Task CRUD** كامل (إنشاء، عرض، تعديل، حذف)
- 📁 **Project CRUD** كامل مع ربط المهام بالمشاريع
- 🔒 **Authorization**: كل مستخدم بيشوف ويتحكم بس بمهامه ومشاريعه
- ✔️ **Validation** شامل على كل المدخلات

## التقنيات المستخدمة

- **Laravel 12** (PHP 8.2)
- **Laravel Sanctum** (API Authentication)
- **SQLite** (قاعدة البيانات)
- **Postman** (لاختبار الـ API)

## طريقة التشغيل محلياً

```bash
# استنساخ المشروع
git clone https://github.com/MoyadS/todo-app.git
cd todo-app

# تثبيت الحزم
composer install

# إعداد ملف البيئة
cp .env.example .env
php artisan key:generate

# إعداد قاعدة البيانات
php artisan migrate

# تشغيل السيرفر
php artisan serve
```

المشروع رح يشتغل على: `http://127.0.0.1:8000`

## نقاط الوصول (API Endpoints)

### Authentication

| Method | Endpoint | الوصف |
|--------|----------|-------|
| POST | `/api/register` | تسجيل مستخدم جديد |
| POST | `/api/login` | تسجيل الدخول |

### Tasks (محمية بالتوكن)

| Method | Endpoint | الوصف |
|--------|----------|-------|
| GET | `/api/tasks` | عرض كل مهام المستخدم الحالي |
| POST | `/api/tasks` | إضافة مهمة جديدة |
| GET | `/api/tasks/{id}` | عرض مهمة محددة |
| PUT | `/api/tasks/{id}` | تعديل مهمة |
| DELETE | `/api/tasks/{id}` | حذف مهمة |

### Projects (محمية بالتوكن)

| Method | Endpoint | الوصف |
|--------|----------|-------|
| GET | `/api/projects` | عرض كل مشاريع المستخدم الحالي |
| POST | `/api/projects` | إضافة مشروع جديد |
| GET | `/api/projects/{id}` | عرض مشروع محدد مع مهامه |
| PUT | `/api/projects/{id}` | تعديل مشروع |
| DELETE | `/api/projects/{id}` | حذف مشروع |

## المصادقة (Authentication)

كل الطلبات على `/api/tasks` و `/api/projects` لازم تتضمن التوكن بالـ Header:
