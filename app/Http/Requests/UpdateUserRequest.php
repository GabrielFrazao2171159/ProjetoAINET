<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\User;

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
            'instrutor' => isset($this->instrutor) ? 1 : 0,
            'licenca_confirmada' => isset($this->licenca_confirmada) ? 1 : 0,
            'certificado_confirmado' => isset($this->certificado_confirmado) ? 1 : 0,
        ]);
    }

    public function rules()
    {
        $rules_base = [
            'nome_informal' => 'required|string|max:40',
            'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'email' => 'required|email|max:255',
            'data_nascimento' => 'required|date_format:"d/m/Y"|before:'.date("d/m/Y", time()),  
            'endereco' => '',
            'nif' => '',
            'telefone' => '',
            'num_licenca' => '',
            'tipo_licenca' => '',
            'validade_licenca' => '',
            'num_certificado' => '',
            'validade_certificado' => '',
            'classe_certificado' => '',
        ];

        if(User::find(Auth::id())->direcao == 1){  
        //Caso seja da direção também tem de validar estes campos
            $rules_base['num_socio'] = 'required|integer|min:1';
            $rules_base['tipo_socio'] = 'required|in:"P","NP","A"';
            $rules_base['sexo'] = 'required|in:"M","F"';
            $rules_base['direcao'] = 'required|in:1,0';
            $rules_base['quota_paga'] = 'required|in:1,0';
            $rules_base['ativo'] = 'required|in:1,0';
            $rules_base['instrutor'] = 'required|in:1,0';
            $rules_base['licenca_confirmada'] = 'required|in:1,0';
            $rules_base['certificado_confirmado'] = 'required|in:1,0';
        }

        if(!empty($this->num_licenca)){
            $rules_base['num_licenca'] = 'integer';
        }

        if(!empty($this->tipo_licenca)){
            $rules_base['tipo_licenca'] = 'string';
        }

        if(!empty($this->validade_licenca)){
            $rules_base['validade_licenca'] = 'date';
        }

        if(!empty($this->num_certificado)){
            $rules_base['num_certificado'] = 'string';
        }

        if(!empty($this->validade_certificado)){
            $rules_base['validade_certificado'] = 'date';
        }

        if(!empty($this->classe_certificado)){
            $rules_base['classe_certificado'] = 'string';
        }
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
            'data_nascimento.date_format' => 'A data indicada para o campo data nascimento não respeita o formato dd/mm/yyyy.',
        ];
    }
}