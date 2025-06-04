<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "email" => "required|email|exists:users,email",
            "password" => "required|min:6",
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => "El campo email es requerido",
            "email.email" => "Ingrese un email correcto",
            "email.exists" => "El correo electrónico no se encontró",
            "password.required" => "La contraseña es requerida",
            "password.min" => "La contraseña debe tener al menos 6 caracteres"

        ];
    }
}
