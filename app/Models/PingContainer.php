<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PingContainer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'container_id',
        'ping_id',
        'packets_transmitted',
        'packets_received',
        'packet_loss',
        'min',
        'avg',
        'max',
        'log',
        'operation_time'
    ];
    
    public function ping(): BelongsTo
    {
        return $this->belongsTo(Ping::class);
    }
}
