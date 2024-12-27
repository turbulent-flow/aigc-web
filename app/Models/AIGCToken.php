<?php

namespace App\Models;

use Database\Factories\AIGCTokenFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIGCToken extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return AIGCTokenFactory::new();
    }

    protected $table = 'aigc_tokens';

    protected $fillable = [
        'user_id',
        'type',
        'available_numbers',
        'expired_at',
    ];
}
