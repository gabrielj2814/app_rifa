<?php

namespace App\Http\Requests;

use App\Data\EditRifaData;
use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class EditRifaFormRequest extends FormRequest
{
    public EditRifaData $data;
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
            "id"            => "required|integer|exists:rifas,id",
            'titulo'         => 'required|string|min:2',
            'descripcion'    => 'required|string|min:2',
            'precio_boleto'  => 'required|numeric|min:0',
            'total_boletos'  => 'required|integer|min:1',
            'fecha_inicio'   => 'nullable|date',
            'fecha_fin'      => 'nullable|date|after_or_equal:fecha_inicio',
            'fecha_sorteo'   => 'nullable|date|after_or_equal:fecha_fin',
            'estado'         => 'nullable|string|in:activo,inactivo,finalizado'

        ];
    }
     public function messages(): array
    {
        return [
            "id.required"                   => "El campo id es obligatorio.",
            "id.integer"                    => "El campo id debe ser un número entero.",
            "id.exists"                     => "El id proporcionado no existe.",

            'titulo.required'               => 'El campo titulo es obligatorio.',
            'titulo.string'                 => 'El campo titulo debe ser una cadena de texto.',
            'titulo.min'                    => 'El campo titulo debe tener al menos :min caracteres.',

            'descripcion.required'          => 'El campo descripcion es obligatorio.',
            'descripcion.string'            => 'El campo descripcion debe ser una cadena de texto.',
            'descripcion.min'               => 'El campo descripcion debe tener al menos :min caracteres.',

            'precio_boleto.required'        => 'El campo precio_boleto es obligatorio.',
            'precio_boleto.numeric'         => 'El campo precio_boleto debe ser un número.',
            'precio_boleto.min'             => 'El campo precio_boleto debe ser al menos :min.',

            'total_boletos.required'        => 'El campo total_boletos es obligatorio.',
            'total_boletos.integer'         => 'El campo total_boletos debe ser un número entero.',
            'total_boletos.min'             => 'El campo total_boletos debe ser al menos :min.',

            'fecha_inicio.date'             => 'El campo fecha_inicio debe ser una fecha válida.',

            'fecha_fin.date'                => 'El campo fecha_fin debe ser una fecha válida.',
            'fecha_fin.after_or_equal'      => 'El campo fecha_fin debe ser una fecha posterior o igual a fecha_inicio.',

            'fecha_sorteo.date'             => 'El campo fecha_sorteo debe ser una fecha válida.',
            'fecha_sorteo.after_or_equal'   => 'El campo fecha_sorteo debe ser una fecha posterior o igual a fecha_fin.',

            'estado.string'                 => 'El campo estado debe ser una cadena de texto.',
            'estado.in'                     => 'El campo estado debe ser uno de los siguientes valores: activo, inactivo, finalizado.',
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
        $this->data=EditRifaData::from([
            "id"             =>    $this->id,
            "titulo"         =>    $this->titulo,
            "descripcion"    =>    $this->descripcion,
            "precio_boleto"  =>    $this->precio_boleto,
            "total_boletos"  =>    $this->total_boletos,
            "fecha_inicio"   =>    $this->fecha_inicio,
            "fecha_fin"      =>    $this->fecha_fin,
            "fecha_sorteo"   =>    $this->fecha_sorteo,
            "estado"         =>    $this->estado,
        ]);
    }




}
