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


    public function createUser(CreateUserData $data): User
    {
        return User::create($data->toArray());
    }

    public function consultUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function consultUserById(int $id): ?User
    {
        return User::find($id);
    }

    public function consultAll():Collection
    {
        return User::all();
    }

    public function deleteUser(int $id): bool
    {
        $user = User::find($id);
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
        $user = User::find($id);
        if ($user) {
            $user->removeRole($rol);
            return true;
        }
        return false;
    }

    public function actualizarRoles(int $id, array $roles): bool
    {
        $user = User::find($id);
        if ($user) {
            $user->syncRoles($roles);
            return true;
        }
        return false;
    }



}




?>
