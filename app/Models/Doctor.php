<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'specialization', 'bio'
    ];

    protected $hidden = ['password'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}