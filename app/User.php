<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    

    use HasApiTokens, Notifiable;
    protected $guard = 'user';
    protected $table = 'users'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'city',
        'gender',
        'job',
        'birthdate',
        'cutoflegs',
        'cutofarms',
        'chronicdisease',
        'monthlyincome',
        'mobilefees',
        'noofcars',
        'noofcars',
        'carmodel',
        'bloodtype',
        'height',
        'weight',
        'insurance',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
