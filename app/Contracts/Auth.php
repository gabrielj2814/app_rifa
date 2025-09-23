<?php


namespace App\Contracts;

use App\Data\AuthCredencialesData;
use App\Models\User;

interface Auth
{
    public function login(AuthCredencialesData $credentials): string;

    public function logout(): void;

    public function user(): User;
}





?>
