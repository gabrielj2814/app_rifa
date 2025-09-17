<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Boleto extends Model
{
    use HasFactory;

    public function rifa(): BelongsTo
    {
        return $this->belongsTo(Rifa::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pago(): HasOne
    {
        return $this->hasOne(Pago::class);
    }
}
