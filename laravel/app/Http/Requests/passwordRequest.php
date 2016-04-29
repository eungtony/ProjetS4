<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class passwordRequest extends Request
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
            'actual_password' => 'required',
            'new_password' => 'required',
            'password_confirm' => 'required|same:new_password'
        ];
    }
}
