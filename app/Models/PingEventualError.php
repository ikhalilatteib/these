<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PingEventualError extends Model
{
    
    protected $fillable =[
        'message',
        'code',
        'line',
        'file',
        'trace',
        'ping_id'
    ];
}
