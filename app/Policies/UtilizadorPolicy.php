<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UtilizadorPolicy
{
    use HandlesAuthorization;

    public function editEndereco(User $auth, User $user)
    {
        if ($auth->isDirecao() && ($user->id!=$auth->id)) {
            return false;
        }

        return true;
    }

    public function verInativos(User $auth)
    {
        if ($auth->isDirecao()) {
            return true;
        }

        return false;
    }

    public function verInfoDirecao(User $auth)
    {
        if ($auth->isDirecao()) {
            return true;
        }

        return false;
    }

    public function gerirCotasAtivos(User $auth)
    {
        if ($auth->isDirecao()) {
            return true;
        }

        return false;
    }

    public function update(User $auth, User $user)
    {
        if ($auth->isDirecao()) {
            return true;
        }

        if($auth->id==$user->id){
            return true;
        }

        return false;
    }

    public function editInfo(User $auth){
        if ($auth->isDirecao()) {
            return true;
        }

        return false;
    }

    public function enviarMail(User $auth){
        if ($auth->isDirecao()) {
            return true;
        }

        return false;
    }

    public function create(User $auth)
    {
        if ($auth->isDirecao()) {
            return true;
        }

        return false;
    }

    public function delete(User $auth)
    {
        if ($auth->isDirecao()) {
            return true;
        }

        return false;
    }
}

