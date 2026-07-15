<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>طابور اليوم - د. <?php echo e($doctor->name); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="container">

    <div class="topbar">
        <h2>مرحبًا د. <?php echo e($doctor->name); ?></h2>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="guard" value="doctor">
            <button type="submit" class="btn btn-secondary">تسجيل خروج</button>
        </form>
    </div>

    <nav class="nav-links">
        <a href="<?php echo e(route('doctor.schedule')); ?>">جدول مواعيدي</a>
        <a href="<?php echo e(route('queue.display', $doctor->id)); ?>" target="_blank">شاشة الطابور العامة</a>
    </nav>

    <?php if(session('success')): ?>
        <p class="alert alert-success"><?php echo e(session('success')); ?></p>
    <?php endif; ?>

    <h3>طابور اليوم (<?php echo e(now()->toDateString()); ?>)</h3>

    <table class="styled-table">
        <thead>
            <tr>
                <th>رقم الدور</th>
                <th>اسم المريض</th>
                <th>الحالة</th>
                <th>إجراء</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="status-<?php echo e($appt->status); ?>">
                <td><?php echo e($appt->queue_number); ?></td>
                <td><?php echo e($appt->patient->name); ?></td>
                <td>
                    <?php if($appt->status === 'waiting'): ?> في الانتظار
                    <?php elseif($appt->status === 'in_progress'): ?> جاري الكشف
                    <?php elseif($appt->status === 'done'): ?> تم
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($appt->status === 'waiting'): ?>
                        <form method="POST" action="<?php echo e(route('doctor.call', $appt->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary">نداء المريض</button>
                        </form>
                    <?php elseif($appt->status === 'in_progress'): ?>
                        <a href="<?php echo e(route('doctor.complete.form', $appt->id)); ?>" class="btn btn-primary">تسجيل الكشف</a>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="4">مفيش حجوزات النهارده</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
</body>
</html>
<?php /**PATH C:\Users\basel\OneDrive\Desktop\1NTI\finalproject\New folder\clinic-system\resources\views/doctor/dashboard.blade.php ENDPATH**/ ?>