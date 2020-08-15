<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $fillable = [
        
            'prescription',
            'date',
            'doctor_id',
            'user_id',
            'medicalplaces_id',
    ];

    public function doctors()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medicalplaces()
    {
        return $this->belongsTo(MedicalPlace::class, 'medicalplaces_id');
    }
}
