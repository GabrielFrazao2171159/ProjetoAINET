<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValorTabela extends Model
{
    protected $table = 'aeronaves_valores';	

   	protected $fillable = [
        'matricula', 'unidade_conta_horas', 'minutos', 'preco'
    ];

    public function aeronaves()
    {
        return $this->belongsTo('App\Aeronave');
    }
}
