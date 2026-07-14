<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل مريض جديد</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container" style="max-width:450px;">

    <h2>تسجيل حساب مريض جديد</h2>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('patient.register.submit') }}" class="form-box">
        @csrf

        <label>الاسم:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>البريد الإلكتروني:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>كلمة السر:</label>
        <input type="password" name="password" required>

        <label>تأكيد كلمة السر:</label>
        <input type="password" name="password_confirmation" required>

        <label>رقم الهاتف:</label>
        <input type="text" name="phone" value="{{ old('phone') }}">

        <label>تاريخ الميلاد:</label>
        <input type="date" name="birth_date" value="{{ old('birth_date') }}">

        <label>النوع:</label>
        <select name="gender">
            <option value="male">ذكر</option>
            <option value="female">أنثى</option>
        </select>

        <button type="submit" class="btn btn-primary">تسجيل</button>
    </form>

    <p>عندك حساب؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>

</div>
</body>
</html>
