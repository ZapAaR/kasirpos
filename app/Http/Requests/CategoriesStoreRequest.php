<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoriesStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.string'   => 'Nama kategori harus berupa teks.',
            'nama.max'      => 'Nama kategori maksimal 255 karakter.',

            'slug.required' => 'Slug wajib diisi.',
            'slug.string'   => 'Slug harus berupa teks.',
            'slug.max'      => 'Slug maksimal 255 karakter.',
            'slug.unique'   => 'Slug sudah digunakan, silakan gunakan slug lain.',
        ];
    }
}
