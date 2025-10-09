<?php


namespace App\Services;

use App\Contracts\Rifa;
use App\Data\CreateRifaData;
use App\Data\EditRifaData;
use App\Models\Rifa as ModelsRifa;
use App\Repository\RifaRepository;
use Illuminate\Database\Eloquent\Collection;

class RifaServices implements Rifa{

    public function __construct(
        protected RifaRepository $rifaRepository
    )
    {}

    public function consultAll(): Collection
    {
        return $this->rifaRepository->consultAll();
    }

    public function createRifa(CreateRifaData $data): ModelsRifa
    {
        $data->estado = $data->estado ?? 'inactivo';
        return $this->rifaRepository->createRifa($data);
    }

    public function consultById(int $id): ?ModelsRifa
    {
        return $this->rifaRepository->consultById($id);
    }

    public function filtrar(array $filtros = []): Collection
    {
        return $this->rifaRepository->filtrar($filtros);
    }

    public function paginate(array $filtros = [], int $perPage = 15)
    {
        return $this->rifaRepository->paginate($filtros,$perPage);
    }

    public function editRifa(int $id, EditRifaData $data): ?ModelsRifa
    {
        $rifa= $this->consultById($id);
        $data->estado = $data->estado ??  $rifa->estado;
        return $this->rifaRepository->editRifa($id,$data);
    }

    public function finalizarRifa(int $id): ?ModelsRifa
    {
        return $this->rifaRepository->finalizarRifa($id);
    }


}


?>
