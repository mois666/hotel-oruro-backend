<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        return [
            'room_id' => 'required',
            /* Phone validation */
            'ci' => 'required|string|unique:clients,ci|min:7|max:10',
            /* No permite negativo */
            'phone' => 'required|numeric|unique:clients,phone|regex:/^[0-9]{7,10}$/',
            'name' => 'required|string|max:30|min:2',
            'last_name' => 'required|string|max:30|min:2',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount' => 'required|numeric', 
            'total' => 'required|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            "room_id.required" => "El campo room_id es requerido",
            "phone.required" => "El campo telefono es requerido",
            "phone.numeric" => "El campo telefono debe ser un numero",
            "phone.min" => "El campo telefono debe tener al menos 8 digitos",
            "phone.max" => "El campo telefono debe tener maximo 9 digitos",
            "phone.unique" => "El campo telefono debe ser unico",
            "name.required" => "El campo nombre es requerido",
            "last_name.required" => "El campo apellido es requerido",
            "start_date.required" => "El campo start_date es requerido",
            "end_date.required" => "El campo end_date es requerido",
            "discount.required" => "El campo discount es requerido",
            "discount.numeric" => "El campo discount debe ser un numero",
            "total.required" => "El campo total es requerido",
            "total.numeric" => "El campo total debe ser un numero",
            "ci.required" => "El campo ci es requerido",
            "ci.string" => "El campo ci debe ser un string",
            "ci.unique" => "El campo ci debe ser unico",
            "ci.min" => "El campo ci debe tener al menos 7 caracteres",
            "ci.max" => "El campo ci debe tener maximo 10 caracteres",
            "phone.not_in" => "El campo telefono no puede ser 0 o -1",
            "phone.regex" => "El número de teléfono debe tener entre 7 y 10 dígitos y solo contener números.",
        ];
    }
}
