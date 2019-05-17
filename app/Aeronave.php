<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aeronave extends Model
{
    use SoftDeletes;

	protected $primaryKey = 'matricula';	//Por default ele vai à procura do 'id'

    protected $keyType = 'string'; //Por default é inteira a chave primária

    public $incrementing = false;	//Isto impedirá que a matricula seja um campo de incremento automático

    protected $fillable = [
        'matricula', 'marca', 'modelo', 'num_lugares', 'conta_horas', 'preco_hora'
    ];

    public function pilotos()
    {
        return $this->belongsToMany('App\User', 'aeronaves_pilotos', 'matricula', 'piloto_id');
    }

    public function movimentos()
    {
        return $this->hasMany('App\Movimento','aeronave');
    }

    public function valores()
    {
        return $this->hasMany('App\ValorTabela','matricula');
    }
}
