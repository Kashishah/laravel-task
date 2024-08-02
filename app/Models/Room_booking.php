<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room_booking extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function guest(): BelongsTo{
        return $this->belongsTo(Guest::class);
    }
}
