<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SubCategoryRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'sub_category_name' => 'required|string|max:100|regex:/^[^\'"]*$/',
            'price_limit' => 'required|numeric',
        ];
    }

    /**
     * prepare for validation
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'price_limit' => str_replace('.', '', $this->price_limit),
        ]);
    }

    /**
     * custom message for validation
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib diisi',
            'category_id.exists' => 'Kategori tidak ditemukan',
            'sub_category_name.regex' => 'Nama Sub Kategori tidak boleh mengandung karakter petik',
            'sub_category_name.required' => 'Nama Sub Kategori wajib diisi',
            'sub_category_name.max' => 'Nama Sub Kategori maksimal 100 karakter',
            'price_limit.required' => 'Batas Harga wajib diisi',
            'price_limit.numeric' => 'Batas Harga harus berupa angka',
        ];
    }
}
