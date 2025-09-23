<?php


namespace App\Services;

use App\Contracts\User;
use App\Data\CreateUserData;
use App\Models\User as ModelsUser;

class UserServices implements User
{
    public function __construct(
        protected User $userRepository
    )
    {}

    public function createUser(CreateUserData $data): ModelsUser
    {
        $usuario= $this->userRepository->createUser($data);
        return $usuario;
    }

    public function consultUserByEmail(string $email): ?ModelsUser
    {
        return $this->userRepository->consultUserByEmail($email);
    }

    public function consultUserById(int $id): ?ModelsUser
    {
        return $this->userRepository->consultUserById($id);
    }

}


?>
