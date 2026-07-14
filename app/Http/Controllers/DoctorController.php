<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    // طابور اليوم بترتيب queue_number
    public function dashboard()
    {
        $doctor = Auth::guard('doctor')->user();

        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', now()->toDateString())
            ->where('status', '!=', 'cancelled')
            ->with('patient')
            ->orderBy('queue_number')
            ->get();

        return view('doctor.dashboard', compact('appointments', 'doctor'));
    }

    // نداء المريض التالي (waiting -> in_progress)
    public function callNext(Appointment $appointment)
    {
        $this->authorizeDoctor($appointment);
        $appointment->update(['status' => 'in_progress']);
        return back()->with('success', "تم نداء المريض رقم {$appointment->queue_number}");
    }

    // فورم كتابة التشخيص والروشتة
    public function showCompleteForm(Appointment $appointment)
    {
        $this->authorizeDoctor($appointment);
        return view('doctor.complete', compact('appointment'));
    }

    // حفظ التشخيص وإقفال الزيارة (in_progress -> done)
    public function completeAppointment(Request $request, Appointment $appointment)
    {
        $this->authorizeDoctor($appointment);

        $request->validate([
            'diagnosis' => 'required|string',
            'prescription' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $appointment->medicalRecord()->create($request->only('diagnosis', 'prescription', 'notes'));
        $appointment->update(['status' => 'done']);

        return redirect()->route('doctor.dashboard')->with('success', 'تم تسجيل الكشف بنجاح');
    }

    // عرض جدول مواعيد الدكتور المتاحة
    public function schedule()
    {
        $doctor = Auth::guard('doctor')->user();
        $schedules = Schedule::where('doctor_id', $doctor->id)->get();
        return view('doctor.schedule', compact('schedules'));
    }

    // إضافة ميعاد جديد للجدول
    public function storeSchedule(Request $request)
    {
        $doctor = Auth::guard('doctor')->user();

        $request->validate([
            'day_of_week' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        Schedule::create([
            'doctor_id' => $doctor->id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return back()->with('success', 'تمت إضافة الميعاد');
    }

    // حماية: التأكد إن الحجز ده فعلاً بتاع الدكتور المسجل دخوله
    private function authorizeDoctor(Appointment $appointment)
    {
        $doctor = Auth::guard('doctor')->user();
        if ($appointment->doctor_id !== $doctor->id) {
            abort(403);
        }
    }
}
