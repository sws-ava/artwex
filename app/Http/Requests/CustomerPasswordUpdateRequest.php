<?php

namespace App\Http\Requests;

use Auth;
use Hash;
use Validator;
use App\Http\Requests\Request;

class CustomerPasswordUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Validator::extend('check_current_password', function($attribute, $value, $parameters){
            return Hash::check($value, Auth::guard('web')->user()->password);
        });

        $rules = [];

        // Current password is required if it set
        if(Auth::guard('web')->user()->password)
            $rules['current_password'] =  'required|check_current_password';

        $rules['password'] =  'required|confirmed|min:6';
        $rules['password_confirmation'] = 'required';

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'current_password.check_current_password' => trans('requests.incorrect_current_password'),
        ];
    }
}
