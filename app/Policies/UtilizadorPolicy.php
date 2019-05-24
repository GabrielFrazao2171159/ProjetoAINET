<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UtilizadorPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isDirecao()) {
            return true;
        }
    }

    public function verAtivos(User $auth)
    {
        return false;
    }

    public function verInfoDirecao(User $auth)
    {
        return false;
    }

    public function gerirCotasAtivos(User $auth)
    {
        return false;
    }

    public function edit(User $auth, User $user)
    {
        if($auth->id==$user->id){
            return true;
        }

        return false;
    }

    public function editInfo(User $auth){
        return false;
    }

    public function enviarMail(User $auth){
        return false;
    }
}

