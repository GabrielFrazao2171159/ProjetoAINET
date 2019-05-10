<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aeronave extends Model
{
    use SoftDeletes;

	protected $primaryKey = 'matricula';	//Por default ele vai à procura do 'id'

    public $incrementing = false;	//Isto impedirá que ele seja um campo de incremento automático

    protected $fillable = [
        'matricula', 'marca', 'modelo', 'num_lugares', 'conta_horas', 'preco_hora',
    ];

    public function pilotos()
    {
        return $this->belongsToMany('App\User', 'aeronaves_pilotos', 'matricula', 'piloto_id');
    }
}
