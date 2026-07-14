<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>طابور اليوم - د. {{ $doctor->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">

    <div class="topbar">
        <h2>مرحبًا د. {{ $doctor->name }}</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="hidden" name="guard" value="doctor">
            <button type="submit" class="btn btn-secondary">تسجيل خروج</button>
        </form>
    </div>

    <nav class="nav-links">
        <a href="{{ route('doctor.schedule') }}">جدول مواعيدي</a>
        <a href="{{ route('queue.display', $doctor->id) }}" target="_blank">شاشة الطابور العامة</a>
    </nav>

    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    <h3>طابور اليوم ({{ now()->toDateString() }})</h3>

    <table class="styled-table">
        <thead>
            <tr>
                <th>رقم الدور</th>
                <th>اسم المريض</th>
                <th>الحالة</th>
                <th>إجراء</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($appointments as $appt)
            <tr class="status-{{ $appt->status }}">
                <td>{{ $appt->queue_number }}</td>
                <td>{{ $appt->patient->name }}</td>
                <td>
                    @if ($appt->status === 'waiting') في الانتظار
                    @elseif ($appt->status === 'in_progress') جاري الكشف
                    @elseif ($appt->status === 'done') تم
                    @endif
                </td>
                <td>
                    @if ($appt->status === 'waiting')
                        <form method="POST" action="{{ route('doctor.call', $appt->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">نداء المريض</button>
                        </form>
                    @elseif ($appt->status === 'in_progress')
                        <a href="{{ route('doctor.complete.form', $appt->id) }}" class="btn btn-primary">تسجيل الكشف</a>
                    @else
                        —
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="4">مفيش حجوزات النهارده</td></tr>
            @endforelse
        </tbody>
    </table>

</div>
</body>
</html>
