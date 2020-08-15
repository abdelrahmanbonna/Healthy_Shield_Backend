<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class MedicalPlace extends Authenticatable
{
    //
    use HasApiTokens, Notifiable;
    protected $guard = 'medicalplace';
    protected $table = 'medicalplaces'; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'fees',
        'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


}


