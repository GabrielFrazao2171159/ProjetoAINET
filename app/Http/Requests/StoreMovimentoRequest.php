<?php


namespace App\Http\Requests;

use App\Aeronave;
use App\Movimento;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreMovimentoRequest extends FormRequest
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
        $rules = ['data' => 'required|before_or_equal:today',
            'hora_descolagem' => 'required|date_format:"Y-m-d H:i:s|after_or_equal:data',
            'hora_aterragem' => 'required|date_format:"Y-m-d H:i:s',
            'aeronave' => 'required|exists:aeronaves,matricula|max:8',
            'num_diario' => 'required|integer|between:1,5',
            'num_servico' => 'required|integer|between:1,999',
            'piloto_id' => 'required|exists:users,id|integer',
            'natureza' => 'required',
            'aerodromo_partida' => 'required|exists:aerodromos,code',
            'aerodromo_chegada' => 'required|exists:aerodromos,code',
            'num_aterragens' => 'required|integer|min:1',
            'num_descolagens' => 'required|integer|min:1',
            'num_pessoas' => 'required|integer|between:1,10',
            'conta_horas_inicio' => 'required|integer',
            'conta_horas_fim' => 'required|integer|gt:conta_horas_inicio',
            'modo_pagamento' => 'required',
            'num_recibo' => 'required|integer|min:0',
            'observacoes' => ''
            ];

        if($this->natureza == "I"){
            $rules['tipo_instrucao'] = 'required';
            $rules['instrutor_id'] = 'required|exists:users,id|different:piloto_id|integer|min:10000';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'data.before_or_equal' => 'A data deverá ser antes do dia presente ou no próprio dia.',
            'hora_descolagem.date_format' => 'A data indicada para o campo hora descolagem não respeita o formato Ano-Mês-Dia Hora:Minutos:Segundos.',
            'hora_aterragem.date_format' => 'A data indicada para o campo hora descolagem não respeita o formato Ano-Mês-Dia Hora:Minutos:Segundos.'
        ];

    }

}