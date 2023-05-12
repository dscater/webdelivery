<?php

namespace app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NuevoLectorStoreRequest extends FormRequest
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
            'password' => 'required',
            'ci' => 'unique:lectors,ci'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Debe indicar una contraseña',
            'ci.unique' => 'Ya hay alguien registrado con este número de C.I..',
        ];
    }
}
