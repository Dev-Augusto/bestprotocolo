<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
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
            'partner' => ['nullable', 'array'],
            'partner.*.name' => ['nullable', 'string', 'max:255'],
            'partner.*.profission' => ['nullable', 'string', 'max:255'],
            'partner.*.image' => ['nullable', 'image', 'max:2048'],
            'partner.*.remove' => ['nullable', 'boolean'],
        ];
    }
}
