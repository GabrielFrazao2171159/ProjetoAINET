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
    protected function prepareForValidation()
    {
        $this->merge([
            'ativo' => isset($this->ativo) ? 1 : 0,
            'quota_paga' => isset($this->quota_paga) ? 1 : 0,
            'direcao' => isset($this->direcao) ? 1 : 0,
        ]);
    }

    public function rules()
    {
        return [
            'num_socio' => 'required|max:11|unique:users,num_socio',
            'name' => 'required|regex:/^[\pL\s]+$/u|max:40',
            'nome_informal' => 'required|regex:/^[\pL\s]+$/u|max:40',
            'email' => 'required|email|max:255|unique:users,email',
            'tipo_socio' => 'required',
            'sexo' => 'required',
            'data_nascimento' => 'required',
            //  'nif' => 'integer|unique:users,nif',
            'telefone' => 'integer|unique:users,telefone',
            'endereco' => 'string'
        ]; 
    }

    public function messages()
    {
        return [
            'nome_informal.regex' => 'O campo marca apenas deve conter letras e espaços.',
        ];
    }
}