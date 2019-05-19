<?php


namespace App\Http\Requests;

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
        return [
            'data' => 'required',
            'hora_descolagem' => 'required',
            'hora_aterragem' => 'required',
            'aeronave' => 'required|exists:aeronaves, matricula|max:8',
            'num_diario' => 'required|integer|between:1,5',
            'num_servico' => 'required|integer|between:1,999',
            'piloto_id' => 'required|exists:users, id|integer|min:10000',
            'natureza' => 'required',
            'aerodromo_partida' => 'required|exists:aerodromos, code',
            'aerodromo_chegada' => 'required|exists:aerodromos, code',
            'num_aterragens' => 'required|integer|between:1,7',
            'num_descolagens' => 'required|integer|between:1,7',
            'num_pessoas' => 'required|integer|between:1,10',
            'conta_horas_inicio' => 'required|integer|min:0',
            'conta_horas_fim' => 'required|integer|gt:conta_horas_inicio',
            'modo_pagamento' => 'required',
            'num_recibo' => 'required|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            'num_diario.between' => 'O número de lugares deve estar entre 1 e 5.',
            'num_servico.between' => 'O número de lugares deve estar entre 1 e 999.'
        ];
    }

}