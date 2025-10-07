<?php

namespace App\Http\Controllers;

use App\Contracts\Admin;
use App\Helpers\ApiResponse;
use App\Http\Requests\CreateAdminFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct(
        protected Admin $user
    )
    {}

    public function getAll(Request $request):JsonResponse{
        //code to list admin users
        $respuesta = $this->user->consultAll();

        return ApiResponse::success($respuesta);
    }

    public function create(CreateAdminFormRequest $request):JsonResponse{

        $data= $request->data;
        $respuesta= $this->user->createAdmin($data);

        return ApiResponse::success($respuesta,201);
    }

    // public function edit(Request $request):JsonResponse{
    //     //code to list clients
    //      dd("passed");
    // }

    public function consultById(int $id,Request $request):JsonResponse{
        //code to consult admin user by id
        $respuesta= $this->user->consultUserById($id);
        if(!$respuesta){
            return ApiResponse::error('Usuario no encontrado',404);
        }
        return ApiResponse::success($respuesta);


    }

    public function delete(int $id,Request $request):JsonResponse{
        //code to delete admin user

        if(!$this->user->consultUserById($id)){
            return ApiResponse::error('Usuario no encontrado',404);
        }

        $this->user->deleteById($id);
        $validar= $this->user->consultUserById($id);
        if($validar){
            return ApiResponse::error('Error al eliminar el usuario',500);
        }

        return ApiResponse::success(null,'Usuario eliminado',204);

    }

    public function filtrarPaginate(Request $request):JsonResponse{
        //code to filter and paginate users
        $filters = $request->all();
        $perPage = $request->input('per_page', 15); // Default to 15 if not provided

        $respuesta = $this->user->getFiltredUsersPaginated($filters, $perPage);

        return ApiResponse::success($respuesta);
    }

    public function filtrarWithoutPaginate(Request $request):JsonResponse{
        //code to filter users without pagination
        $filters = $request->all();

        $respuesta = $this->user->getFiltredUsers($filters);

        return ApiResponse::success($respuesta);
    }

    // public function cambiarPermisoUsuario(Request $request):JsonResponse{
    //     //code to change user roles
    //     $id = $request->input('user_id');
    //     $roles = $request->input('roles', []);

    //     if(!$this->user->consultUserById($id)){
    //         return ApiResponse::error('Usuario no encontrado',404);
    //     }

    //     $respuesta = $this->user->actualizarRoles($id, $roles);

    //     return ApiResponse::success($respuesta);
    // }
}
