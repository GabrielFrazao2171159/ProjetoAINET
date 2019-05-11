<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{

    public $incrementing = false;
    
    protected $fillable = [
        'id', 'aeronave', 'data_inf', 'data_sup', 'natureza', 'confirmado', 'piloto', 'instrutor', 'meus_movimentos'
    ];

    public function aeronaves()
    {
        return $this->belongsToMany('App\User', 'matricula', 'marca', 'modelo');
    }

}