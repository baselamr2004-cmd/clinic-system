<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    // صفحة الداشبورد الرئيسية
    public function dashboard()
    {
        $doctors = Doctor::all();
        return view('patient.dashboard', compact('doctors'));
    }

    // عرض صفحة حجز ميعاد مع دكتور معين
    public function showBookingForm(Doctor $doctor)
    {
        return view('patient.book', compact('doctor'));
    }

    // تنفيذ الحجز فعليًا
    public function bookAppointment(Request $request, Doctor $doctor)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
        ]);

        $patient = Auth::guard('patient')->user();

        // حساب رقم الدور: نعد كام حجز موجود بالفعل لنفس الدكتور في نفس اليوم
        $existingCount = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_date', $request->appointment_date)
            ->where('status', '!=', 'cancelled')
            ->count();

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => $request->appointment_date,
            'queue_number' => $existingCount + 1,
            'status' => 'waiting',
        ]);

        return redirect()->route('patient.history')->with('success', 'تم الحجز بنجاح!');
    }

    // صفحة التاريخ الطبي
    public function history()
    {
        $patient = Auth::guard('patient')->user();

        $appointments = Appointment::where('patient_id', $patient->id)
            ->with(['doctor', 'medicalRecord'])
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('patient.history', compact('appointments'));
    }

    // إلغاء حجز
    public function cancelAppointment(Appointment $appointment)
    {
        $patient = Auth::guard('patient')->user();
        $appointment->update(['status' => 'cancelled']);
        return back()->with('success', 'تم إلغاء الحجز');
    }
}
