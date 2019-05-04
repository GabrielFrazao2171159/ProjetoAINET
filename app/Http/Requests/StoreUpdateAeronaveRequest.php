<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateAeronaveRequest extends FormRequest
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
            'matricula' => 'required|size:6',
            'marca' => 'required|regex:/^[\pL\s]+$/u',
            'modelo' => 'required',
            'num_lugares' => 'required|integer|between:1,10',
            'conta_horas' => 'required|integer|min:0',
            'preco_hora' => 'required|min:0'
        ];
    }

    public function messages()
    {
        return [
            'marca.regex' => 'O campo marca apenas deve conter letras e espaços.',
        ];
    }
}
