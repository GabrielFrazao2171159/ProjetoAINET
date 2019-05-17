<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','num_socio', 'nome_informal', 'data_nascimento', 'sexo', 'tipo_socio' ,'direcao', 'quota_paga', 'ativo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function aeronaves()
    {
        return $this->belongsToMany('App\Aeronave', 'aeronaves_pilotos', 'matricula', 'piloto_id');
    }

    public function typeToStr()
    {
        switch ($this->tipo_socio) {
            case 'P':
                return 'Piloto';
            case 'NP':
                return 'Não piloto';
            case 'A':
                return 'Aeromodelista';
        }

        return 'Desconhecido';
    }

    public function binaryToStr($valor)
    {
        if($valor == 0){
            return 'Não';
        }elseif ($valor == 1) {
           return 'Sim';
        }else{
            return 'Desconhecido';
        }

    }

    public function direcaoToStr()
    {
        return $this->binaryToStr($this->direcao);
    }

    public function quotaToStr()
    {
        return $this->binaryToStr($this->quota_paga);
    }

    public function ativoToStr()
    {
        return $this->binaryToStr($this->ativo);
    }

    public function isDirecao()
    {
        return $this->direcao == 1;
    }
}
