<?php


namespace App\Services;

use App\Contracts\User;
use App\Data\CreateUserData;
use App\Models\User as ModelsUser;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ClienteServices implements User
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    public function createUser(CreateUserData $data): ModelsUser
    {
        $usuario= $this->userRepository->createUser($data);
        $usuario->assignRole('Customer');
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

    public function consultAll(): Collection
    {
        return $this->userRepository->consultAll();
    }
    public function deleteById(int $id): void
    {
        $this->userRepository->deleteUser($id);
    }

    public function getFiltredUsers(array $filters): Collection
    {
        return $this->userRepository->getFiltredUsers($filters);
    }

    public function getFiltredUsersPaginated(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        return $this->userRepository->getFiltredUsersPaginated($filters,$perPage);
    }


}


?>
