<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    //
    protected $fillable = [
        'user_id', 'job',
    ];
}
