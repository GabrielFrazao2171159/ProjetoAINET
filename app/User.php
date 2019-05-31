<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','num_socio', 'nome_informal', 'data_nascimento', 'sexo', 'tipo_socio' ,'direcao',
        'quota_paga', 'ativo', 'telefone', 'nif', 'endereco', 'sexo', 'instrutor', 'licenca_confirmada',
        'certificado_confirmado', 'num_licenca', 'tipo_licenca', 'validade_licenca',
        'num_certificado', 'validade_certificado', 'classe_certificado',
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

    public function typeToSex()
    {
        switch ($this->sexo) {
            case 'M':
                return 'Masculino';
            case 'F':
                return 'Feminino';
        }

        return 'Desconhecido';
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

    public function movimentos()
    {
        return $this->hasMany('App\Movimento', 'piloto_id');
    }
}
