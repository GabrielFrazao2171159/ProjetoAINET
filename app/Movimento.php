<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{

    protected $primaryKey = 'id';

    protected $fillable = [
        'data', 'hora_descolagem', 'hora_aterragem', 'aeronave', 'num_diario', 'num_servico', 'piloto_id', 'natureza',
        'aerodromo_partida', 'aerodromo_chegada', 'num_aterragens', 'num_descolagens', 'num_pessoas', 'conta_horas_inicio',
        'conta_horas_fim', 'tempo_voo', 'preco_voo', 'modo_pagamento', 'num_recibo', 'observacoes', 'tipo_instrucao', 'instrutor_id', 'num_licenca_piloto', 'tipo_licenca_piloto', 'validade_licenca_piloto', 'num_certificado_piloto','validade_certificado_piloto', 'classe_certificado_piloto', 'confirmado', 'num_licenca_instrutor', 'validade_licenca_instrutor', 'tipo_licenca_instrutor', 'num_certificado_instrutor', 'validade_certificado_instrutor', 'classe_certificado_instrutor'
    ];


    public function typeToStr()
    {
        switch ($this->natureza) {
            case 'T':
                return 'Treino';
            case 'I':
                return 'Instrução';
            case 'E':
                return 'Especial';
        }

        return 'Desconhecido';
    }

    public function hasPiloto($piloto){
        if($piloto == NULL){
            return '--------';
        }
        else{
            return (\App\User::find($piloto)->nome_informal);
        }
    }

    public function hasInstrucao($tipoInstrucao){
        if($tipoInstrucao == NULL){
            return '--------';
        }
        else{
            if($tipoInstrucao == "S"){
                return "Solo";
            }
            else{
                return "Duplo Comando";
            }
        }
    }


    public function aeronave()
    {
        return $this->belongsTo('App\Aeronave');
    }

    public function piloto()
    {
        return $this->belongsTo('App\User');
    }
}