<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
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
        if ($this->method() == 'POST') {
        return [
            "number" => "required|unique:rooms,number|numeric|min:1|max:999",
            "type" => "required",
            "floor" => "required|numeric|min:1|max:99",
            "status" => "required",
            "price" => "required|numeric|min:1|max:999999",
        ];
        }else{
            return [
                "number" => "",
                "type" => "",
                "floor" => "",
                "status" => "",
                "price" => "",
            ];
        }
    }
    public function messages(): array
    {
        return [
            "number.required" => "El campo numero es requerido",
            "number.unique" => "El campo numero debe ser unico",
            "number.numeric" => "El campo numero debe ser un numero",
            "number.min" => "El campo numero debe tener al menos 1 digito",
            "number.max" => "El campo numero debe tener maximo 999 digitos",
            "type.required" => "El campo type es requerido",
            "floor.required" => "El campo floor es requerido",
            "floor.numeric" => "El campo floor debe ser un numero",
            "floor.min" => "El campo floor debe tener al menos 1 digito",
            "floor.max" => "El campo floor debe tener maximo 99 digitos",
            "status.required" => "El campo status es requerido",
            "price.required" => "El campo price es requerido",
            "price.numeric" => "El campo price debe ser un numero",
            "price.min" => "El campo price debe tener al menos 1 digito",
            "price.max" => "El campo price debe tener maximo 999999 digitos",
        ];
    }
}
