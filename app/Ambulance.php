<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Ambulance extends Model
{
    //
    use HasApiTokens, Notifiable;
    protected $guard = 'ambulance';
    protected $table = 'ambulances'; 

    protected $fillable = [
        'name',
        'address',
        'contactno',
        'email' ,
        'password' 
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}


