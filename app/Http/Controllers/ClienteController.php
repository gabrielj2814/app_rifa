<?php

namespace App\Http\Controllers;

use App\Contracts\User;
use App\Helpers\ApiResponse;
use App\Http\Requests\CreateAccontClienteFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    //

    public function __construct(
        protected User $user
    )
    {}

    public function registrar(CreateAccontClienteFormRequest $request):JsonResponse{

        $request->data->password=Hash::make($request->data->password);

        $usuario=$this->user->createUser($request->data);


        return ApiResponse::success($usuario,"ok",200);
    }





}
