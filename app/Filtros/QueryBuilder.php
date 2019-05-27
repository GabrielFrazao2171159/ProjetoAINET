<?php
namespace App\Filtros;

use App\User;

class QueryBuilder 
{
    public static function socios($attr)
    {
    	$arrayWhere = array();
        if(isset($attr['email'])){
            $valor = "%".$attr['email']."%";
            $arrayWhere[] = ['email', 'like', (string)$valor];  
            unset($attr['email']); 
        }
        if(isset($attr['nome_informal'])){
            $valor = "%".$attr['nome_informal']."%";
            $arrayWhere[] = ['nome_informal', 'like', (string)$valor]; 
            unset($attr['nome_informal']);  
        }

    	foreach ($attr as $campo => $valor) {
    		$arrayWhere[] = [(string)$campo, '=', $valor];
    	}
      
    	$users = User::where($arrayWhere)->paginate(15);
    	
    	return $users;
    }
}
