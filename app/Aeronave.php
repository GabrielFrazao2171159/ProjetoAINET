<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeronave extends Model
{
	protected $primaryKey = 'matricula';	//Por default ele vai à procura do 'id'

    public $incrementing = false;	//Isto impedirá que ele seja um campo de incremento automático

    protected $fillable = [
        'matricula', 'marca', 'modelo', 'num_lugares', 'conta_horas', 'preco_hora',
    ];
}
