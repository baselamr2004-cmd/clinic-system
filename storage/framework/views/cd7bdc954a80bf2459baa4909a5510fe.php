<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>شاشة الطابور - د. <?php echo e($doctor->name); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="container">

    <h1 class="queue-title">د. <?php echo e($doctor->name); ?> — <?php echo e($doctor->specialization); ?></h1>

    <table class="styled-table" id="queue-table">
        <thead>
            <tr><th>رقم الدور</th><th>المريض</th><th>الحالة</th></tr>
        </thead>
        <tbody id="queue-body">
            <tr><td colspan="3">جاري تحميل الطابور...</td></tr>
        </tbody>
    </table>

</div>

<script>
    const doctorId = <?php echo e($doctor->id); ?>;

    function statusLabel(status) {
        const labels = { waiting: 'في الانتظار', in_progress: 'جاري الكشف', done: 'تم' };
        return labels[status] || status;
    }

    async function loadQueue() {
        try {
            const res = await fetch(`/api/queue/${doctorId}`);
            const data = await res.json();
            const tbody = document.getElementById('queue-body');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="3">مفيش حجوزات النهارده</td></tr>';
                return;
            }

            data.forEach(item => {
                const row = document.createElement('tr');
                row.className = 'status-' + item.status;
                row.innerHTML = `<td>${item.queue_number}</td><td>${item.patient.name}</td><td>${statusLabel(item.status)}</td>`;
                tbody.appendChild(row);
            });
        } catch (e) {
            console.error('تعذر تحميل الطابور', e);
        }
    }

    loadQueue();
    setInterval(loadQueue, 5000); // تحديث تلقائي كل 5 ثواني عن طريق AJAX polling
</script>

</body>
</html>
<?php /**PATH C:\Users\basel\OneDrive\Desktop\1NTI\finalproject\New folder\clinic-system\resources\views/queue-display.blade.php ENDPATH**/ ?>