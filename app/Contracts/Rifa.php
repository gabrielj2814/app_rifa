<?php



namespace App\Contracts;

use App\Data\CreateRifaData;
use App\Data\EditRifaData;
use App\Models\Rifa as ModelsRifa;
use Illuminate\Database\Eloquent\Collection;

interface Rifa
{
    // Define rifa-specific methods here
    public function consultAll():Collection;
    public function createRifa(CreateRifaData $data): ModelsRifa;
    public function consultById(int $id):?ModelsRifa;
    public function filtrar(array $filtros=[]):Collection;
    public function paginate(array $filtros=[],int $perPage=15);
    public function editRifa(int $id,EditRifaData $data):?ModelsRifa;
    public function finalizarRifa(int $id):?ModelsRifa;


}



?>
