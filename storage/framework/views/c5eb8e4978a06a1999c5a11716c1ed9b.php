<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الكشف</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="container">

    <h2>تسجيل كشف المريض: <?php echo e($appointment->patient->name); ?></h2>
    <p>رقم الدور: <?php echo e($appointment->queue_number); ?> — تاريخ الزيارة: <?php echo e($appointment->appointment_date); ?></p>

    <?php if($errors->any()): ?>
        <div class="alert alert-error">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('doctor.complete', $appointment->id)); ?>" class="form-box">
        <?php echo csrf_field(); ?>

        <label>التشخيص:</label>
        <textarea name="diagnosis" rows="3" required></textarea>

        <label>الروشتة:</label>
        <textarea name="prescription" rows="3"></textarea>

        <label>ملاحظات إضافية:</label>
        <textarea name="notes" rows="2"></textarea>

        <button type="submit" class="btn btn-primary">حفظ وإقفال الزيارة</button>
    </form>

    <a href="<?php echo e(route('doctor.dashboard')); ?>">رجوع للطابور</a>

</div>
</body>
</html>
<?php /**PATH C:\Users\basel\OneDrive\Desktop\1NTI\finalproject\New folder\clinic-system\resources\views/doctor/complete.blade.php ENDPATH**/ ?>