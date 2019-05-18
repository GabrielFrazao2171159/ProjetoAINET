<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{

    public $incrementing = false;
    
    protected $fillable = [
        'id', 'natureza', 'confirmado', 'piloto', 'instrutor', 'aeronave'
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
    
    public function aeronave()
    {
        return $this->belongsTo('App\Aeronave');
    }

    public function piloto()
    {
        return $this->belongsTo('App\User');
    }
}