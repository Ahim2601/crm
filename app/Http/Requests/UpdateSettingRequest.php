<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'message_email' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo Nombre de Empresa es requerido.',
            'email.required' => 'El campo Correo es requerido.',
            'phone.required' => 'El campo Telefono es requerido.',
            'address.required' => 'El campo Dirección es requerido.',
            'message_email.required' => 'El campo Mensaje de Correo es requerido.',
        ];
    }
}
