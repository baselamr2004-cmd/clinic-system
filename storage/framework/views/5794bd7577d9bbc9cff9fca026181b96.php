<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>جدول مواعيدي</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="container">

    <h2>جدول مواعيدي المتاحة</h2>

    <?php if(session('success')): ?>
        <p class="alert alert-success"><?php echo e(session('success')); ?></p>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-error">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <table class="styled-table">
        <thead>
            <tr><th>اليوم</th><th>من</th><th>إلى</th></tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($s->day_of_week); ?></td>
                <td><?php echo e($s->start_time); ?></td>
                <td><?php echo e($s->end_time); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="3">لسه مفيش مواعيد مضافة</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h3>إضافة ميعاد جديد</h3>
    <form method="POST" action="<?php echo e(route('doctor.schedule.store')); ?>" class="form-box">
        <?php echo csrf_field(); ?>

        <label>اليوم:</label>
        <select name="day_of_week" required>
            <option value="Saturday">السبت</option>
            <option value="Sunday">الأحد</option>
            <option value="Monday">الاثنين</option>
            <option value="Tuesday">الثلاثاء</option>
            <option value="Wednesday">الأربعاء</option>
            <option value="Thursday">الخميس</option>
            <option value="Friday">الجمعة</option>
        </select>

        <label>من الساعة:</label>
        <input type="time" name="start_time" required>

        <label>إلى الساعة:</label>
        <input type="time" name="end_time" required>

        <button type="submit" class="btn btn-primary">إضافة</button>
    </form>

    <a href="<?php echo e(route('doctor.dashboard')); ?>">رجوع</a>

</div>
</body>
</html>
<?php /**PATH C:\Users\basel\OneDrive\Desktop\1NTI\finalproject\New folder\clinic-system\resources\views/doctor/schedule.blade.php ENDPATH**/ ?>