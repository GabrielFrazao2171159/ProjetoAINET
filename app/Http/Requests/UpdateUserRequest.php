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
            'nome_informal' => 'required|regex:/^[\pL\s]+$/u|max:40',
            'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'email' => 'required|email|unique:users,email,'.$this->id . ',id',
            'data_nascimento' => 'required',
            'telefone' => 'required|string|unique:users,telefone,'.$this->id . ',id|min:9|max:14',
            'nif' => 'required|integer|unique:users,nif,'.$this->id . ',id',      
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
        if(User::find(Auth::id())->id == $this->id){
            $rules_base['endereco'] = 'required|string';
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