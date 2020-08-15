<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblContactUs extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'message',
        'accounttype',
        'phone',
    ];
}
