<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImportCustomerRequest extends FormRequest
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
            'archivo' => ['required', 'mimes:xls,xlsx'],
        ];
    }

    public function messages()
    {
        return [
            'archivo.mimes' => 'El Archivo debe ser de tipo: xls, xlsx.',
            'archivo.required' => 'El campo Archivo es obligatorio.',
        ];
    }
}
