<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>جدول مواعيدي</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">

    <h2>جدول مواعيدي المتاحة</h2>

    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="styled-table">
        <thead>
            <tr><th>اليوم</th><th>من</th><th>إلى</th></tr>
        </thead>
        <tbody>
            @forelse ($schedules as $s)
            <tr>
                <td>{{ $s->day_of_week }}</td>
                <td>{{ $s->start_time }}</td>
                <td>{{ $s->end_time }}</td>
            </tr>
            @empty
            <tr><td colspan="3">لسه مفيش مواعيد مضافة</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>إضافة ميعاد جديد</h3>
    <form method="POST" action="{{ route('doctor.schedule.store') }}" class="form-box">
        @csrf

        <label>اليوم:</label>
        <select name="day_of_week" required>
            <option value="Saturday">السبت</option>
            <option value="Sunday">الأحد</option>
            <option value="Monday">الاثنين</option>
            <option value="Tuesday">الثلاثاء</option>
            <option value="Wednesday">الأربعاء</option>
            <option value="Thursday">الخميس</option>
            <option value="Friday">الجمعة</option>
        </select>

        <label>من الساعة:</label>
        <input type="time" name="start_time" required>

        <label>إلى الساعة:</label>
        <input type="time" name="end_time" required>

        <button type="submit" class="btn btn-primary">إضافة</button>
    </form>

    <a href="{{ route('doctor.dashboard') }}">رجوع</a>

</div>
</body>
</html>
