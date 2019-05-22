<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'num_socio' => 'required|max:11',
            'name' => 'required|regex:/^[\pL\s]+$/u|max:40',
            'nome_informal' => 'required|regex:/^[\pL\s]+$/u|max:40',
            'email' => 'email|max:255',
            'tipo_socio' => 'required',
            'sexo' => 'required',
            'data_nascimento' => 'required',
            'nif' => 'required|max:9',
        ]; 
    }

    public function messages()
    {
        return [
            'nome_informal.regex' => 'O campo marca apenas deve conter letras e espaços.',
        ];
    }
}