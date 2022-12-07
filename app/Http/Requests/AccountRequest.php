<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $rules = [];
        // Lấy ra tên phương thức đang hoạt động
        $currentAction = $this ->route()->getActionMethod();
        switch ($this->method()) :
            case 'POST':
                switch ($currentAction) {
                    case 'add':
                        $rules= [
                            "email"=>"required|unique:users|email",
                            "name"=>"required",
                            "password"=>"required",
                            "avatar"=>"required",
                            "phone"=>"required|max:10|unique:users",
                            "address"=>"required"
                        ];
                    case 'update':
                        $rules= [
                            "email"=>"required|email",
                            "name"=>"required",
                            "password"=>"required",
//                            "avatar"=>"required",
                            "phone"=>"required|max:10",
                            "address"=>"required"
                        ];
                        break;
                    default:
                        break;
                }
                break;
        endswitch;
        return $rules;
    }
    public function messages()
    {
        return ['email.required'=>'Bắt buộc phải nhập email',
            'name.required'=>'Bắt buộc phải nhập name',
            'email.unique'=>'Email đã tồn tại',
            'email.email'=>'Đúng định dạng email',
            'avatar.required'=>'Bắt buộc phải nhập avatar',
            'password.required'=>'Bắt buộc phải nhập password',
            'phone.required'=>'Bắt buộc phải nhập số điện thoại',
            'phone.max'=>'Số điện thoại nhỏ hơn 10 số',
            'phone.unique'=>'Số điện thoại đã tồn tại',
            'address.required'=>'Bắt buộc phải nhập địa chỉ',
            ];
    }
}
