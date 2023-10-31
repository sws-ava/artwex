<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCategoryRequest extends Request
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
        return [
           'parent_id' => 'required',
           'name' => 'required',
           'slug' => 'required|unique:categories',
           'active' => 'required',
		   'picture' => 'mimes:jpg,jpeg,png'
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
            // 'address_type.composite_unique' => trans('validation.composite_unique'),
        ];
    }

}
