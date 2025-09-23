<?php

namespace App\Contracts;

use App\Data\CreateUserData;
use App\Models\User as ModelsUser;

interface User
{
    public function createUser(CreateUserData $data): ModelsUser;
    public function consultUserByEmail(string $email): ?ModelsUser;
    public function consultUserById(int $id): ?ModelsUser;
}


?>
