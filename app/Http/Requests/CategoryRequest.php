<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
//        dd($currentAction);
        switch ($this->method()) :
            case 'POST':
                switch ($currentAction) {
                    case 'add':
                        $rules= [
                            "name"=>"required|unique:categories",
                        ];
                    case 'update':
                        $rules= [
                            "name"=>"required",
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
        return [
            'name.required'=>'Bắt buộc phải nhập danh mục',
            'name.unique'=>'Danh mục đã tồn tại',

        ];
    }
}
