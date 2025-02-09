<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class UserManagementRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            $id = '';
        }else {
            $id = Crypt::decrypt($this->route('id'));
        }
        $rule = [
            'username' => [
                'required',
                'string',
                'min:8',
                'max:100',
                Rule::unique('users', 'username')->ignore($id),
            ],
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'role' => 'required|in:admin,operator',
        ];
        if ($this->isMethod('post')) {
            $rule['password'] = 'required|string|min:8|max:100|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/';
        }
        return $rule;
    }

    /**
     * custom message for validation
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi',
            'username.min' => 'Username minimal 8 karakter',
            'username.max' => 'Username maksimal 100 karakter',
            'username.unique' => 'Username sudah digunakan',
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 100 karakter',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan angka',
            'role.required' => 'Role wajib diisi',
            'role.in' => 'Role tidak valid',
        ];
    }

   
}
