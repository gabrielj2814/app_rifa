<?php

namespace App\Http\Requests;

use App\Data\ActualizarRolesData;
use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ActualizarRolesFormRequest extends FormRequest
{

    public ActualizarRolesData $data;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'user_id'  => 'required|integer|exists:users,id',
            'roles'    => 'required|array',
            // 'roles.*'  => 'string|exists:roles,name',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'El campo user_id es obligatorio.',
            'user_id.integer'  => 'El campo user_id debe ser un número entero.',
            'user_id.exists'   => 'El usuario especificado no existe.',

            'roles.required'   => 'El campo roles es obligatorio.',
            'roles.array'      => 'El campo roles debe ser un arreglo.',
            // 'roles.*.string'   => 'Cada rol debe ser una cadena de texto.',
            // 'roles.*.exists'   => 'Uno o más roles especificados no existen.',
        ];
    }

    protected function failedValidation(Validator $validator):JsonResponse
    {
        $errors=$validator->errors();
        $response=ApiResponse::error("Error",422,$errors);
        throw new HttpResponseException($response);
    }

    protected function passedValidation()
    {
        $this->data= ActualizarRolesData::from([
            "user_id" => $this->user_id,
            "roles"   => $this->roles,
        ]);
    }
}
