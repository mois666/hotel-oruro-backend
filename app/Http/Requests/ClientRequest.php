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
            'phone' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount' => 'required',
            'total' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            "room_id.required" => "El campo room_id es requerido",
            "phone.required" => "El campo phone es requerido",
            "name.required" => "El campo name es requerido",
            "last_name.required" => "El campo last_name es requerido",
            "start_date.required" => "El campo start_date es requerido",
            "end_date.required" => "El campo end_date es requerido",
            "discount.required" => "El campo discount es requerido",
            "total.required" => "El campo total es requerido",
        ];
    }
}
