<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    // Optional: specify table name if not "signals"
    // protected $table = 'signals';

    // Allow mass assignment for these fields
    protected $fillable = [
        'pair_name',
        'signal_type',
        'market_type',
        'entry_price',
        'stop_loss',
        'take_profit',
        'group_type',
        'is_open',
        'entry_price_premium',
        'stop_loss_premium',
        'take_profit_premium',
    ];

    // If you're using timestamps (created_at, updated_at)
    public $timestamps = true;

    // Optional: type casting
    protected $casts = [
        'entry_price' => 'float',
        'stop_loss' => 'float',
        'take_profit' => 'float',
        'is_open' => 'boolean',
        // New premium switch fields cast to boolean
        'entry_price_premium' => 'boolean',
        'stop_loss_premium' => 'boolean',
        'take_profit_premium' => 'boolean',
    ];
}
