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
}

