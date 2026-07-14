<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>كل الحجوزات</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">

    <h2>كل الحجوزات في النظام</h2>

    <table class="styled-table">
        <thead>
            <tr>
                <th>المريض</th><th>الدكتور</th><th>التاريخ</th><th>رقم الدور</th><th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appt)
            <tr class="status-{{ $appt->status }}">
                <td>{{ $appt->patient->name }}</td>
                <td>{{ $appt->doctor->name }}</td>
                <td>{{ $appt->appointment_date }}</td>
                <td>{{ $appt->queue_number }}</td>
                <td>
                    @if ($appt->status === 'waiting') في الانتظار
                    @elseif ($appt->status === 'in_progress') جاري الكشف
                    @elseif ($appt->status === 'done') تم
                    @else ملغي
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.dashboard') }}">رجوع</a>

</div>
</body>
</html>
