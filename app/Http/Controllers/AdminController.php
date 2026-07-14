<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // إحصائيات سريعة
    public function dashboard()
    {
        $stats = [
            'total_patients' => Patient::count(),
            'total_doctors' => Doctor::count(),
            'today_appointments' => Appointment::whereDate('appointment_date', now()->toDateString())->count(),
            'busiest_doctor' => Appointment::selectRaw('doctor_id, COUNT(*) as total')
                ->groupBy('doctor_id')
                ->orderByDesc('total')
                ->with('doctor')
                ->first(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // عرض كل الدكاترة + فورم إضافة
    public function doctors()
    {
        $doctors = Doctor::all();
        return view('admin.doctors', compact('doctors'));
    }

    // إضافة دكتور جديد
    public function storeDoctor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|min:6',
            'phone' => 'nullable|string|max:20',
            'specialization' => 'required|string|max:100',
            'bio' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        Doctor::create($validated);

        return back()->with('success', 'تمت إضافة الدكتور بنجاح');
    }

    // حذف دكتور
    public function deleteDoctor(Doctor $doctor)
    {
        $doctor->delete();
        return back()->with('success', 'تم حذف الدكتور');
    }

    // عرض كل الحجوزات في النظام
    public function appointments()
    {
        $appointments = Appointment::with(['patient', 'doctor'])
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('admin.appointments', compact('appointments'));
    }
}
