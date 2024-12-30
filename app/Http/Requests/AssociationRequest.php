<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssociationRequest extends FormRequest
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
            'user_name'                  => 'required|min:5|unique:associations,user_name',
            'password'                  => 'required|min:8|regex:/[0-9]/',
            'company_email'             => 'required|email|email',
            'registrant_name'           => 'required|string|max:255',
            'subscriber_email'          => 'required|email|email',
            'phone_number'              => 'required|numeric',
            'registered_phone_number'   => 'required|numeric',
            'address'                   => 'required|string|max:255',

            'website'                   => 'required|url',
            'avatar'                    => 'required',

            'is_active'                 => 'required|boolean',
            'is_open'                   => 'required|boolean',
            'company_name'              => 'required|string|max:255',
            'is_master'                 => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Tên người dùng là bắt buộc.',
            'user_name.min' => 'Tên người dùng phải có ít nhất 5 ký tự.',
            'user_name.alpha_num' => 'Tên người dùng chỉ được chứa chữ cái và số.',
            'user_name.unique' => 'Tên người dùng đã tồn tại.',

            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một số.',

            'company_email.required' => 'Email công ty là bắt buộc.',
            'company_email.email' => 'Email công ty phải có định dạng hợp lệ.',
            'company_email.unique' => 'Email công ty đã tồn tại.',

            'registrant_name.required' => 'Tên người đăng ký là bắt buộc.',
            'registrant_name.string' => 'Tên người đăng ký phải là chuỗi ký tự.',
            'registrant_name.max' => 'Tên người đăng ký không được vượt quá 255 ký tự.',

            'subscriber_email.required' => 'Email người đăng ký là bắt buộc.',
            'subscriber_email.email' => 'Email người đăng ký phải có định dạng hợp lệ.',
            'subscriber_email.unique' => 'Email người đăng ký đã tồn tại.',

            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.numeric' => 'Số điện thoại phải là số.',

            'registered_phone_number.required' => 'Số điện thoại đã đăng ký là bắt buộc.',
            'registered_phone_number.numeric' => 'Số điện thoại đã đăng ký phải là số.',

            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',



            'website.required' => 'Website là bắt buộc.',
            'website.url' => 'Website phải có định dạng hợp lệ.',

            // 'member_introduction.required' => 'Giới thiệu thành viên là bắt buộc.',
            // 'member_introduction.min' => 'Giới thiệu thành viên phải có ít nhất 5 ký tự.',

            'is_active.required' => 'Trạng thái hoạt động là bắt buộc.',
            'is_active.boolean' => 'Trạng thái hoạt động phải là true hoặc false.',

            'is_open.required' => 'Trạng thái mở là bắt buộc.',
            'is_open.boolean' => 'Trạng thái mở phải là true hoặc false.',

            'company_name.required' => 'Tên công ty là bắt buộc.',
            'company_name.string' => 'Tên công ty phải là chuỗi ký tự.',
            'company_name.max' => 'Tên công ty không được vượt quá 255 ký tự.',

            'is_master.required' => 'Trạng thái quản lý là bắt buộc.',
            'is_master.boolean' => 'Trạng thái quản lý phải là true hoặc false.',

        ];
    }
}
