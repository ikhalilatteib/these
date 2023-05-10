<?php

namespace App\Models;

use App\Events\TaskPingCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ping extends Model
{
    use SoftDeletes;
    
    protected $dispatchesEvents = [
        'created' => TaskPingCreated::class
    ];
    
    protected $fillable = [
        'title',
        'description',
        'container',
        'ip',
        'user_id',
        'max_ping',
        'status'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function containers(): HasMany
    {
        return $this->hasMany(PingContainer::class);
    }
}
