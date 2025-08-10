<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],

            'about.title' => ['nullable', 'string', 'max:255'],
            'about.description' => ['nullable', 'string'],
            'about.list' => ['nullable', 'array'],
            'about.list.*' => ['nullable', 'string', 'max:255'],

            'clients' => ['nullable', 'array'],
            'clients.*.name' => ['nullable', 'string', 'max:255'],
            'clients.*.description' => ['nullable', 'string'],
            'clients.*.stars' => ['nullable', 'integer', 'min:0', 'max:5'],
            'clients.*.type' => ['nullable', 'string', 'max:255'],

            'images' => ['nullable', 'array'],
            'images.*.img' => ['nullable', 'image', 'max:2048'],
            'images.*.remove' => ['nullable', 'boolean'],
        ];
    }
}
