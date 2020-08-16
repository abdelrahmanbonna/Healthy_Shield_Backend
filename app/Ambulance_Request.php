<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambulance_Request extends Model
{
    //
    protected $fillable = [
        'date',
        'location_link',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
