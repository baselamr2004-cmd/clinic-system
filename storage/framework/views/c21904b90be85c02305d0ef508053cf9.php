<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="container" style="max-width:450px;">

    <h2>تسجيل الدخول</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-error">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login.submit')); ?>" class="form-box">
        <?php echo csrf_field(); ?>

        <label>نوع المستخدم:</label>
        <select name="role" required>
            <option value="patient">مريض</option>
            <option value="doctor">دكتور</option>
            <option value="admin">أدمن</option>
        </select>

        <label>البريد الإلكتروني:</label>
        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required>

        <label>كلمة السر:</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn btn-primary">دخول</button>
    </form>

    <p>لسه معندكش حساب؟ <a href="<?php echo e(route('patient.register')); ?>">سجّل كمريض</a></p>

</div>
</body>
</html>
<?php /**PATH C:\Users\basel\OneDrive\Desktop\1NTI\finalproject\New folder\clinic-system\resources\views/auth/login.blade.php ENDPATH**/ ?>