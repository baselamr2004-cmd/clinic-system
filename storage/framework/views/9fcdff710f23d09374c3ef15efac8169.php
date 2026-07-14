<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الرئيسية - المريض</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="container">

    <div class="topbar">
        <h2>مرحبًا بك</h2>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="guard" value="patient">
            <button type="submit" class="btn btn-secondary">تسجيل خروج</button>
        </form>
    </div>

    <nav class="nav-links">
        <a href="<?php echo e(route('patient.history')); ?>">تاريخي الطبي</a>
    </nav>

    <h3>الدكاترة المتاحين</h3>
    <table class="styled-table">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>التخصص</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($doctor->name); ?></td>
                <td><?php echo e($doctor->specialization); ?></td>
                <td><a href="<?php echo e(route('patient.book', $doctor->id)); ?>" class="btn btn-primary">احجز ميعاد</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>
</body>
</html>
<?php /**PATH C:\Users\basel\OneDrive\Desktop\1NTI\finalproject\New folder\clinic-system\resources\views/patient/dashboard.blade.php ENDPATH**/ ?>