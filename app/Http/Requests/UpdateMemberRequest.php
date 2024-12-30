<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
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
            'user_name' => 'required|string',
            //'password' => 'nullable|string|min:8',
            //'avatar' => 'nullable|string',
            'full_name' => 'required|string',
            'subscriber_email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string',
            //'is_open' => 'boolean',
        ];
    }
    public function messages()
    {
        return [
            'user_name.required' => 'Tên người dùng là bắt buộc.',
            'user_name.string' => 'Tên người dùng phải là một chuỗi.',
            //'password.string' => 'Mật khẩu phải là một chuỗi.',
            //'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            //'avatar.string' => 'Đường dẫn ảnh đại diện phải là một chuỗi.',
            'full_name.required' => 'Họ và tên là bắt buộc.',
            'full_name.string' => 'Họ và tên phải là một chuỗi.',
            'subscriber_email.required' => 'Email là bắt buộc.',
            'subscriber_email.email' => 'Email không hợp lệ.',
            'phone_number.required' => 'Số điên thoại là bắt buộc.',
            'phone_number.string' => 'Số điện thoại phải là một chuỗi.',
            'phone_number.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.string' => 'Địa chỉ phải là một chuỗi.',
            //'is_open.boolean' => 'Trạng thái mở/đóng phải là true hoặc false.',
        ];
    }
}