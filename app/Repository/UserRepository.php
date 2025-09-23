<?php

namespace App\Repository;

use App\Data\CreateUserData;
use App\Models\User;

class UserRepository
{
    // Implementation of user repository methods

    function __construct(
        protected User $userModel
    )
    {}

    public function createUser(CreateUserData $data): User
    {
        return $this->userModel->create($data->toArray());
    }

    public function consultUserByEmail(string $email): ?User
    {
        return $this->userModel->where('email', $email)->first();
    }

    public function consultUserById(int $id): ?User
    {
        return $this->userModel->find($id);
    }



}




?>
