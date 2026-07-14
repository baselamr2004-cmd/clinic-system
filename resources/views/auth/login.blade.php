<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container" style="max-width:450px;">

    <h2>تسجيل الدخول</h2>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}" class="form-box">
        @csrf

        <label>نوع المستخدم:</label>
        <select name="role" required>
            <option value="patient">مريض</option>
            <option value="doctor">دكتور</option>
            <option value="admin">أدمن</option>
        </select>

        <label>البريد الإلكتروني:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>كلمة السر:</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn btn-primary">دخول</button>
    </form>

    <p>لسه معندكش حساب؟ <a href="{{ route('patient.register') }}">سجّل كمريض</a></p>

</div>
</body>
</html>
