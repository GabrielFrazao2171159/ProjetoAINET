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
        $meus_movimentos = null;

        if(isset($attr['meus_movimentos'])){
            $meus_movimentos = Movimento::where('piloto_id','=',$attr['meus_movimentos'])->orWhere('instrutor_id','=',$attr['meus_movimentos'])->pluck('id')->toArray();
            unset($attr['meus_movimentos']);
        }
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

        if(is_null($meus_movimentos)){
            $movimentos = Movimento::where($arrayWhere)->paginate(15);
        }else{
            $movimentos = Movimento::where($arrayWhere)->whereIn('id',$meus_movimentos)->paginate(15);
        }

        return $movimentos;
    }
}
//Movimento::where('piloto_id','=',$meus_movimentos)->orWhere('instrutor_id','=',$meus_movimentos)->paginate(15);