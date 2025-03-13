<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'source',
        'title',
        'word_count',
        'incoming_log_data_id'
    ];
}
