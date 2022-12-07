<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $currentAction = $this ->route()->getActionMethod();
        switch ($this->method()) :
            case 'POST':
                switch ($currentAction) {
                    case 'add':
                        $rules= [
                            "name"=>"required|unique:product",
                            "cate_id"=>"required",
//                            "image"=>"required",
                            "price"=>"required",
                            "quantity"=>"required",
                            "view"=>"required",
                            "discount"=>"required",
                            "desc"=>"required",
                        ];
                    case 'update':
                        $rules= [
                            "name"=>"required",
                            "cate_id"=>"required",
//                            "image"=>"required",
                            "price"=>"required",
                            "quantity"=>"required",
                            "view"=>"required",
                            "discount"=>"required",
                            "desc"=>"required",
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
        return ['name.required'=>'Bắt buộc phải nhập tên sản phẩm',
            'name.unique'=>'Sản phẩm đã tồn tại',
            'cate_id.required'=>'Bắt buộc phải nhập danh mục',
            'image.required'=>'Bắt buộc phải nhập ảnh',
            'price.required'=>'Bắt buộc phải nhập giá',
            'quantity.required'=>'Bắt buộc phải nhập số lượng',
            'view.required'=>'Bắt buộc phải nhập view',
            'discount.required'=>'Bắt buộc phải nhập giảm giá',
            'desc.required'=>'Bắt buộc phải nhập mô tả',];
    }
}
