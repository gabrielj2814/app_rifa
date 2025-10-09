<?php
 namespace App\Data;

use Spatie\LaravelData\Data;

class EditRifaData extends Data
{
    public function __construct(
        public int $id,
        public string $titulo,
        public string $descripcion,
        public float $precio_boleto,
        public int $total_boletos,
        public ?string $fecha_inicio,
        public ?string $fecha_fin,
        public ?string $fecha_sorteo,
        public ?string $estado,
    ){}
}


?>
