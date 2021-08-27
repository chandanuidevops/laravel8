<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'username'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'password'=>'required',
            'name'=>'required',
            'city'=>'required',
            'country'=>'required',
            'photo'=>'required',
           
        ];
    }
       /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required'=>'User Name field is required',
            'country_id.required'=>'Country Name field is required',
        ];
    }
}
