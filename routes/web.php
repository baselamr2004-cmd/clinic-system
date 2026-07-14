<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'showPatientRegister'])->name('patient.register');
Route::post('/register', [AuthController::class, 'patientRegister'])->name('patient.register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:patient')->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/patient/book/{doctor}', [PatientController::class, 'showBookingForm'])->name('patient.book');
    Route::post('/patient/book/{doctor}', [PatientController::class, 'bookAppointment'])->name('patient.book.submit');
    Route::get('/patient/history', [PatientController::class, 'history'])->name('patient.history');
    Route::post('/patient/cancel/{appointment}', [PatientController::class, 'cancelAppointment'])->name('patient.cancel');
});

Route::middleware('auth:doctor')->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::post('/doctor/call/{appointment}', [DoctorController::class, 'callNext'])->name('doctor.call');
    Route::get('/doctor/complete/{appointment}', [DoctorController::class, 'showCompleteForm'])->name('doctor.complete.form');
    Route::post('/doctor/complete/{appointment}', [DoctorController::class, 'completeAppointment'])->name('doctor.complete');
    Route::get('/doctor/schedule', [DoctorController::class, 'schedule'])->name('doctor.schedule');
    Route::post('/doctor/schedule', [DoctorController::class, 'storeSchedule'])->name('doctor.schedule.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/doctors', [AdminController::class, 'doctors'])->name('admin.doctors');
    Route::post('/admin/doctors', [AdminController::class, 'storeDoctor'])->name('admin.doctors.store');
    Route::delete('/admin/doctors/{doctor}', [AdminController::class, 'deleteDoctor'])->name('admin.doctors.delete');
    Route::get('/admin/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
});

Route::get('/queue-display/{doctor}', function (\App\Models\Doctor $doctor) {
    return view('queue-display', compact('doctor'));
})->name('queue.display');