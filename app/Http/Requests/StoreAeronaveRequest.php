<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAeronaveRequest extends FormRequest
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
            'matricula' => 'required|unique:aeronaves|max:8',
            'marca' => 'required|regex:/^[\pL\s]+$/u|max:40',
            'modelo' => 'required|max:40',
            'num_lugares' => 'required|integer|between:1,10',
            'conta_horas' => 'required|integer|min:0',
            'preco_hora' => 'required|numeric|min:0.00',
            'preco_0' => 'required|numeric|min:0.00',
            'preco_1' => 'required|numeric|min:0.00',
            'preco_2' => 'required|numeric|min:0.00',
            'preco_3' => 'required|numeric|min:0.00',
            'preco_4' => 'required|numeric|min:0.00',
            'preco_5' => 'required|numeric|min:0.00',
            'preco_6' => 'required|numeric|min:0.00',
            'preco_7' => 'required|numeric|min:0.00',
            'preco_8' => 'required|numeric|min:0.00',
            'preco_9' => 'required|numeric|min:0.00'
        ];
    }

    public function messages()
    {
        return [
            'marca.regex' => 'O campo marca apenas deve conter letras e espaços.',
            'num_lugares.between' => 'O número de lugares deve estar entre 1 e 10.'
        ];
    }
}
