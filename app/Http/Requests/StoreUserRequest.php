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
            'nome_informal' => 'required|regex:/^[\pL\s]+$/u|max:40',
            'name' => 'required|regex:/^[\pL\s]+$/u|max:40',
            'email' => 'email',
            'tipo_socio' => 'required',
            'sexo' => 'required',
            'data_nascimento' => 'required'
        ]; 
    }

    public function messages()
    {
        return [
            'nome_informal.regex' => 'O campo marca apenas deve conter letras e espaços.',
        ];
    }
}