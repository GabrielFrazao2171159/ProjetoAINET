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
        $rules_base = [
            'num_socio' => 'required|integer|unique:users,num_socio|min:1',
            'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'nome_informal' => 'required|string|max:40',
            'email' => 'required|email|max:255|unique:users,email',
            'tipo_socio' => 'required|in:"P","NP","A"',
            'sexo' => 'required|in:"M","F"',
            'data_nascimento' => 'required|date_format:"d/m/Y"|before:'.date("d/m/Y", time()),
            'telefone' => '',
            'endereco' => '',
            'nif' => '',
            'ativo' => 'required|in:1,0',
            'quota_paga' => 'required|in:1,0',
            'direcao' => 'required|in:1,0',
        ]; 

        if(!empty($this->endereco)){
            $rules_base['endereco'] = 'string';
        }

        if(!empty($this->nif)){
            $rules_base['nif'] = 'integer|digits:9'; 
        }

        if(!empty($this->telefone)){
            $rules_base['telefone'] = 'string|min:9|max:20';
        }

        if(!empty($this->file_foto)){
            $rules_base['file_foto'] = 'mimetypes:image/jpeg,image/png,image/jpg';
        }

        return $rules_base;

    }

    public function messages()
    {
        return [
            'nome_informal.regex' => 'O campo marca apenas deve conter letras e espaços.',
        ];
    }
}