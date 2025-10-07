<?php



namespace App\Data;

use Spatie\LaravelData\Data;

class CreateAdminData extends Data
{
    public function __construct(
        public string $name,
        public string $last_name,
        public string $email,
    ){}
}




?>
