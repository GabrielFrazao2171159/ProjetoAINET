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
        ]);
    }

    public function rules()
    {
        $rules_base = [
            'nome_informal' => 'required|string|max:40',
            'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'email' => 'required|email',
            'data_nascimento' => 'required|date_format:"d/m/Y"',  
            'endereco' => '',
            'nif' => '',
            'telefone' => '', 
        ];

        if(User::find(Auth::id())->direcao == 1){   
        //Caso seja da direção também tem de validar estes campos
            $rules_base['num_socio'] = 'required|max:11';
            $rules_base['tipo_socio'] = 'required';
            $rules_base['sexo'] = 'required';
            $rules_base['direcao'] = 'required';
            $rules_base['quota_paga'] = 'required';
            $rules_base['ativo'] = 'required';
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