<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
        // Rule::unique(Customer::class)->ignore($this->id)
        // Rule::unique(Customer::class)->ignore($this->id)
        return [
            'business_name' => ['required'],
            'email' => ['required', 'email'],
        ];
    }

    public function messages(): array
    {
        return [
            'business_name.required' => 'La Razon Social o Nombre es requerido',
            'email.required' => 'El Correo es requerido',
            'email.email' => 'El Correo debe ser válido',
        ];
    }
}
