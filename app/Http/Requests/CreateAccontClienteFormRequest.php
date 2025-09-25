<?php

namespace App\Http\Requests;

use App\Data\CreateUserData;
use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CreateAccontClienteFormRequest extends FormRequest
{

    public CreateUserData $data;

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
            'name'          => 'required|string|min:2',
            'last_name'     => 'required|string|min:2',
            'pin'           => 'required|string|min:6|max:6|unique:App\Models\User,pin',
            'email'         => 'required|email|unique:App\Models\User,email',
            'password'      => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'El campo nombre es obligatorio.',
            'name.string'         => 'El campo nombre debe ser una cadena de texto.',
            'name.min'            => 'El campo nombre debe tener al menos :min caracteres.',

            'last_name.required'  => 'El campo apellido es obligatorio.',
            'last_name.string'    => 'El campo apellido debe ser una cadena de texto.',
            'last_name.min'       => 'El campo apellido debe tener al menos :min caracteres.',

            'pin.required'        => 'El campo PIN es obligatorio.',
            'pin.string'          => 'El campo PIN debe ser una cadena de texto.',
            'pin.min'             => 'El campo PIN debe tener al menos :min caracteres.',
            'pin.max'             => 'El campo PIN no debe exceder de :max caracteres.',
            'pin.unique'          => 'El PIN ya está en uso. Por favor, elige otro.',

            'email.required'      => 'El campo email es obligatorio.',
            'email.email'         => 'El campo email debe ser una dirección de correo electrónico válida.',
            'email.unique'        => 'El email ya está en uso. Por favor, elige otro.',

            'password.required'   => 'El campo contraseña es obligatorio.',
            'password.string'     => 'El campo contraseña debe ser una cadena de texto.',
            'password.min'        => 'El campo contraseña debe tener al menos :min caracteres.',
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
        $this->data=CreateUserData::from([
            "name"       =>    $this->name,
            "last_name"  =>    $this->last_name,
            "pin"        =>    $this->pin,
            "email"      =>    $this->email,
            "password"   =>    $this->password,
        ]);
    }


}
