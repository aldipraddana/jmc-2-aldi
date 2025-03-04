<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class IncomingItemRequest extends FormRequest
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
            'operator' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'item_source' => 'required',
            'reverence_number' => 'required',
            'attachment' => 'nullable|file|mimes:doc,docx,zip,jpg,png', // 'attachment.*' jika array
            'item_name' => 'required|array',
            'item_name.*' => 'required|string',
            'price' => 'required|array',
            'price.*' => 'required',
            'quantity' => 'required|array',
            'quantity.*' => 'required|numeric',
            'unit' => 'required|array',
            'unit.*' => 'required|string',
            'expired_date' => 'nullable',
            'expired_date.*' => 'nullable',
        ];
    }

}
