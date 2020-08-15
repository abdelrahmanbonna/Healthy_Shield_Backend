<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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


