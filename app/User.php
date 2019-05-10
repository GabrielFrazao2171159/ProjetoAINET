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
        'name', 'email', 'password',
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

    public function binaryToStr()
    {
        if($this->direcao==0 || $this->quota_paga==0 || $this->ativo==0){
            return 'Não';
        }elseif ($this->direcao==1 || $this->quota_paga==1 || $this->ativo==1) {
           return 'Sim';
        }else{
            return 'Desconhecido';
        }

    }
}
