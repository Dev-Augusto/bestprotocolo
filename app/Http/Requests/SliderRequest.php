<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // pode ser nula no update
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'name_btn'    => 'nullable|string|max:100',
            'url_btn'     => 'nullable|url|max:255',
        ];
    }

    /**
     * Mensagens de erro personalizadas.
     */
    public function messages(): array
    {
        return [
            'image.image'     => 'O arquivo enviado deve ser uma imagem.',
            'image.mimes'     => 'A imagem deve estar no formato JPG, JPEG, PNG ou WEBP.',
            'image.max'       => 'A imagem não pode ter mais de 2MB.',
            'title.required'  => 'O campo título é obrigatório.',
            'url_btn.url'     => 'O link do botão deve ser uma URL válida.',
        ];
    }
}
