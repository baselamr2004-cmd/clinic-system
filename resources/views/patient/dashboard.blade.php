<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الرئيسية - المريض</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">

    <div class="topbar">
        <h2>مرحبًا بك</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="hidden" name="guard" value="patient">
            <button type="submit" class="btn btn-secondary">تسجيل خروج</button>
        </form>
    </div>

    <nav class="nav-links">
        <a href="{{ route('patient.history') }}">تاريخي الطبي</a>
    </nav>

    <h3>الدكاترة المتاحين</h3>
    <table class="styled-table">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>التخصص</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
            <tr>
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->specialization }}</td>
                <td><a href="{{ route('patient.book', $doctor->id) }}" class="btn btn-primary">احجز ميعاد</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
</body>
</html>
