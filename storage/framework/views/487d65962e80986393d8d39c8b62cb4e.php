<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تاريخي الطبي</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="container">

    <h2>تاريخي الطبي</h2>

    <?php if(session('success')): ?>
        <p class="alert alert-success"><?php echo e(session('success')); ?></p>
    <?php endif; ?>

    <table class="styled-table">
        <thead>
            <tr>
                <th>الدكتور</th>
                <th>التاريخ</th>
                <th>رقم الدور</th>
                <th>الحالة</th>
                <th>التشخيص</th>
                <th>الروشتة</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="status-<?php echo e($appt->status); ?>">
                <td><?php echo e($appt->doctor->name); ?></td>
                <td><?php echo e($appt->appointment_date); ?></td>
                <td><?php echo e($appt->queue_number); ?></td>
                <td>
                    <?php if($appt->status === 'waiting'): ?> في الانتظار
                    <?php elseif($appt->status === 'in_progress'): ?> جاري الكشف
                    <?php elseif($appt->status === 'done'): ?> تم
                    <?php else: ?> ملغي
                    <?php endif; ?>
                </td>
                <td><?php echo e($appt->medicalRecord->diagnosis ?? '-'); ?></td>
                <td><?php echo e($appt->medicalRecord->prescription ?? '-'); ?></td>
                <td>
                    <?php if($appt->status === 'waiting'): ?>
                    <form method="POST" action="<?php echo e(route('patient.cancel', $appt->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger">إلغاء</button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7">مفيش حجوزات لسه</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="<?php echo e(route('patient.dashboard')); ?>">رجوع</a>

</div>
</body>
</html>
<?php /**PATH C:\Users\basel\OneDrive\Desktop\1NTI\finalproject\New folder\clinic-system\resources\views/patient/history.blade.php ENDPATH**/ ?>