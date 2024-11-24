<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'user_name' => 'required|string|alpha_num|unique:users,user_name|max:255', // Tên người dùng là bắt buộc, phải là chuỗi, duy nhất và không vượt quá 255 ký tự
            'password' => 'required|string|min:8|regex:/[0-9]/', // Mật khẩu là bắt buộc, tối thiểu 8 ký tự và có ít nhất 1 số
            'registrant_name' => 'required|string|max:255', // Tên người đăng ký là bắt buộc, phải là chuỗi và không vượt quá 255 ký tự
            'subscriber_email' => 'required|email|unique:subscribers,email', // Email người đăng ký là bắt buộc, phải có định dạng hợp lệ và duy nhất
            'phone_number' => 'required|numeric|min:10000', // Số điện thoại là bắt buộc, phải là số và có ít nhất 5 chữ số
            'address' => 'required|string|max:255', // Địa chỉ là bắt buộc, phải là chuỗi và không vượt quá 255 ký tự
            'is_active' => 'required|boolean', // Trạng thái hoạt động là bắt buộc và phải là đúng hoặc sai
            'is_open' => 'required|boolean', // Trạng thái mở là bắt buộc và phải là đúng hoặc sai
            'is_member' => 'required|boolean', // Trạng thái thành viên là bắt buộc và phải là đúng hoặc sai
        ];
    }
    public function messages()
    {
        return [
            'user_name.required' => 'Tên người dùng là bắt buộc.',
            'user_name.string' => 'Tên người dùng phải là chuỗi ký tự.',
            'user_name.alpha_num' => 'Tên người dùng chỉ được chứa chữ cái và số.',
            'user_name.unique' => 'Tên người dùng đã tồn tại.',
            'user_name.max' => 'Tên người dùng không được vượt quá 255 ký tự.',

            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một số.',

            'registrant_name.required' => 'Tên người đăng ký là bắt buộc.',
            'registrant_name.string' => 'Tên người đăng ký phải là chuỗi ký tự.',
            'registrant_name.max' => 'Tên người đăng ký không được vượt quá 255 ký tự.',

            'subscriber_email.required' => 'Email người đăng ký là bắt buộc.',
            'subscriber_email.email' => 'Email người đăng ký phải có định dạng hợp lệ.',
            'subscriber_email.unique' => 'Email người đăng ký đã tồn tại.',

            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.numeric' => 'Số điện thoại phải là số.',
            'phone_number.min' => 'Số điện thoại phải có ít nhất 5 chữ số.',

            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'is_active.required' => 'Trạng thái hoạt động là bắt buộc.',
            'is_active.boolean' => 'Trạng thái hoạt động phải là đúng hoặc sai.',

            'is_open.required' => 'Trạng thái mở là bắt buộc.',
            'is_open.boolean' => 'Trạng thái mở phải là đúng hoặc sai.',

            'is_member.required' => 'Trạng thái thành viên là bắt buộc.',
            'is_member.boolean' => 'Trạng thái thành viên phải là đúng hoặc sai.',
        ];
    }
}
