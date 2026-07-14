<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>حجز ميعاد</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="container" style="max-width:500px;">

    <h2>حجز ميعاد مع د. <?php echo e($doctor->name); ?></h2>
    <p>التخصص: <?php echo e($doctor->specialization); ?></p>

    <?php if($errors->any()): ?>
        <div class="alert alert-error">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('patient.book.submit', $doctor->id)); ?>" class="form-box">
        <?php echo csrf_field(); ?>
        <label>اختر اليوم:</label>
        <input type="date" name="appointment_date" required>
        <button type="submit" class="btn btn-primary">تأكيد الحجز</button>
    </form>

    <a href="<?php echo e(route('patient.dashboard')); ?>">رجوع</a>

</div>
</body>
</html>
<?php /**PATH C:\Users\basel\OneDrive\Desktop\1NTI\finalproject\New folder\clinic-system\resources\views/patient/book.blade.php ENDPATH**/ ?>