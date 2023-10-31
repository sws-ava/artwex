<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Http\Requests\Request;

class ProductReviewCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user() instanceof User) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		$user_id = Request::user()->id; //Get current user's shop_id
        Request::merge([
			'customer_id' => $user_id
		]);
        return [
           'rating' => 'required|integer|between:1,5',
           'comment' => 'nullable|string|min:2|max:250',
        ];
    }

}
