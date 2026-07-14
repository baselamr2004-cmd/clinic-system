<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم الأدمن</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">

    <div class="topbar">
        <h2>لوحة تحكم الأدمن</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="hidden" name="guard" value="admin">
            <button type="submit" class="btn btn-secondary">تسجيل خروج</button>
        </form>
    </div>

    <nav class="nav-links">
        <a href="{{ route('admin.doctors') }}">إدارة الدكاترة</a>
        <a href="{{ route('admin.appointments') }}">كل الحجوزات</a>
    </nav>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>{{ $stats['total_patients'] }}</h3>
            <p>إجمالي المرضى</p>
        </div>
        <div class="stat-card">
            <h3>{{ $stats['total_doctors'] }}</h3>
            <p>إجمالي الدكاترة</p>
        </div>
        <div class="stat-card">
            <h3>{{ $stats['today_appointments'] }}</h3>
            <p>حجوزات النهارده</p>
        </div>
        <div class="stat-card">
            <h3>{{ $stats['busiest_doctor']->doctor->name ?? '-' }}</h3>
            <p>أكتر دكتور مطلوب</p>
        </div>
    </div>

</div>
</body>
</html>
