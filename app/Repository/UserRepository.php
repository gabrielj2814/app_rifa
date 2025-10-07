<?php

namespace App\Repository;

use App\Data\CreateUserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function consultAll():Collection
    {
        return $this->userModel->all();
    }

    public function deleteUser(int $id): bool
    {
        $user = $this->userModel->find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }

    public function buildFiltredQuery(array $filters):EloquentBuilder
    {
        $query = User::query();

        return $query;
    }

    public function buildFiltredAdminQuery(array $filters):EloquentBuilder
    {
        $query = User::query();

        $query->role('Web-Team-default-Member');

        return $query;
    }

     public function getFiltredUsersPaginated(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->buildFiltredQuery($filters);
        return $query->paginate($perPage);
    }

    public function getFiltredUsers(array $filters): Collection
    {
        $query = $this->buildFiltredQuery($filters);
        return $query->get();
    }

    public function removerRolUsuario(int $id, string $rol): bool
    {
        $user = $this->userModel->find($id);
        if ($user) {
            $user->removeRole($rol);
            return true;
        }
        return false;
    }

    public function actualizarRoles(int $id, array $roles): bool
    {
        $user = $this->userModel->find($id);
        if ($user) {
            $user->syncRoles($roles);
            return true;
        }
        return false;
    }



}




?>
