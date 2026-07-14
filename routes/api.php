<?php

use Illuminate\Support\Facades\Route;
use App\Models\Appointment;
use App\Models\Doctor;

// ============================================================
// هذا الملف بديل كامل لملف routes/api.php الموجود أصلاً في المشروع
// (أو أضف السطر ده فقط لو الملف عنده محتوى قبل كده)
// ============================================================

// GET /api/queue/{doctor} -> يرجع JSON بطابور اليوم لدكتور معين
Route::get('/queue/{doctor}', function (Doctor $doctor) {
    $appointments = Appointment::where('doctor_id', $doctor->id)
        ->whereDate('appointment_date', now()->toDateString())
        ->where('status', '!=', 'cancelled')
        ->with('patient:id,name')
        ->orderBy('queue_number')
        ->get(['id', 'patient_id', 'queue_number', 'status']);

    return response()->json($appointments);
});
