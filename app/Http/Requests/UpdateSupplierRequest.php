<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Here you can add your authorization logic.
     */
    public function authorize(): bool
    {
        // Allow all authenticated users for now
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * These rules will apply when updating a supplier.
     */
    public function rules(): array
    {
        // Get supplier ID for unique validation (ignore current record)
        $supplierId = $this->route('supplier');

        return [
            'country' => ['required', 'string', 'max:100'],
            'company_name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:suppliers,code,' . $supplierId],
            'added_by' => ['nullable', 'exists:users,id'], // system user who added

            // Optional fields
            'email' => ['nullable', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],

            // Representative info
            'representative_name' => ['nullable', 'string', 'max:150'],
            'representative_email' => ['nullable', 'email', 'max:150'],
            'representative_phone' => ['nullable', 'string', 'max:50'],
        ];
    }

    /**
     * Custom messages (optional).
     */
    public function messages(): array
    {
        return [
            'country.required' => 'Country is required.',
            'company_name.required' => 'Company/Factory Name is required.',
            'code.required' => 'Supplier Code is required.',
            'code.unique' => 'This Supplier Code is already in use.',
        ];
    }
}
