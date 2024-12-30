<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|string|min:8',
        ];
    }
    public function messages()
    {
        return [
            'current_password.required' => 'Mật khẩu hiện tại là bắt buộc.',
            'current_password.string' => 'Mật khẩu hiện tại phải là một chuỗi.',

            'new_password.required' => 'Mật khẩu mới là bắt buộc.',
            'new_password.string' => 'Mật khẩu mới phải là một chuỗi.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp.',

            'new_password_confirmation.required' => 'Vui lòng xác nhận mật khẩu mới.',
            'new_password_confirmation.string' => 'Mật khẩu xác nhận phải là một chuỗi.',
            'new_password_confirmation.min' => 'Mật khẩu xác nhận phải có ít nhất 8 ký tự.',
        ];
    }
    
}