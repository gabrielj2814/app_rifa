<?php


namespace App\Repository;

use App\Data\CreateRifaData;
use App\Data\EditRifaData;
use App\Models\Rifa;
use Illuminate\Database\Eloquent\Collection;

class RifaRepository {


    public function consultAll():Collection{
        return Rifa::all();
    }

    public function consultById(int $id):?Rifa{
        return Rifa::find($id);
    }

    public function editRifa(int $id, EditRifaData $data):?Rifa{
        $rifa = Rifa::find($id);
        if ($rifa) {
            $rifa->update($data->toArray());
            return $rifa;
        }
        return null;
    }

    public function createRifa(CreateRifaData $data):Rifa{
        return Rifa::create($data->toArray());
    }

    public function buildQuery(array $filtros=[]){
        $consulta= Rifa::query();

        return $consulta;
    }

    public function paginate($filtros=[],$perPage=15){
        $query = $this->buildQuery($filtros);

        return $query->paginate(perPage:$perPage);
    }

    public function filtrar($filtros=[]):Collection{
        $query = $this->buildQuery($filtros);

        return $query->get();
    }

    public function finalizarRifa(int $id):?Rifa{
        $rifa = Rifa::find($id);
        if ($rifa) {
            $rifa->estado = 'finalizado';
            $rifa->save();
            return $rifa;
        }
        return null;
    }



}


?>
