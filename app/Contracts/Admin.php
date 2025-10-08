<?php


namespace App\Contracts;

use App\Contracts\User as ContractsUser;
use App\Data\CreateAdminData;
use App\Models\User;

interface Admin extends ContractsUser
{
    // Define admin-specific methods here

    public function createAdmin(CreateAdminData $data): User;
    public function actualizarRoles(int $id, array $roles): void;
}


?>
