<?php


namespace App\Contracts;

use App\Data\AuthCredencialesData;
use App\Models\User;

interface Auth
{
    public function login(AuthCredencialesData $credentials): string;

    public function verify(AuthCredencialesData $credentials): bool;

    public function logout(string $token): void;

}





?>
