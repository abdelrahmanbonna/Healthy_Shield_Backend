<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Doctor extends Model
{
    //
    use HasApiTokens, Notifiable;
    protected $guard = 'doctor';
    protected $table = 'doctors'; 

    protected $fillable = [
    'name',
    'address',
    'phone',
    'email',
    'password',
    'doctorspecialization_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function doctorspecializations()
    {
        return $this->belongsTo(DoctorSpecialization::class, 'doctorspecialization_id');
    }
}
