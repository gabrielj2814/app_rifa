<?php

namespace App\Http\Controllers;

use App\Contracts\Auth as ContractsAuth;
use App\Helpers\ApiResponse;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function __construct(
        protected ContractsAuth $auth
    )
    {}


    public function login(LoginFormRequest $request):JsonResponse
    {


        $credentials = $request->data;

        $validarCrendenciales=$this->auth->verify($credentials);
        if(!$validarCrendenciales){
            return ApiResponse::error('Credenciales invalidas',401);
        }

        $token=$this->auth->login($credentials);

        return ApiResponse::success([
            'access_token' => $token,
            'token_type'   => 'Bearer'
        ],'Login exitoso');

    }

    public function logout(Request $request):JsonResponse
    {
        $token=$request->bearerToken();
        $this->auth->logout($token);
        return ApiResponse::success(message: 'Logout exitoso');
    }


}
