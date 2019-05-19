<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{

    protected $primaryKey = 'id';

    protected $fillable = [
        'data', 'hora_descolagem', 'hora_aterragem', 'aeronave', 'num_diario', 'num_servico', 'piloto_id', 'natureza',
        'aerodromo_partida', 'aerodromo_chegada', 'num_aterragens', 'num_descolagens', 'num_pessoas', 'conta_horas_inicio',
        'conta_horas_fim', 'tempo_voo', 'preco_voo', 'modo_pagamento', 'num_recibo', 'observacoes', 'tipo_instrucao', 'instrutor_id'
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
            return 'Sem Instrutor';
        }
        else{
            return (\App\User::find($piloto)->name);
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