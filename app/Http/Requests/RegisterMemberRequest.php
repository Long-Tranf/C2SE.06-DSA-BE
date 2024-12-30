<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterMemberRequest extends FormRequest
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
    public function rules()
    {
        return [
            'user_name' => 'required|string|unique:members|max:255',
            'password' => 'required|string|min:8|confirmed',
            'full_name' => 'required|string|max:255',
            'subscriber_email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|min:5|max:255',
            'avatar' => 'nullable|string',
            'is_active' => 'boolean',
            'is_open' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Tên đăng nhập là bắt buộc.',
            'user_name.unique' => 'Tên đăng nhập đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'full_name.required' => 'Họ tên là bắt buộc.',
            'subscriber_email.nullable' => 'Vui lòng nhập một địa chỉ email hợp lệ.',
            'subscriber_email.email' => 'Vui lòng nhập một địa chỉ email hợp lệ.',
            'subscriber_email.max' => 'Địa chỉ email không được quá 255 ký tự.',
            'phone_number.max' => 'Số điện thoại không được quá 20 ký tự.',
            'address.min' => 'Địa chỉ phải có ít nhất 5 ký tự.',
            'address.max' => 'Địa chỉ không được quá 255 ký tự.',
        ];
    }
}