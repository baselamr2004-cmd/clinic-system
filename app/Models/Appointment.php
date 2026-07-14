<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id', 'doctor_id', 'appointment_date', 'queue_number', 'status'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // الحجز الواحد ليه سجل طبي واحد بس
    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }
}