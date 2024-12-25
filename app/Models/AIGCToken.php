<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIGCToken extends Model
{
    protected $table = 'aigc_tokens';

    protected $fillable = [
        'user_id',
        'type',
        'available_numbers',
        'expired_at'
    ];
}
