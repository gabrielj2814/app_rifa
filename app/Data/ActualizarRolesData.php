<?php


namespace App\Data;

use Spatie\LaravelData\Data;

class ActualizarRolesData extends Data{
    public function __construct(
        public int $user_id,
        public array $roles
    ){}
}


?>
