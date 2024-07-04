<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetUserRelatedFactRequest extends FormRequest
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
            'user_type' => 'in:numberphile,non-numberphile',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'user_type.in' => 'The user type must be either "numberphile" or "non-numberphile"!'
        ];
    }
}
