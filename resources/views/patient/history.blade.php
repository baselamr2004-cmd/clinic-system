<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تاريخي الطبي</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">

    <h2>تاريخي الطبي</h2>

    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    <table class="styled-table">
        <thead>
            <tr>
                <th>الدكتور</th>
                <th>التاريخ</th>
                <th>رقم الدور</th>
                <th>الحالة</th>
                <th>التشخيص</th>
                <th>الروشتة</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($appointments as $appt)
            <tr class="status-{{ $appt->status }}">
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
                <td>{{ $appt->medicalRecord->diagnosis ?? '-' }}</td>
                <td>{{ $appt->medicalRecord->prescription ?? '-' }}</td>
                <td>
                    @if ($appt->status === 'waiting')
                    <form method="POST" action="{{ route('patient.cancel', $appt->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">إلغاء</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="7">مفيش حجوزات لسه</td></tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('patient.dashboard') }}">رجوع</a>

</div>
</body>
</html>
