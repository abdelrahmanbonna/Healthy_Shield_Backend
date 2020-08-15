<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $guard = 'admin';
    protected $table = 'admins'; 


    protected $fillable = [
         'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];



}
