<?php

namespace App\Contracts;

use App\Data\CreateUserData;
use App\Models\User as ModelsUser;
use BaconQrCode\Common\Mode;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface User
{
    public function createUser(CreateUserData $data): ModelsUser;
    public function consultUserByEmail(string $email): ?ModelsUser;
    public function consultUserById(int $id): ?ModelsUser;
    public function consultAll(): Collection;
    public function deleteById(int $id): void;
    public function getFiltredUsers(array $filters): Collection;
    public function getFiltredUsersPaginated(array $filters, int $perPage = 15): LengthAwarePaginator;
}


?>
