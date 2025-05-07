<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            "client_id" => "required",
            "user_id" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "simple" => "required",
            "double" => "required",
            "state" => "required",
            "discount" => "required",
            "total" => "required",
        ];
    }
    public function messages(): array
    {
        return [
            "client_id.required" => "El campo client_id es requerido",
            "user_id.required" => "El campo user_id es requerido",
            "start_date.required" => "El campo start_date es requerido",
            "end_date.required" => "El campo end_date es requerido",
            "simple.required" => "El campo simple es requerido",
            "double.required" => "El campo double es requerido",
            "state.required" => "El campo state es requerido",
            "discount.required" => "El campo discount es requerido",
            "total.required" => "El campo total es requerido",
        ];
    }
}
