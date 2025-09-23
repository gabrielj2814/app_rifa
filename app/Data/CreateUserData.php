<?php


namespace App\Data;
use Spatie\LaravelData\Data;

class CreateUserData extends Data
{
    public function __construct(
        public string $name,
        public ?string $last_name,
        public ?string $pin,
        public string $email,
        public string $password,
    ) {}
}



?>
