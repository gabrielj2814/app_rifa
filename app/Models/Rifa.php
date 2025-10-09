<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rifa extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_sorteo',
        'fecha_inicio',
        'fecha_fin',
        'precio_boleto',
        'total_boletos',
        'estado',
    ];


    public function boletos(): HasMany
    {
        return $this->hasMany(Boleto::class);
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }

    public function ganadores(): HasMany
    {
        return $this->hasMany(Ganador::class);
    }

    public function premios(): HasMany
    {
        return $this->hasMany(Premio::class);
    }
}
