<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
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
