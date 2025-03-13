<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallbackLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'incoming_log_id',
        'status',
        'result'
    ];
}
