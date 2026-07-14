<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>حجز ميعاد</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container" style="max-width:500px;">

    <h2>حجز ميعاد مع د. {{ $doctor->name }}</h2>
    <p>التخصص: {{ $doctor->specialization }}</p>

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('patient.book.submit', $doctor->id) }}" class="form-box">
        @csrf
        <label>اختر اليوم:</label>
        <input type="date" name="appointment_date" required>
        <button type="submit" class="btn btn-primary">تأكيد الحجز</button>
    </form>

    <a href="{{ route('patient.dashboard') }}">رجوع</a>

</div>
</body>
</html>
