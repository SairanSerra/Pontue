<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'email'         => ['required'],
            'password'      => ['required','min:6'],
            'deviceName'    => ['required']
        ];
    }

    public function messages()
    {
        return [
            'email.required'      => 'email e um campo obrigatorio',
            'passoword.required'  => 'password e um campo obrigatorio',
            'deviceName.required' => 'deviceName e um campo obrigatorio',
            'password.min'        => 'password deve conter no minimo 6 caracters'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}