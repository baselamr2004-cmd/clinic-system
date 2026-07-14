<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'birth_date', 'gender'
    ];

    protected $hidden = ['password'];

    // مريض واحد ليه اكتر من معاد
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}