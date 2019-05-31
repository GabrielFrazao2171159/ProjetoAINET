<?php

namespace App\Policies;

use App\Movimento;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MovimentoPolicy
{
    use HandlesAuthorization;

    public function filtrarMeusMovimentos(User $auth)
    {
        if($auth->tipo_socio=='P'){
            return true; 
        }
        return false;
    }

    public function confimarVoo(User $auth)
    {
        if($auth->isDirecao()){
            return true; 
        }
        return false;
    }

    public function update(User $auth, Movimento $movimento)
    {
        if((($auth->tipo_socio == "P" && ($auth->id == $movimento->piloto_id || $auth->id == $movimento->instrutor_id)) || $auth->isDirecao()) && $movimento->confirmado==0){
            return true;
        }
        return false;
    }

    public function create(User $auth)
    {
        if($auth->tipo_socio == "P"){
            return true;
        }
        return false;
    }

    public function delete(User $auth, Movimento $movimento)
    {
        if((($auth->tipo_socio == "P" && ($auth->id == $movimento->piloto_id || $auth->id == $movimento->instrutor_id)) || $auth->isDirecao()) && $movimento->confirmado==0){
            return true;
        }
        return false;
    }
}
