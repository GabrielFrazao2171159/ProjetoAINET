<?php
namespace App\Filtros;

use App\User;
use App\Movimento;

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

    public static function movimentos($attr)
    {
        $arrayWhere = array();

        if(isset($attr['data_inf'])){
            $arrayWhere[] = ['data', '>=', $attr['data_inf']];
            unset($attr['data_inf']);
        }
        if(isset($attr['data_sup'])){
            $arrayWhere[] = ['data', '<=', $attr['data_sup']];
            unset($attr['data_sup']);
        }

        foreach ($attr as $campo => $valor) {
            $arrayWhere[] = [(string)$campo, '=', $valor];
        }
      
        $movimentos = Movimento::where($arrayWhere)->paginate(15);
        
        return $movimentos;
    }
}
