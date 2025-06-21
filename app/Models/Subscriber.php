<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    
    protected $fillable = [
        'username',
        'email',
        'password',
       
    ];

    // If you're using timestamps (created_at, updated_at)
    public $timestamps = true;
}
