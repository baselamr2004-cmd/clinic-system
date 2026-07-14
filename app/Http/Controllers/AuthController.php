<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ====================PATIENT REGISTER====================
    public function showPatientRegister()
    {
        return view('auth.patient-register');
    }

    public function patientRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:patients,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $patient = Patient::create($validated);

        Auth::guard('patient')->login($patient);

        return redirect()->route('patient.dashboard');
    }

    // ====================LOGIN====================
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:patient,doctor,admin',
        ]);

        $credentials = $request->only('email', 'password');
        $guard = $request->role;

        if (Auth::guard($guard)->attempt($credentials)) {
            $request->session()->regenerate();

            return match ($guard) {
                'patient' => redirect()->route('patient.dashboard'),
                'doctor' => redirect()->route('doctor.dashboard'),
                'admin' => redirect()->route('admin.dashboard'),
            };
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة'])->withInput();
    }

    // ====================LOGOUT====================
    public function logout(Request $request)
    {
        $guard = $request->input('guard', 'patient');
        Auth::guard($guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}