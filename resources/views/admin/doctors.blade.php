<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة الدكاترة</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">

    <h2>إدارة الدكاترة</h2>

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
            <tr>
                <th>الاسم</th><th>الإيميل</th><th>التخصص</th><th>الهاتف</th><th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
            <tr>
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->email }}</td>
                <td>{{ $doctor->specialization }}</td>
                <td>{{ $doctor->phone }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.doctors.delete', $doctor->id) }}"
                          onsubmit="return confirm('متأكد من حذف الدكتور ده؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>إضافة دكتور جديد</h3>
    <form method="POST" action="{{ route('admin.doctors.store') }}" class="form-box">
        @csrf

        <label>الاسم:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>الإيميل:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>كلمة السر:</label>
        <input type="password" name="password" required>

        <label>التخصص:</label>
        <input type="text" name="specialization" value="{{ old('specialization') }}" required>

        <label>الهاتف:</label>
        <input type="text" name="phone" value="{{ old('phone') }}">

        <label>نبذة (اختياري):</label>
        <textarea name="bio" rows="2"></textarea>

        <button type="submit" class="btn btn-primary">إضافة الدكتور</button>
    </form>

    <a href="{{ route('admin.dashboard') }}">رجوع</a>

</div>
</body>
</html>
