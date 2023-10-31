<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateFaqRequest extends Request
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
        $id = Request::segment(count(Request::segments())); //Current model ID

        return [
            'question' =>  'required',
            'answer' =>  'required',
            'hide' => 'required'
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
            // 'attribute_type_id.required' => trans('validation.attribute_type_id_required'),
        ];
    }

}
