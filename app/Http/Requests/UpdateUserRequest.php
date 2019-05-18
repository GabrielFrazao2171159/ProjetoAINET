<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'num_socio' => 'required|max:11',
            'nome_informal' => 'required|regex:/^[\pL\s]+$/u|max:40',
            'email' => 'email',
            'data_nascimento' => 'required',
            'tipo_socio' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome_informal.regex' => 'O campo marca apenas deve conter letras e espaços.',
        ];
    }
}