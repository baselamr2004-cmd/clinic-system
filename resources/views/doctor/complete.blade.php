<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الكشف</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">

    <h2>تسجيل كشف المريض: {{ $appointment->patient->name }}</h2>
    <p>رقم الدور: {{ $appointment->queue_number }} — تاريخ الزيارة: {{ $appointment->appointment_date }}</p>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('doctor.complete', $appointment->id) }}" class="form-box">
        @csrf

        <label>التشخيص:</label>
        <textarea name="diagnosis" rows="3" required></textarea>

        <label>الروشتة:</label>
        <textarea name="prescription" rows="3"></textarea>

        <label>ملاحظات إضافية:</label>
        <textarea name="notes" rows="2"></textarea>

        <button type="submit" class="btn btn-primary">حفظ وإقفال الزيارة</button>
    </form>

    <a href="{{ route('doctor.dashboard') }}">رجوع للطابور</a>

</div>
</body>
</html>
