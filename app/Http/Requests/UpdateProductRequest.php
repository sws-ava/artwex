<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProductRequest extends Request
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
     * @return array
     */
    public function rules()
    {
		$id = $this->route('product');
		$regex = "/^[0-9.,]+$/";
        return [
           'category_list' => 'required',
           'name' => 'required|composite_unique:products,name, '.$id,
           'short_description' => 'required',
           'description' => 'required',
           'price' => 'nullable|regex:'.$regex.'|min:0',
        ];

    }

   /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_list.required' => trans('validation.category_list_required'),
        ];
    }
}
