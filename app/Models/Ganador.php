<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ganador extends Model
{
    use HasFactory;

    public function rifa(): BelongsTo
    {
        return $this->belongsTo(Rifa::class);
    }

    public function boleto(): BelongsTo
    {
        return $this->belongsTo(Boleto::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
