<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\AIGCTokenFactory;

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
        'expired_at'
    ];
}
