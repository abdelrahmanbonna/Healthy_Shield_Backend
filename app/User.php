<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

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
        'phone',
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
        'accepted',
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

}
