<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل مريض جديد</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="container" style="max-width:450px;">

    <h2>تسجيل حساب مريض جديد</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-error">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('patient.register.submit')); ?>" class="form-box">
        <?php echo csrf_field(); ?>

        <label>الاسم:</label>
        <input type="text" name="name" value="<?php echo e(old('name')); ?>" required>

        <label>البريد الإلكتروني:</label>
        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required>

        <label>كلمة السر:</label>
        <input type="password" name="password" required>

        <label>تأكيد كلمة السر:</label>
        <input type="password" name="password_confirmation" required>

        <label>رقم الهاتف:</label>
        <input type="text" name="phone" value="<?php echo e(old('phone')); ?>">

        <label>تاريخ الميلاد:</label>
        <input type="date" name="birth_date" value="<?php echo e(old('birth_date')); ?>">

        <label>النوع:</label>
        <select name="gender">
            <option value="male">ذكر</option>
            <option value="female">أنثى</option>
        </select>

        <button type="submit" class="btn btn-primary">تسجيل</button>
    </form>

    <p>عندك حساب؟ <a href="<?php echo e(route('login')); ?>">تسجيل الدخول</a></p>

</div>
</body>
</html>
<?php /**PATH C:\Users\basel\OneDrive\Desktop\1NTI\finalproject\New folder\clinic-system\resources\views/auth/patient-register.blade.php ENDPATH**/ ?>