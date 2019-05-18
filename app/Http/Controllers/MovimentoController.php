<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aeronave;
use App\Http\Requests\StoreAddMovimentoRequest;
use App\User;
use App\Movimento;
use Illuminate\Support\Facades\DB;

class MovimentoController extends Controller
{

    public function index(){
		$movimentos = Movimento::paginate(15);
		return view('movimentos.index',compact('movimentos'));
	}

	public function create(){
        $movimento = new Movimento();
		return view('movimentos.create',compact('movimento'));
	}

	public function store(StoreAddMovimentoRequest $request){
        $movimento = $request->validated();
        $movimentoCriado = Movimento::create($movimento);
        return redirect()->route('movimentos.index')->with('sucesso', 'Voo inserido com sucesso!');
    }

}