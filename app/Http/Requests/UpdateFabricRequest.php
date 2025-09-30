<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFabricRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow all authenticated users for now
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $fabricId = $this->route('fabric');

        return [
            // Required fields
            'fabric_no' => ['required', 'string', 'max:100', 'unique:fabrics,fabric_no,' . $fabricId],
            'composition' => ['required', 'string', 'max:255'],
            'gsm' => ['required', 'numeric', 'min:1'],
            'qty' => ['required', 'numeric', 'min:0'],
            'cuttable_width' => ['required', 'numeric', 'min:0'],
            'production_type' => ['required', 'in:Sample Yardage,SMS,Bulk'],

            // Optional fields
            'construction' => ['nullable', 'string', 'max:255'],
            'color_pantone_code' => ['nullable', 'string', 'max:50'],
            'weave_type' => ['nullable', 'string', 'max:100'],
            'finish_type' => ['nullable', 'string', 'max:100'],
            'dyeing_method' => ['nullable', 'string', 'max:100'],
            'printing_method' => ['nullable', 'string', 'max:100'],
            'lead_time' => ['nullable', 'integer', 'min:0'],
            'moq' => ['nullable', 'integer', 'min:0'],
            'shrinkage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'remarks' => ['nullable', 'string'],
            'fabric_selected_by' => ['nullable', 'string', 'max:150'],

            // Image upload
            'fabric_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],

            // Supplier relation
            'supplier_id' => ['required', 'exists:suppliers,id'],
        ];
    }

    /**
     * Custom messages (optional).
     */
    public function messages(): array
    {
        return [
            'fabric_no.required' => 'Fabric number is required.',
            'fabric_no.unique' => 'This fabric number is already in use.',
            'composition.required' => 'Composition is required.',
            'gsm.required' => 'GSM is required.',
            'qty.required' => 'Quantity is required.',
            'cuttable_width.required' => 'Cuttable width is required.',
            'production_type.required' => 'Production type is required.',
        ];
    }
}
