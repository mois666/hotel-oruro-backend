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
        return [
            "num_room" => "required",
            "type" => "required",
            "floor" => "required",
            "status" => "required",
        ];
    }
    public function messages(): array
    {
        return [
            "num_room.required" => "El campo num_room es requerido",
            "type.required" => "El campo type es requerido",
            "floor.required" => "El campo floor es requerido",
            "status.required" => "El campo status es requerido",
        ];
    }
}
