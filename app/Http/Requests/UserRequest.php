<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if($this->isMethod('post')){
        return [
            "name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:6",
            "role" => "required|string",
            "status" => "required|string|max:255",
        ];
        }else{
            return [
                "name" => "required|string|max:255",
                "email" => "required|string|email|max:255",
                "password" => "required|string|min:6",
                "role" => "required|string",
                "last_name" => "required|string|max:255",


            ];
        }
    }

    public function messages()
    {
        return [
            /* 'avatar.regex' => 'El avatar debe ser una imagen base64.',
            'avatar.required' => 'El avatar es requerido.', */
           /*  'avatar.mimes' => 'El avatar debe ser una imagen mimes.',
            'avatar.max' => 'El avatar no debe pesar más de 2MB.', */
            "phone.required" => "El teléfono es requerido.",
            "phone.string" => "El teléfono debe ser una cadena de texto.",
            "phone.max" => "El teléfono debe tener máximo 255 caracteres.",
            "name.required" => "El nombre es requerido.",
            "name.string" => "El nombre debe ser una cadena de texto.",
            "name.max" => "El nombre debe tener máximo 255 caracteres.",
            "email.required" => "El email es requerido.",
            "email.string" => "El email debe ser una cadena de texto.",
            "email.email" => "El email debe ser un email válido.",
            "email.max" => "El email debe tener máximo 255 caracteres.",
            "email.unique" => "El email ya existe.",
            "password.required" => "La contraseña es requerida.",
            "password.string" => "La contraseña debe ser una cadena de texto.",
            "password.min" => "La contraseña debe tener al menos 6 caracteres.",
            "role.required" => "El rol es requerido.",
            "role.string" => "El rol debe ser una cadena de texto.",
            "status.required" => "El estado es requerido.",
            "status.string" => "El estado debe ser una cadena de texto.",

        ];
    }
}
