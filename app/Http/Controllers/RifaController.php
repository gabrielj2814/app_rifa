<?php

namespace App\Http\Controllers;

use App\Contracts\Rifa;
use App\Helpers\ApiResponse;
use App\Http\Requests\CreateRifaFormRequest;
use App\Http\Requests\EditRifaFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RifaController extends Controller
{
    //

    public function __construct(
        protected Rifa $rifa,
    )
    {}

    public function getAll(Request $request):JsonResponse{

            $respuesta = $this->rifa->consultAll();

            return ApiResponse::success($respuesta);
    }

    public function getById(int $id):JsonResponse{
        $respuesta = $this->rifa->consultById($id);

        if(!$respuesta){
            return ApiResponse::error(message: "No se encontro la rifa",code:404);
        }

        return ApiResponse::success(data:$respuesta);
    }

    public function createRifa(CreateRifaFormRequest $request):JsonResponse{
        $data=$request->data;

        $rifa=$this->rifa->createRifa($data);

        return ApiResponse::success(data:$rifa,message: "Rifa creada con exito",code:200);
    }

    public function filtrar(Request $request):JsonResponse{
        $filtros = $request->all();

        $respuesta = $this->rifa->filtrar($filtros);

        return ApiResponse::success(data:$respuesta);
    }

    public function paginate(Request $request):JsonResponse{
        $filtros = $request->all();
        $perPage = $request->input('per_page', 15);

        $respuesta = $this->rifa->paginate($filtros,$perPage);

        return ApiResponse::success(data:$respuesta);
    }

    public function editRifa(EditRifaFormRequest $request):JsonResponse{
        $data=$request->data;
        $id=$data->id;

        $rifa=$this->rifa->editRifa($id,$data);

        if(!$rifa){
            return ApiResponse::error(message: "No se encontro la rifa",code:404);
        }

        return ApiResponse::success(data:$rifa,message: "Rifa actualizada con exito",code:200);
    }

    public function finalizarRifa(int $id):JsonResponse{
        $rifa=$this->rifa->finalizarRifa($id);

        if(!$rifa){
            return ApiResponse::error(message: "No se encontro la rifa",code:404);
        }

        return ApiResponse::success(data:$rifa,message: "Rifa finalizada con exito",code:200);
    }
}
