<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalPlace extends Model
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


