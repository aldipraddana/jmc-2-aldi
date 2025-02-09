<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_code' => 'required|string|max:10|regex:/^[^\'"]*$/',
            'category_name' => 'required|string|max:100|regex:/^[^\'"]*$/',
        ];
    }

    /**
     * custom message for validation
     */
    public function messages(): array
    {
        return [
            'category_code.required' => 'Kode Kategori wajib diisi dan pastikan tidak mengandung karakter petik',
            'category_code.max' => 'Kode Kategori maksimal 10 karakter',
            'category_code.regex' => 'Kode Kategori tidak boleh mengandung karakter petik',
            'category_name.required' => 'Nama Kategori wajib diisi',
            'category_name.max' => 'Nama Kategori maksimal 100 karakter',
            'category_name.regex' => 'Nama Kategori tidak boleh mengandung karakter petik',
        ];
    }

}
