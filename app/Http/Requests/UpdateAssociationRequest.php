<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssociationRequest extends FormRequest
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
            //'user_name' => 'required|string',
            //'password' => 'nullable|string|min:8',
            'company_email' => 'required',
            'registrant_name' => 'required|string|max:255',
            'subscriber_email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'registered_phone_number' => 'required|string|max:15',
            'address' => 'required|string',
            'website' => 'required|url',
            //'avatar' => 'nullable|string',
            //'is_active' => 'required|boolean',
            //'is_open' => 'required|boolean',
            'company_name' => 'required|string|max:255',
            //'is_master' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'user_name.required' => 'Tên người dùng là bắt buộc.',
            'user_name.string' => 'Tên người dùng phải là một chuỗi.',

            //'password.string' => 'Mật khẩu phải là một chuỗi.',
            //'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',

            'company_email.required' => 'Email công ty là bắt buộc.',

            'registrant_name.required' => 'Tên người đăng ký là bắt buộc.',
            'registrant_name.string' => 'Tên người đăng ký phải là một chuỗi.',

            'subscriber_email.required' => 'Email người đăng ký là bắt buộc.',
            'subscriber_email.email' => 'Email người đăng ký không hợp lệ.',

            'phone_number.required' => 'Số điện thoại hiệp hội là bắt buộc.',
            'phone_number.string' => 'Số điện thoại phải là một chuỗi.',

            'registered_phone_number.required' => 'Số điện thoại đăng ký là bắt buộc.',
            'registered_phone_number.string' => 'Số điện thoại đăng ký phải là một chuỗi.',

            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.string' => 'Địa chỉ phải là một chuỗi.',

            'website.required' => 'Website là bắt buộc.',
            'website.url' => 'Website không hợp lệ.',

            //'avatar.string' => 'Avatar phải là một chuỗi.',

            //'is_active.required' => 'Trạng thái hoạt động là bắt buộc.',
            //'is_active.boolean' => 'Trạng thái hoạt động phải là true hoặc false.',

            //'is_open.required' => 'Trạng thái mở là bắt buộc.',
            //'is_open.boolean' => 'Trạng thái mở phải là true hoặc false.',

            'company_name.required' => 'Tên công ty là bắt buộc.',
            'company_name.max' => 'Tên công ty không được vượt quá 255 ký tự.',

            //'is_master.required' => 'Trạng thái chính là bắt buộc.',
            //'is_master.boolean' => 'Trạng thái chính phải là true hoặc false.',
        ];
    }
}