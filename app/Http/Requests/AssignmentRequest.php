<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentRequest extends FormRequest
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
            "room_id" => "required",
            "user_id" => "required",
            "key_room" => "required",
            "name" => "required",
            "price" => "required",
        ];
    }
    public function messages(): array
    {
        return [
            "room_id.required" => "El campo room_id es requerido",
            "user_id.required" => "El campo user_id es requerido",
            "key_room.required" => "El campo key_room es requerido",
            "name.required" => "El campo name es requerido",
            "price.required" => "El campo price es requerido",
        ];
    }
}
