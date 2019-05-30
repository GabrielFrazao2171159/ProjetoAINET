<?php

namespace App\Policies;

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

}
