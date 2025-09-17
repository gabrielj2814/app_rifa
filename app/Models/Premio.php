<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Premio extends Model
{
    use HasFactory;

    public function rifa(): BelongsTo
    {
        return $this->belongsTo(Rifa::class);
    }
}
