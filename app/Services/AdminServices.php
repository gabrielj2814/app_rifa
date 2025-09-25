<?php


namespace App\Services;

use App\Contracts\Admin;
use App\Contracts\User;
use App\Data\CreateUserData;
use App\Models\User as ModelsUser;
use App\Repository\UserRepository;

class AdminServices implements Admin
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    public function createUser(CreateUserData $data): ModelsUser
    {
        $usuario= $this->userRepository->createUser($data);
        $usuario->assignRole('Web-Team-default-Member');
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
