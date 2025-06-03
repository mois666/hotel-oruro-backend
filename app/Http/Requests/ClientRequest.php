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
            "name" => "required",
            "last_name" => "required",
            //"ci" => "required|unique:clients,ci",
        ];
    }
    public function messages(): array
    {
        return [
            "name.required" => "El campo name es requerido",
            "last_name.required" => "El campo last_name es requerido",
            "ci.required" => "El campo ci es requerido",
        ];
    }
}
