<?php

namespace app\Http\Requests;

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
            "nombre" => "required",
            "paterno" => "required",
            "ci" => "required|unique:datos_usuarios,ci|numeric|digits_between:1,10",
            "ci_exp" => "required",
            "dir" => "required",
            "fono" => "required|numeric|digits_between:1,10",
            "fono_referencia" => "required",
            "cel" => "required|numeric|digits_between:1,10",
            "tipo" => "required",
        ];
    }

    public function messages()
    {
        return [
            'ci.unique' => 'Ya hay alguien registrado con este número de C.I..',
        ];
    }
}
