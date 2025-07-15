<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pair_name',
        'market_type',
        'image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'timestamp' => 'datetime', // Cast the timestamp column to a Carbon instance
    ];

    // If you are not using Laravel's default 'created_at' and 'updated_at' columns,
    // and 'timestamp' is your only timestamp column, you might want to set:
    // public $timestamps = false;
    // However, it's generally recommended to use Laravel's default timestamps.
}
